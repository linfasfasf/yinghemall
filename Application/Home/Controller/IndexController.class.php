<?php
namespace Home\Controller;
use Think\Cache\Driver\Redis;
use Think\Controller;
use Think\Cache;
class IndexController extends Controller {

    /*
     * 显示首页信息
     */
    public function index(){
        $tea = D('Home/Guanyintea');
        $len = C('PAGE_SHOW_NUM');
        $product_info = $tea->get_product_info_index_redis($len);
        $count        = $tea->get_product_total_num_redis();
        if(count($product_info)==0 && $count ==0){
            die('get message error');
        }
        $this->assign('current_page',$p=1);
        $this->assign('total_product',$count);
        $this->assign('total_page_add',intval(ceil($count/6)+1));
        $this->assign('product_info',$product_info);
        $this->display();
        
    }

    /*
     * 首页商品信息显示下一页
     */
    public function next_page(){
        $page = I('get.p');
        $tea = D('Home/Guanyintea');
        $len =C('PAGE_SHOW_NUM');
        $product_info = $tea->get_product_info_page_redis($page,$len);
        $count        = $tea->get_product_total_num_redis();
        if(count($product_info)==0 && $count ==0){
            $product_info = '';
        }
        $this->assign('current_page',$page);
        $this->assign('total_product',$count);
        $this->assign('total_page_add',intval(ceil($count/6)+1));
        $this->assign('product_info',$product_info);
        $this->display('index');
    }

    public function order_by(){
        $tea          = D('Guanyintea');
        $len          = C('PAGE_SHOW_NUM');
        $product_info = $tea->order_by_redis($len);
        $count        = $tea->get_product_total_num_redis();

        $this->assign('current_page',$p=1);
        $this->assign('total_product',$count);
        $this->assign('total_page_add',intval(ceil($count/6)+1));
        $this->assign('product_info',$product_info);
        $this->display('index');
    }


    public function show_msg(){
        I('get.p');

        $this->display();
    }

    public function testajax(){
        $product_id = I('value');
        echo 1;
    }


    public function test(){
        $user = D('guanyintea');
        $res = $user->order_by_redis(5);
        var_dump($res);
        $result = $user->order_by(5);
        var_dump($result);
    }

}