<?php
namespace Admin\Controller;
use Think\Controller;
class ConfigController extends CommonController {
    public function show(){
    	if(IS_POST){
    		$data = I('post.');
    		foreach($data as $key=>$value){
    			$res = M('Config')->where(['web_site'=>$key])->save(['web_site'=>$key,'web_value'=>$value]);
    			if($res === false){
    				$this->error('添加失败');
    			}
    		}
    		$this->success('配置成功');
    	}else{
    		
    		$config = get_config();
    		$this->assign('config',$config);
    	    $this->display('Config/show');    		
    	}
    }
}