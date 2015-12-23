<?php
namespace Home\Model;
use Think\Model;

/*
 * TODO 将参数检测抽出，封装成固定方法
 */
class CartModel extends Model{
    protected $tableName = 'Guanyintea';

    /*
     * 修改购物车中商品信息
     * param product_num_ajax 商品数量，不存在时获取上传参数
     * param product_id-Ajax  商品id，不存在时获取上传参数
     * param change  当商品存在时是否按照 product_num设置信息，true为是 ，默认false
     */
    public function modify_cart($product_id_ajax='',$product_num_ajax='',$change=false){
        $product_id  = $product_id_ajax     ?   $product_id_ajax   : I('product_id');
        $product_num = $product_num_ajax    ?   $product_num_ajax  : I('product_num');

        if(empty($product_id) || empty($product_num)){
            return $data[10001]['product_num'] = 'param is empty';
        }

        $cartinfo = session('cart_info')?session('cart_info'):array();
        $title    = $this->get_product_info($product_id);

        if(empty($cartinfo)){
            $data[$product_id]['product_num'] = $product_num;
            $data[$product_id]['title']        = $title[0]['title'];
        }else{
            foreach($cartinfo as $key =>$value){
                if($key == $product_id){//添加session中存在的商品，商品数量添加
                    if($change){//是否根据product_num 设置商品数量
                        $data[$key]['product_num']    = $product_num;
                    }else {
                        $data[$key]['product_num'] = $product_num + $value['product_num'];
                    }
                    $data[$key]['title']           = $title[0]['title'];
//                    $data[$key]['total_num']      += $data[$key]['product_num'];
                }else {//添加session中不存在的商品
                    $data[$product_id]['product_num']   = $product_num;
                    $data[$product_id]['title']          = $title[0]['title'];
//                    $data[$product_id]['total_num']     += $data[$key]['product_num'];
                }
            }
        }
        $data =$this->array_merge_key_exist($cartinfo,$data);
//        $data = $cartinfo + $data;// 多商品开关
//        $data = array_merge($data,$cartinfo);//array_merge 会将键名覆盖然后按数字增加排序
        session('cart_info',$data);
        return session('cart_info');
    }

    /*
     * 合并数组，当两个数字中的key一致时后面的数值将会覆盖前一个
     */
    public function array_merge_key_exist($array1,$array2){
        $array1 += $array2;
        foreach($array1 as $key1 =>$value1){
            foreach ($array2 as $key2 => $value2) {
                if($key1 == $key2){
                    $array1[$key1] = $array2[$key2];
                }
            }
        }
        return $array1;
    }

    /*
     * 获取商品的信息
     */
    public function get_product_info($product_id){
        $cartinfo = session('cart_info')?session('cart_info'):array();
        $tea = M('Guanyintea');
        $result = $tea->where('product_id=%d',$product_id)->select();
        if(!$result){
            return false;
        }
        return $result;
    }

    public function del(){
        session('cart_info',null);
    }
}
