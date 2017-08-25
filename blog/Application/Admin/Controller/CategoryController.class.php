<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController {
	public function show(){
		 	if(IS_AJAX){
	    		$count = M('article')->count();
	    		$pages = $this->getPages($count);

	    		$currentIndex = I('get.currentIndex',1);
	    		$pageSize = I('get.pageSize',C('PAGE_SIZE'));

	    		$data = M('category')->page($currentIndex.','.$pageSize)->select();
	    		$this->ajaxReturn(['data'=>$data,'pages'=>$pages,'pageSize'=>$pageSize]);
	    	}
	    	$list = M('category')->select();
	    	$this->assign('list',$list);
        	$this->display('Category/show');
		
	}

	public function add(){
		if(IS_POST){
			$getData = I('post.');
			// var_dump($getData);die;
			$res = M('category')->add($getData);
			if($res){
				admin_log('添加分类:'.$getData['category_name']);
				$this->success('分类添加成功',U('Category/show'));
			}else{
				$this->error('分类添加失败',U('Category/show'));
			}
		}else{
			$this->display('Category/add');
		}
	}

	public function update(){
		if(IS_GET){
			$id = I('get.id');
			$data = M('category')->where(['category_id'=>$id])->find();
			
			$this->assign('data',$data);
			$this->display('Category/update');
		}else{
			$data = I('post.');
			$res = M('category')->where(['category_id'=>$data['id']])->save($data);
			// echo M('category')->_sql();
			if($res){
				admin_log('修改分类'.$data['category_name']);
				$this->redirect('Category/show');
			}else{
				$this->redirect('Category/show');
			}
		}
	}

	public function delete(){
		$id = I('get.id');
		$res = M('category')->where(['category_id'=>$id])->delete();
		if($res){
			admin_log('删除分类操作');
			$this->redirect('Category/show');
		}else{
			$this->redirect('Category/show');
		}
	}



    protected function getPages($count)
    {
    	$pageSize = C('PAGE_SIZE');
    	return ceil($count/$pageSize);
    }
}