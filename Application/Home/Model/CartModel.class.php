<?php
namespace Home\Model;
use Think\Model;


class CartModel extends Model{
    protected $tableName = 'Guanyintea';

    /*
     * 添加购物车
     */
    public function add_cart(){
        $product_id = I('product_id');
        $product_num = I('product_num');
        if(empty($product_id) || empty($product_num)){
            return $data[10001]['product_num'] = 'param error';
        }
        $cartinfo = session('cart_info')?session('cart_info'):array();
        $tea = M('Guanyintea');
        $title = $tea->where('product_id=%d',$product_id)->field('title')->select();
        if(empty($cartinfo)){
            $data[$product_id]['product_num'] = $product_num;
            $data[$product_id]['title']        = $title[0]['title'];
        }else{
            foreach($cartinfo as $key =>$value){
                if($key == $product_id){//添加session中存在的商品，商品数量添加
                    $data[$key]['product_num']    = $product_num+$value['product_num'];
                    $data[$key]['title']  = $title[0]['title'];
                    $data[$key]['total_num']         += $data[$key]['product_num'];
                }else {//添加session中不存在的商品
                    $data[$key]['product_num']   = $product_num;
                    $data[$key]['title']          = $title[0]['title'];
                    $data[$key]['total_num']         += $data[$key]['product_num'];
                }
            }
        }
        session('cart_info',$data);
        return session('cart_info');

    }


    public function del(){
        session('cart_info',null);
    }
}
