<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
	public function __construct(){
		parent::__construct();
		$admindata = session('admindata');
		if(!isset($admindata)){
			$this->error('请先登录',U('Login/login'));
		}

	
		
		$this->config = get_config();//die;

		
	}

	private function _getConfig(){
		return M('Config')->select();
	}


}



?>