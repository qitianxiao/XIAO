<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
            $this->display('Login/login');
        }
    public function checklogin(){
        if(IS_GET){
            $data = I('get.');

            $admindata = M('admin')->where(['admin_name'=>$data['admin_name']])->find();
            
            if(empty($admindata['salt'])){
                // var_dump($admindata);
                if($admindata['admin_pwd'] == md5($data['admin_pwd'])){
                    // var_dump($admindata);
                    $salt = rand(1,9999);
                    $pwd = md5(md5($data['admin_pwd']).$salt);
                    // var_dump($pwd);
                    M('admin')->where(['admin_id'=>$admindata['admin_id']])->save(['admin_pwd'=>$pwd,'salt'=>$salt]);
                        //登陆成功
                    session('admindata',$admindata);
                    $this->getadminip($admindata['admin_id']);                       
                    $this->redirect('Admin/index');
                }else{
                    $this->error('管理员登录失败1');
                }
            }else{//盐不为空
                if($admindata['admin_pwd'] == md5(md5($data['admin_pwd']).$admindata['salt'])){
                    session('admindata',$admindata);
                    $this->getadminip($admindata['admin_id']);                       
                    $this->redirect('Admin/index');                    
                }else{
                    $this->error('管理员登录失败2');
                }
            }   
        }else{
            $this->display('Login/login');
        }   
    }
    protected function getadminip($adminId){
            $admindata['admin_creat_time'] = time();
            $admindata['admin_ip'] = get_client_ip();
            M('admin')->where('admin_id='.$adminId)->save($admindata);
        }

}