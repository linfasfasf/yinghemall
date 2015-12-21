<?php
namespace Home\Model;
use Think\Model;


class GuanyinteaModel extends Model{

    /*
     * 展示茶叶信息
     */
    public function get_product_info_index($len){
        $tea = M('Guanyintea');
        return $tea->where("is_show=1")->limit($len)->select();

    }
    /*
     * 获取所有商品数量
     */
    public function get_product_total_num(){
        $tea = M('Guanyintea');
        if(!$count = $tea->count('id')){
            return false;
        }
        return $count;
    }

    /*
     * 获取固定数量的商品信息
     */
    public function get_product_info_page($page,$len){
        $tea = M('Guanyintea');
        return $tea->where('is_show=1')->limit((($page-1)*$len),$len)->select();
    }

    /*
     * 根据id获取商品信息
     */
    public function get_product_by_id(){
        $product_id = I('product_id');
        $tea = M('Guanyintea');
        $tea_info = $tea->where('product_id =%d',$product_id)->select();
        if(empty($tea_info)){
            return false;
        }
        return $tea_info[0];
    }

    /*
     * 根据传入的id查找商品信息
     */
    public function get_product_by_id_return_arr($product_id){
        $tea =M('Guanyintea');
        return $tea->where('product_id =%d',$product_id)->select();
    }

    /*
     * 推荐商品
     * return array
     */
    public function product_suggest($num){
        $tea = M('Guanyintea');
        $info = $tea->where('is_show=%d',1)->field('product_id,new_price,title')->limit($num)->select();
        return $info;
    }

    public function order_by($len){
        $order  = I('order');
        $dir    = I('dir');
        $tea    = M('Guanyintea');
        $result = $tea->where('is_show=%d',1)->order(array($order=>$dir))->limit($len)->select();
        return $result;
    }

}
