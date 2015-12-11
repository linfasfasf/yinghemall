<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller{
    /**
     * AdminController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->check_login();
    }
    
    /**
     * 检查输入参数
     * 
     */
    public function check_param(){
        foreach ($_POST as $key => $value){
            if(is_array($value)){
                $_POST[$key] =$value;
            }  else {
                $_POST[$key]= mysql_real_escape_string($value);
            }
        }
        
        foreach ($_GET as $key =>$value){
            $_GET[$key] = mysql_real_escape_string($value);
        }
    }
    
    
    public function check_login(){
        $is_login = session('user_name');
        if(!$is_login){
            $this->error('您还未登陆!',U('Home/User/index'));
        }
                
    }
    
   
}