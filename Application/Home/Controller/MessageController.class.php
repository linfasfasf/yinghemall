<?php
namespace Home\Controller;
use Think\Controller;
class MessageController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }


    public function index(){

    }

    public function show_msg(){
        $tea = D('Guanyintea');
        $tea_info  = $tea->get_product_by_id();
        $this->assign('product_suggest',$this->product_suggest());

        $this->assign('product_info',$tea_info);
        $this->display('Index/show_msg');
    }

    /*
     * 立即购买，将商品数量添加到session中，根据商品信息计算出支付金额,跳转到下单界面
     */
    public function buy_now(){
        $product_num = I('product_num');
        $product_id  = I('product_id');

        if(empty($product_num) ||empty($product_id)){
            $this->ajaxReturn('param error');
        }

        $cart_info  = session('cart_info');
        $cart       = D('Cart');
        $tea        = D('Guanyintea');

        //是否是第一次添加商品
        if(empty($cart_info)){
            $data     = $cart->add_cart();
            $tea_info  = array();
            foreach($data as $key_product_id =>$value){
                $tea_info = $tea->get_product_by_id_return_arr($key_product_id);
            }
            $pay_num  = $tea_info['new_price']*$data['product_num'];

            $this->assign('product_info',$tea_info);
            $this->assign('pay_num',$pay_num);
        }
        else{
//            $data       = $cart->add_cart();//将商品信息添加一次
            $data       = session('cart_info');//如果购物车中有商品则不再添加商品信息到购物车，防止刷新购物车界面商品自动增加
            $pay_num    = 0;
            $tea_info   = array();
            foreach($data as $key_product_id =>$value){
                $tea_info = array_merge($tea_info,$tea->get_product_by_id_return_arr($key_product_id));//将商品信息获取拼接成数组
                foreach($tea_info as $product_detail){
                    $pay_num += $product_detail['new_price'] * $value['product_num'];
                }
            }
            $this->assign('product_info',$tea_info);
            $this->assign('pay_num',$pay_num);
        }

        $this->assign('session_info',session('cart_info'));//session必须重新取一次
        $this->display('Index/cart');
    }

    /*
     * 显示购物车信息，显示session中的商品信息,跳转到下单界面
     */
    public function cart_info(){
        $cart_info = session('cart_info');
        $tea       = D('Guanyintea');
        $pay_num   = 0;
        foreach ($cart_info as $item=>$value) {
            $tea_info  = $tea->get_product_by_id_return_arr($item);
            foreach($tea_info as $product_detail){
                $pay_num += $product_detail['new_price'] * $value['product_num'];
            }
        }
        $this->assign('pay_num',$pay_num);
        $this->assign('product_info',$tea_info);
        $this->assign('session_info',session('cart_info'));
        $this->display('Index/cart');
    }


    /*
     * 获取购物车信息
     */
    public function get_cart_info_ajax(){
        $this->ajaxReturn(session('cart_info'));
    }

    /*
     * 获取推荐商品信息，默认4个
     */
    public function product_suggest($num=4){
        $tea = D('guanyintea');
        return $info = $tea->product_suggest($num);
    }

    /*
     * Ajax添加到购物车
     */
    public function ajax_add_cart(){
        $tea = D('Cart');
        $data = $tea->add_cart();
        $this->ajaxReturn($data);
    }

    /*
     * 清空购物车，删除session信息
     */
    public function del(){
        $tea = D('Cart');
        $tea->del();
        $this->display('Index/cart');
    }

    public function modify_ajax(){
        $cart       = D('Cart');
        $tea        = D("guanyintea");
        $data       = array();
        $cart_info  = $cart->add_cart();

        foreach ($cart_info as $item =>$value) {
            $product_info = $tea->get_product_by_id_return_arr($item);
            foreach($product_info as $product_detail){
                $pay_num = $product_detail['new_price'] * $value['product_num'];
                $data = $data+array($item=>$pay_num);//用+键名才不会中心编号
            }
        }
        $this->ajaxReturn($data);
    }

    public function test(){
        $this->ajaxReturn('1');
    }
}
