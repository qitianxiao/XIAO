<?php 

    function admin_log($logInfo){
    	    $adminInfo = session('admindata'); 
    	    $time = date("Y-m-d H:i:s",time());
            $logData = ['log_time'=>$time,'admin_id'=>$adminInfo['admin_id'],'log_info'=>$logInfo,'ip_address'=>get_client_ip()];
            M('admin_log')->add($logData);
    }




 ?>