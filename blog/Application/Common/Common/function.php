<?php 
    function get_config(){
    	$cfgList = M('Config')->select();
	    $config = array();
		foreach($cfgList as $key=>$value){
			$config[$value['web_site']] = $value['web_value'];
		}
		// var_dump($config);die;
		return $config;

    }


 ?>