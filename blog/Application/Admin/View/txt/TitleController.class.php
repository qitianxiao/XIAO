 <?php
namespace Admin\Controller;
use Think\Controller;
class TitleController extends CommonController {
  public function show(){
    if(IS_AJAX){
      //搜索
      $map = I('get.map','');
      $where = ['status'=>0];
      
      if(!empty($map['keywords']))
      {
          $where['title_name'] = array('like',"%$map[keywords]%");
      }
      if(!empty($map['type_id']))
      {
          $where['type_id'] = ['eq', $map['type_id']];
      }
      $map['stime'] = strtotime($map['stime']);
      $map['etime'] = strtotime($map['etime']);
      if(!empty($map['stime']) || !empty($map['etime']))
      {
          $where['title_time'][] = array('egt',$map['stime']);
      }
      if(!empty($map['etime']))
      {
          $where['title_time'][] = array('elt',$map['etime']);
      }

      $data = D('Title')->relation(true)->where($where)->select();
      echo json_encode($data);exit();
    }
    $data = M('Type')->select();
    $this->assign('data',$data);
    $this->display();
  }
            
            
  public function add(){
  	if(IS_POST){
  		$data = I('post.');
  		$data['title_time'] = time();
  		$label = $data['label_id'];
  		// print_r($data);die;
  		unset($data['label_id']);//销毁变量 保留$label
  		$data['title_name'] = I('post.title_name');
          //自动验证
          if(!D('Title')->create()){
              $this->error(D('Title')->getError());
          }else{
            //上传文件
            $imgPath = $this->upload('title_img');
            $data['title_img'] = $imgPath;
            
          	$res = M('Title')->add($data);
    		    foreach ($label as $key => $val) {
      			$array[] = array(
      					'title_id'=>$res,
      					'label_id'=>$val,
      				);
        		}
        		M('title_label')->addAll($array);
        		if($res){
              // 记录日志
              admin_log('添加文章:'.$data['title_name']);
        			$this->success('文章添加成功',U('Title/show'));
        		}else{
        			$this->error();
        		}
          }
  	}else{
  		$type = M('Type')->select();
  		$this->assign('type',$type);
  		$data = M('Label')->select();
  		$this->assign('data',$data);
  		$this->display();
  	}
  }
  /**
   * 文件上传
   */
  public function up(){
    
  }
  /**
   * 软删除
   */
  public function del(){
    $id = I('get.id');
    $data['status'] = 1;
    $res=M('Title')->where(array('title_id'=>$id))->save($data);
    if($res)
    {
      echo 1;
    }else{
      echo 0;
    }
  }
  /**
   * 文章修改 
   */
  public function save(){
    if(IS_POST){
      $data = I('post.');
      $label = $data['label_id'];
      // print_r($data);die;
      unset($data['label_id']);//销毁变量 保留$label
      $data['title_name'] = I('post.title_name');
      //上传文件 
      $imgPath = $this->upload('title_img');
      $data['title_img'] = $imgPath;
      $res = M('Title')->where(array('title_id'=>$data['title_id']))->save($data);
      foreach ($label as $key => $val) {
      $array[] = array(
          'title_id'=>$data['title_id'],
          'label_id'=>$val,
        );
      }
      M('title_label')->where(array('title_id'=>$data['title_id']))->delete();
      M('title_label')->addAll($array);
      if($res){
        // 记录日志
        admin_log('修改文章:'.$data['title_name']);
        $this->success('文章修改成功',U('Title/show'));
      }else{
        $this->error();
      }
    }else{
      $id = I('get.id');
      $data = M('Title')->where(array('title_id'=>$id))->find();
      $type = M('Type')->select();
      $label = M('Label')->select();
      $tl = M('title_label')->where(array('title_id'=>$id))->getField('label_id',true);
      // 第二个参数传入了true，返回的tl则是一个数组，包含了所有满足条件的昵称列表。
      $this->assign('label',$label);
      $this->assign('title_id',$data['title_id']);

      $this->assign('tl',$tl);
      $this->assign('data',$data);
      $this->assign('type',$type);
      $this->display();
    }
  }
}