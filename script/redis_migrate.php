<?php
 $redis 	= new Redis();
$redis->connect('127.0.0.1',6379);
$mysql_conn= mysql_connect("localhost","root",'');
if (!$mysql_conn) {
	die('connect fail '.mysql_error());
}
mysql_query("set character set 'utf8'");
mysql_select_db("thinkphp",$mysql_conn);

	

//user表
$user_keys = $redis->keys('user*');
foreach ($user_keys as $key) {
	if($redis->exists($key)){
		$redis->delete($key);
		echo $key." delete success".PHP_EOL;
	}else{
		die('delete table user keys not exists');
	}
}
// die();
$sql  	= 'select * from user';
$result	= mysql_query($sql);
while($user_res = mysql_fetch_array($result)){
	$redis->set('user:uid:username:'.$user_res['uid'],	$user_res['username']);
	$redis->set('user:uid:password:'.$user_res['uid'],	$user_res['password']);
	$redis->set('user:uid:mobile:'  .$user_res['mobile'],$user_res['mobile']);
	echo 'user_res'.$user_res['uid'].'update success'.PHP_EOL;
}
mysql_free_result($result);
echo "table user update success".PHP_EOL;

//guanyintea表
$guanyintea_keys = $redis->keys('guanyintea*');
foreach ($guanyintea_keys as $key) {
	if ($redis->exists($key)) {
		$redis->delete($key);
		echo $key." delete success ".PHP_EOL;
	}else{
		die('delete table guanyintea key not exists');
	}
}
$sql	= 'select * from guanyintea';
$result = mysql_query($sql);
$i=0;
while ($guanyintea_res = mysql_fetch_array($result)) {
	$redis->set('guanyintea:product_id:title:'	  	.$guanyintea_res['product_id'],$guanyintea_res['title']);
	$redis->set('guanyintea:product_id:old_price:'	.$guanyintea_res['product_id'],$guanyintea_res['old_price']);
	$redis->set('guanyintea:product_id:new_price:'	.$guanyintea_res['product_id'],$guanyintea_res['new_price']);
	$redis->set('guanyintea:product_id:subhead:'  	.$guanyintea_res['product_id'],$guanyintea_res['subhead']);
	$redis->set('guanyintea:product_id:weight:'   	.$guanyintea_res['product_id'],$guanyintea_res['weight']);
	$redis->set('guanyintea:product_id:product_num:'.$guanyintea_res['product_id'],$guanyintea_res['product_num']);
	if ($guanyintea_res['is_show']==1) {
		$redis->zAdd('guanyintea:is_show:product_id:1:',$i,$guanyintea_res['product_id']);
	}else{
		$redis->zAdd('guanyintea:is_show:product_id:0:',$i,$guanyintea_res['product_id']);
	}
	echo 'guanyintea '.$guanyintea_res['product_id'].' update success'.PHP_EOL;
	$i++;
}
mysql_free_result($result);
echo 'table guanyintea update success '.PHP_EOL;
mysql_close($mysql_conn);
echo('update success');