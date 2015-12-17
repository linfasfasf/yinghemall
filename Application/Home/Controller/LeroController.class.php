<?php
namespace Home\Controller;
use Think\Controller;
class LeroController extends AdminController {
    public function index(){

        $res = $this->get_user_file();
        $preview = $this->get_preview($res);
        $this->assign('preview',$preview);
        $this->display();
        
    }

    /*
     * 获取预览文件夹中的信息并保存到输出的目录中
     */
    public function get_preview($user_file){
        $preview_arr = array();
        $i=0;
        foreach($user_file as $vo){
            $path = $vo['path'];
            $preview = $path.'/preview.txt';
            $preview_msg = '暂无信息';
            if(file_exists($preview)){
                $preview_msg = file_get_contents($preview);
            }
            $user_file[$i]['preview'] = $preview_msg;//往数组保存结果
            $i++;
        }
        return $user_file;
    }

    /*
     * 根据文章id删除文章
     */
    public function delete_article(){
        $id = I('get.id');
        $user = D('User');
        $res = $user->delete_article($id);
        if(!$res){
            $this->error('删除失败');
        }
        redirect('index');
    }
    
    public function test(){
        $data['result'] = I('get.name');
        $data['msg']    = array('info1'=>I('get.id'),'info2'=>'coco');
        $info = array('result'=>$data,'msg'=>$data['msg']);
        $this->assign($info);
        $this->display();
    }
    
    /*
     * 上传文件，检测文件 ,并保存进数据库
     */
    public function file(){
        var_dump($_FILES);
        if($_FILES['files']['error']>0){
            $this->error('上传文件错');
        }
        if($_FILES['files']['type']!=='text/plain'){
            die();
            $this->error('暂不支持此类型文件');
        }
        $file_name = $_FILES['files']['name'];
        $path =$_SERVER['DOCUMENT_ROOT'] .'/Uploads/'. $this->random(8);
        $file =$path.'/'.$_FILES['files']['name'];
        if(!is_dir($path)){
            mkdir($path);
        } 
        echo $file;
        if(file_exists($file)){
           die('file has been exist'); 
        }
        $result =  move_uploaded_file($_FILES['files']['tmp_name'], $file);
        if(!$result){
            $this->error('上传失败');
        }
        $this->read_file_first($file,$path);
        $fie_current = nl2br(file_get_contents($path.'/current.txt'));
        echo $fie_current;
        
        $file = D('Home/User');
        $res = $file->save_file($path,$file_name);
        if(!$res){
            echo '保存失败';
        }
    }
    
    
    /*
     * 第一次上传文件，读取文件指定内容，生成基础文件
     */
    public function read_file_first($file,$path){
        $file = fopen($file, "r");
        for($i= 0;$i<10;$i++){
            if(!feof($file)){

                $fget = fgets($file);
                file_put_contents($path.'/current.txt', $fget,FILE_APPEND|LOCK_EX);
            }
        }
    }
    
    /*
     * 基准文件
     * 读取文件,并且产生history 文件记录之前页面的的偏移量
     * 产生预览文件
     */
    public function read_file($file,$path,$len=10){
        $list_file = $path.'/next.txt';
        $start = file_get_contents($list_file);//读取下一页的偏移量
        if(empty($start)){
             $start = 0;
         }
         $history_file = $path.'/histroy.txt';
         file_put_contents($history_file, ','.$start,FILE_APPEND|LOCK_EX);//将读取文件的偏移量放入histroy文件中

        file_put_contents($path.'/current.txt', '',LOCK_EX);
        $fopen = fopen($file, 'r+');
        $fpoint = fseek($fopen, $start); 
        for($i=0;$i<$len;$i++){
            $get = fgets($fopen);
            file_put_contents($path.'/current.txt', $get,FILE_APPEND|LOCK_EX);//产生本页的文件
        }
         //产生预览文件，test测试为10
        $preview = file_get_contents($path.'/current.txt',0,null,0,400);
        file_put_contents($path.'/preview.txt', $preview);
        $ftell = ftell($fopen);
        echo $ftell;
        file_put_contents($list_file, $ftell);//结束前将当前的偏移量存入next 文件 下一次读取的时候从当前位置开始读取
        fclose($fopen);
    }

    
    /**
     *  产生指定长度的随机字符
     * @param type $len 产生随机的字符的长度 默认为6
     * @return type 随机字符
     */
    
    public function random($len=6){
        $str = "abcdefghijklmnopqrstuvwxyz0123456789";
        $rand_str= "";
        while (strlen($rand_str)<$len){
            $star = rand(0, 36);
            $rand_str .= substr($str,$star,1 );
        }
        return  $rand_str;
    }
    
    /*
     * 获取当前用户的所有文件
     */
    public function get_user_file(){
        $user = D('Home/User');
        $res = $user ->get_user_file();
        return $res;
    }
    
    
    /*
     * debug 探索测试功能
     * 展示该账号下所有文件信息
     */
    public function show_file(){
        $path = I('get.path');
        $filename = I('get.filename');
        $file = $path.'/current.txt';
        $file = file_get_contents($file);
        $this->assign('file',$file);
        $this->display();
    }
    
    /*
     *TODO: 下一页功能读取文件夹展示下一页并做记录
     */
    
    public function next_page(){
        $path = I('get.path');
        $filename = I('get.filename');
        $file = $path.'/'.$filename;
        echo filesize($file);
        $this->read_file($file, $path);
        var_dump($filename);
        var_dump($path);        
    }

    /*
     * 判断是否是手机访问
     * boolean
     */
    public function is_mobile(){
        if(isset($_SERVER['HTTP_X_WAP_PROFILE'])){
            return TRUE;
        }
        if(isset($_SERVER['HTTP_VIA'])){
            return stristr($_SERVER['HTTP_VIA'], 'wap')?TRUE:FALSE;
        }  else {
            return FALSE;
        }
    }

    /*
     * 展示文章
     * param path 文章路径
     */
    public function show_article(){
        $is_mobile =  $this->is_mobile();
        $path = I('get.path');
        $filename = I('get.filename');
        $currentfile_path = $path.'/current.txt';
        $current_file = file_get_contents($currentfile_path);
        if($is_mobile){
            $this->display('m_show_article');
        }
        $this->assign('filename',$filename);
        $this->assign('file',$current_file);
        $this->display('show_article');

    }

    public function upload(){
        $this->display('upload_file');
    }

    /*
     * 百度ueditor 插件
     */
    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }


    public function get_editor(){
        $content = I('get.content');
        $content = trim($content,'&lt/;pg');
        file_put_contents('D:/wamp/www/lero/1/Uploads/0e1604ws/test.txt',$content);
    }

    /*
     *
     */
    public function writing(){
        $username = session('user_name');
        $user = D('user');
        $content = file_get_contents('D:/wamp/www/lero/1/Uploads/0e1604ws/test.txt');
        $this->assign('content_save',$content);
        $this->display('writing');
    }

    public function ajax_save(){
        $post =I('post.content');
        $post = trim($post,'&lt/;pg');
        file_put_contents('D:/wamp/www/lero/1/Uploads/0e1604ws/test.txt',$post,FILE_APPEND|LOCK_EX);

    }

}