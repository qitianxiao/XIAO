<?php
namespace Admin\Controller;
use Think\Controller;
class LogController extends CommonController {
    public function show(){
    	
			if(IS_AJAX){
	    		$count = M('admin_log')->count();
	    		$pages = $this->getPages($count);

	    		$currentIndex = I('get.currentIndex',1);
	    		$pageSize = I('get.pageSize',C('PAGE_SIZE'));

	    		$data = M('admin_log')->join('blog_admin on blog_admin_log.admin_id = blog_admin.admin_id')->page($currentIndex.','.$pageSize)->select();
	    		$this->ajaxReturn(['data'=>$data,'pages'=>$pages,'pageSize'=>$pageSize]);
	    	}
        	$this->display('Log/show');
    }


    protected function getPages($count)
    {
    	$pageSize = C('PAGE_SIZE');
    	return ceil($count/$pageSize);
    }
}



?>