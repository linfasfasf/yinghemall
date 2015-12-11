<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
    
    /*
     * 获取登陆信息
     */
    public function get_user(){
        $username = I('post.identity');
        $password = I('post.password');
        $user = M('User');
        $res = $user->where("username='%s' AND password = '%s'",array($username,$password))->find();
        return $res;
    }
    
    /*
     * 保存文件的路径
     */
    public function save_file($path,$file_name =''){
        var_dump(session('user_name'));
        $username = session('user_name');
        if(!$username){
            $this->error('您还未登陆！',U('Home/User/index'));
        }
        $user = M('user_file');
        $data['username'] = $username;
        $data['path'] = $path;
        $data['filename']=$file_name;
        $result = $user -> data($data)->add();
        var_dump($result);
        if(!$result){
            return FALSE;
        }
        return TRUE;
    }
    
    /*
     * 获取该用户所有上传的文件
     */
    public function get_user_file(){
        $user_name = session('user_name');
        $user_file = M('user_file');
        $res = $user_file->where("username='%s'",array($user_name))->field('path,filename,title,id')->select();
        return $res;
    }

    /*
     * 根据id进行删除
     */
    public function delete_article($id){
        $user = M('user_file');
        return $user->where('id=%d',$id)->delete();
    }


}
