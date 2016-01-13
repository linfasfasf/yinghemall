<?php
namespace Home\Model;
use Think\Cache\Driver\Redis;
use Think\Model;


class GuanyinteaModel extends Model{

    public function __construct(){
        $this-> redis= $redis = new Redis();
    }

    /*
     * 展示茶叶信息
     */
    public function get_product_info_index($len){
        $tea = M('Guanyintea');
        return $tea->where("is_show=1")->limit($len)->select();
    }
    public function get_product_info_index_redis($len){
        $product_ids = $this->redis->zRange('guanyintea:is_show:product_id:1:',0,$len-1);

        return $this->get_detail_product_ids_redis($product_ids);
    }
    public function get_detail_product_ids_redis($product_ids,$one_dim_array=false){
        if($one_dim_array){
            $result['title']          =   $this->redis->get('guanyintea:product_id:title:'.$product_ids);
            $result['old_price']     =   $this->redis->get('guanyintea:product_id:old_price:'.$product_ids);
            $result['new_price']     =   $this->redis->get('guanyintea:product_id:new_price:'.$product_ids);
            $result['subhead']       =   $this->redis->get('guanyintea:product_id:subhead:'.$product_ids);
            $result['weight']        =   $this->redis->get('guanyintea:product_id:weight:'.$product_ids);
            $result['product_num']  =   $this->redis->get('guanyintea:product_id:product_num:'.$product_ids);
            $result['product_id']   =   $product_ids;
            $result['is_show']       =   1;
        }else{
            foreach($product_ids as $key =>$product_id){
                $result[$key]['title']          =   $this->redis->get('guanyintea:product_id:title:'.$product_id);
                $result[$key]['old_price']     =   $this->redis->get('guanyintea:product_id:old_price:'.$product_id);
                $result[$key]['new_price']     =   $this->redis->get('guanyintea:product_id:new_price:'.$product_id);
                $result[$key]['subhead']       =   $this->redis->get('guanyintea:product_id:subhead:'.$product_id);
                $result[$key]['weight']        =   $this->redis->get('guanyintea:product_id:weight:'.$product_id);
                $result[$key]['product_num']  =   $this->redis->get('guanyintea:product_id:product_num:'.$product_id);
                $result[$key]['product_id']   =   $product_id;
                $result[$key]['is_show']       =   1;
            }
        }
        return $result;
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
    public function get_product_total_num_redis(){
        return $this->redis->zCount('guanyintea:is_show:product_id:1:',0,99999);
    }

    /*
     * 获取固定数量的商品信息
     */
    public function get_product_info_page($page,$len){
        $tea = M('Guanyintea');
        return $tea->where('is_show=1')->limit((($page-1)*$len),$len)->select();
    }
    public function get_product_info_page_redis($page,$len){
        $product_ids = $this->redis->zRange('guanyintea:is_show:product_id:1:',($page-1)*($len),$page*($len-1));
        return $this->get_detail_product_ids_redis($product_ids);
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
    public function get_product_by_id_redis($product_id){
        $product_id = isset($product_id)? $product_id: I('product_id');
        return $this->get_detail_product_ids_redis($product_id,true);
    }

    /*
     * 根据传入的id查找商品信息
     */
    public function get_product_by_id_return_arr($product_id){
        $tea =M('Guanyintea');
        return $tea->where('product_id =%d',$product_id)->select();
    }
    public function get_product_by_id_return_arr_redis($product_id){
        $result = array();
        return $result[0]=array($this->get_product_by_id_redis($product_id));
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
        $order =I('order');$dir   =I('dir');
        $order  = !empty($order) ? $order:'old_price';
        $dir    = !empty($dir)   ? $dir   :'asc';
        $tea    = M('Guanyintea');
        $result = $tea->where('is_show=%d',1)->order(array($order=>$dir))->limit($len)->select();
        return $result;
    }
    public function order_by_redis($len){
        $order =I('order');$dir   =I('dir');
        $order  = !empty($order) ? $order:'old_price';
        $dir    = !empty($dir)   ? $dir   :'asc';
        $res    = $this->redis->zRange('guanyintea:is_show:product_id:1:',0,-1);
        $field  = array('old_price','new_price','title','product_id');
        if(!in_array($order,$field)){
            die('查询字段不存在！');
        }else{
            var_dump($res);
            $get_result_all = array();
            foreach($res as $product_id){
                $new_price = $this->redis->get('guanyintea:product_id:'.$order.':'.$product_id);
                $get_result_all[$product_id] =  $new_price;
            }
            if($dir == 'desc'){
                arsort($get_result_all);
            }else {
                asort($get_result_all);
            }
            $i=0;
            $product_ids=array();
            foreach($get_result_all as $product_id =>$price){
                if($i >= $len){
                    break;
                }else{
                    $i++;
                }
                array_push($product_ids,$product_id);
            }
            return $this->get_detail_product_ids_redis($product_ids);

        }

    }
}
