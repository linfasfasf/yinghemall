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
     *  12/23 修改逻辑，
     * 1.当购物车中无商品时，将信息直接添加进购物车
     * 2，当购物车中有商品，且添加的商品与购物车一致时，此时点击购买，数量不增加，此为防止购物车界面刷新自动增加商品数量
     * 3当购物车中有商品，且添加的商品与购物车中不一致时，此时会将新商品添加到购物车中
     */
    public function buy_now(){
        $product_num = I('product_num');
        $product_id  = I('product_id');

        if(empty($product_num) ||empty($product_id)){
            $this->ajaxReturn('param error');
        }
        $pay_data   = array();
        $total_num  = 0;

        $cart_info  = session('cart_info');
        $cart       = D('Cart');
        $tea        = D('Guanyintea');

        //是否是第一次添加商品
        if(empty($cart_info)){
            $data     = $cart->modify_cart();
            $tea_info  = array();
            foreach($data as $key_product_id =>$value){
                $tea_info = $tea->get_product_by_id_return_arr($key_product_id);
                foreach($tea_info as $product_detail){
                    $pay_num  = $product_detail['new_price'] * $value['product_num'];
                    $pay_data       = $pay_data+array($key_product_id=>$pay_num);//用+键名才不会重新编号
                    $total_num  = $total_num + $pay_num;
                    $cart_info[$key_product_id] = $product_detail;
                    $cart_info[$key_product_id]['product_num'] = $product_num;
                }
            }
            $pay_data['total_num']  = $total_num ;
            $pay_data['num']         = count($cart_info);
            $this->assign('pay_info',$pay_data);
            $this->assign('product_info',$cart_info);
        }else{
            if(!array_key_exists($product_id,$cart_info)){
                $data       = $cart->modify_cart();//将商品信息添加一次
            }else{
                $data       = session('cart_info');//如果购物车中有商品则不再添加商品信息到购物车，防止刷新购物车界面商品自动增加
            }
            $pay_num    = 0;
            $tea_info   = array();

            foreach($data as $key_product_id =>$value){
                $tea_info = $tea->get_product_by_id_return_arr($key_product_id);//将商品信息获取拼接成数组
                foreach($tea_info as $product_detail){
                    $pay_num = $product_detail['new_price'] * $value['product_num'];
                    $pay_data       = $pay_data+array($key_product_id=>$pay_num);//用+键名才不会重新编号
                    $total_num  = $total_num + $pay_num;
                    $data[$key_product_id]['new_price']       = $product_detail['new_price'];
                    $data[$key_product_id]['title']            =  $product_detail['title'];
                    $data[$key_product_id]['product_num']     =  $value['product_num'];
                }
            }
            $pay_data['total_num']  = $total_num ;
            $pay_data['num']         = count($data);
            $this->assign('pay_info',$pay_data);
            $this->assign('product_info',$data);
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
        $data      = array();
        $total_num = 0;
        foreach ($cart_info as $item=>$value) {
            $tea_info  = $tea->get_product_by_id_return_arr($item);
            foreach($tea_info as $product_id => $product_detail){
                $pay_num = $product_detail['new_price'] * $value['product_num'];
                $data       = $data+array($item=>$pay_num);//用+键名才不会重新编号
                $total_num  = $total_num + $pay_num;
                $cart_info[$item]['new_price'] = $product_detail['new_price'];
            }
        }
        $data['total_num']  = $total_num ;
        $data['num']         = count($cart_info);
        $this->assign('pay_info',$data);
        $this->assign('product_info',$cart_info);
        $this->assign('session_info',session('cart_info'));
        $this->display('Index/cart');
    }


    /*
     * 获取购物车信息
     */
    public function get_cart_info_ajax(){
        $cart_info  =   session('cart_info');
        $total_product_num    =   0;
        foreach($cart_info as $cart_info_detail){
            $total_product_num    =   $total_product_num + $cart_info_detail['product_num'];
        }
        $data   = $cart_info + array('total_num'=>$total_product_num);

        $this->ajaxReturn($data);
    }

    /*
     * 获取推荐商品信息，默认4个
     */
    public function product_suggest($num=4){
        $tea = D('guanyintea');
        return $info = $tea->product_suggest($num);
    }

    /*
     * Ajax添加到购物车,show_msg 界面
     */
    public function add_cart_ajax(){
        $tea = D('Cart');
        $product_id     = I('product_id');
        $product_num    = I('product_num');
        $tea->modify_cart($product_id,$product_num,true);
        return $this->get_cart_info_ajax();
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
        $cart_info  = $cart->modify_cart();

        foreach ($cart_info as $item =>$value) {
            $product_info = $tea->get_product_by_id_return_arr($item);
            foreach($product_info as $product_detail){
                $pay_num = $product_detail['new_price'] * $value['product_num'];
                $data = $data+array($item=>$pay_num);//用+键名才不会重新编号
            }
        }
        $this->ajaxReturn($data);
    }

    /*
     * 根据修改商品数量，返回商品的支付价格以及所有商品的支付金额
     */
    public function modify_product_num_ajax(){
        $product_num_ajax    =  I('product_num_ajax');
        $product_id_ajax     =  I('product_id_ajax');
        $cart                =  D('Cart');
        $tea                 =  D('Guanyintea');
        $data                =  array();
        $total_num           =  0;

        $cart_info = $cart->modify_cart($product_id_ajax,$product_num_ajax,true);
        foreach($cart_info as $item =>$value){
            $product_info   =   $tea->get_product_by_id_return_arr($item);
            foreach($product_info as $product_detail){
                $pay_num    = $product_detail['new_price'] * $value['product_num'];
                $data       = $data+array($item=>$pay_num);//用+键名才不会重新编号
                $total_num  = $total_num + $pay_num;
            }
        }
        $data   = $data + array('total_num'=>$total_num);
        $this->ajaxReturn($data);
    }

    /*
     *
     */
    public function del_product(){
        $product_id     = I('product_id');
        $cart_info      = session('cart_info');

        if(empty($product_id) || !array_key_exists($product_id,$cart_info)){
            return 'del product error';
        }

        foreach($cart_info as $key =>$value){
            if($key == $product_id){
                unset($cart_info[$key]);
            }
        }
        session('cart_info',$cart_info);

        $this->cart_info();
        exit();
    }

    /*
     *  TODO 获取商品的支付金额
     *  抽出是否有意义？是否只是加大消耗而已
     */
    protected function get_pay_num(){

    }

    public function test(){
        $this->ajaxReturn('1');
    }
}
