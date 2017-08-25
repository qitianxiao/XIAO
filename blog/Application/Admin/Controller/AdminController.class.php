<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {
    public function index(){
        	$this->display('Index/index');
        }

    public function show(){

    	if(IS_AJAX)
    	  {  
    		$count = M('admin')->count();
    		$pages = $this->getPages($count);

    		$currentIndex = I('get.currentIndex',1);
            
    		$data = M('admin')->page($currentIndex.','.$this->config['PAGE_SIZE'])->select();
            // echo M('admin')->_sql();
    		$this->ajaxReturn(['data'=>$data,'pages'=>$pages,'pageSize'=>$pageSize]);
    	}
    	$this->display('Admin/show');
    }

    public function add(){
        
    	$this->display('Admin/form');
    }

    public function insert(){
    	$data = I('post.');
        $data['admin_ip'] = get_client_ip();
    	$res = M('admin')->add($data);
    	if($res){
            //添加日志
            admin_log('添加管理员:'.$data['admin_name']);
    		$this->success('管理员添加成功',U('Admin/show'));
    	}else{
    		$this->error('管理员添加失败',U('Admin/show'));
    	}

    }

    public function update(){
    	$id = I('get.id');
    	$data = M('admin')->where(['admin_id'=>$id])->find();
    	$this->assign('data',$data);
    	$this->display('Admin/update');
    }

    public function save(){
    	$data = I('post.');
    	$res = M('admin')->where(['admin_id'=>$data['id']])->save($data);
    	if($res){
            admin_log('修改了管理员为:'.$data['admin_name']);
    		$this->success('管理员修改成功',U('Admin/show'));
    	}else{
    		$this->success('管理员添加失败',U('Admin/show'));
    	}
    }

    public function delete(){
    	$id=I('get.id');
    	$res = M('admin')->where(['admin_id'=>$id])->delete();
    	// echo M('admin')->_sql();die;
    	if($res){
            admin_log('删除了管理员:');
    		$this->success('管理员删除成功',U('Admin/show'));
    	}else{
    		$this->success('管理员删除成功',U('Admin/show'));
    	}
    }
    

    protected function getPages($count)
    {
    	$pageSize = $this->config['PAGE_SIZE'];
    	return ceil($count/$pageSize);
    }
    	

}