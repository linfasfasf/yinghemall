<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->display();
    }
    
    /*
     * 进行登陆
     * 
     * TODO :登陆验证，验证码检测
     */
    public function login(){
        $is_login = session('username');
        $user = D('Home/User');
        $get_user = $user->get_user();
        session('user_name',$get_user['username']);
        var_dump(session());
        redirect('/Home/index/index');
    }
    
    /*
     * 登出
     */
    public function logout(){
        session('user_name',NULL);
        echo 'logout success';
    }
}