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
     * 注册账号
     */
    public function create_account(){
        $email      = I('email');
        $mobile     = I('mobile');
        $password   = I('password');
        $repassword = I('confirmation');
        $name       = I('name');

        if(empty($email)|empty($mobile)|empty($password)|empty($repassword)|empty($name)){
            $this->error('信息不能为空','/Home/User/register',3);
        }
        if($password!==$repassword){
            $this->error('两次输入的密码不一致','/Home/User/register',3);
        }
        if(!$this->check_email_mobile($email)){
            $this->error('请输入未注册的手机或邮箱','/Home/User/register',3);
        }

        $user = D('User');
        if(!$user->create_account($email,$mobile,$password,$name)){
            $msg = '注册失败，请重试！';
        }else{
            $msg = '恭喜，注册成功！';
        }
        $this->assign('msg',$msg);

        $this->display('Index/register');
    }
    
    /*
     * 登出
     */
    public function logout(){
        session('user_name',NULL);
        echo 'logout success';
    }

    /*
     * 跳转到注册界面
     */
    public function register(){
        $this->display('Index/register');
    }

    /*
     * 邮箱验证
     * 通过验证返回 true
     */
    public function check_email_mobile($email){
        if(empty($email)){
            return false;
        }
        var_dump($email);
        $pattern = "/\w+@(\w|\d)+\.\w{2,3}/i";
        if(preg_match_all($pattern,$email,$match)){
            $user = D('User');
            if( !$user->check_mobile()){
                return true;
            }
        }
        return false;
    }

    public function check_mobile(){
        $user = D('User');
        if(!$user->check_mobile()){
            return false;
        }
        return true;
    }
}