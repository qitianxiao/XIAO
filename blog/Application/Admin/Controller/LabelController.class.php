<?php
namespace Admin\Controller;
use Think\Controller;
class LabelController extends CommonController {
    public function show(){
    	if(IS_AJAX)
    	{   
    		$count = M('lable')->count();
    		$pages = $this->getPages($count);

    		$currentIndex = I('get.currentIndex',1);
    		$pageSize = I('get.pageSize',C('PAGE_SIZE'));

    		$data = M('lable')->page($currentIndex.','.$pageSize)->select();
    		$this->ajaxReturn(['data'=>$data,'pages'=>$pages,'pageSize'=>$pageSize]);
    	}
    	$this->display('Label/show');
    }

    public function add(){
    	if(IS_POST){
    		$data = I('post.');
    		$res =  M('lable')->add($data);
    		if($res){
                admin_log('添加标签:'.$data['lable_name']);
    			$this->success('标签添加成功',U('Label/show'));
    		}else{
    			$this->success('标签添加失败',U('Label/show'));
    		}
    	}else{
    		$this->display('Label/add');
    	}
    }

    public function update(){
        if(IS_POST){
            $data = I('post.');
            $res  = M('lable')->where(['label_id'=>$data['id']])->save($data);
            if($res){
                admin_log('修改标签'.$data['lable_name']);
                $this->success('标签修改成功',U('Label/show'));
            }else{
                $this->redirect('Label/show');
            }
        }else{
            $id = I('get.id');
            $data = M('lable')->where(['label_id'=>$id])->find();
            $this->assign('data',$data);
            $this->display('Label/update');
        }
    }

    public function delete(){
        $id = I('get.id');
        $res = M('lable')->where(['label_id'=>$id])->delete();
        if($res){
            admin_log('删除标签操作');
            $this->redirect('Label/show');
        }else{
            $this->redirect('Label/show');
        }
    }

    protected function getPages($count)
    {
    	$pageSize = C('PAGE_SIZE');
    	return ceil($count/$pageSize);
    }

}