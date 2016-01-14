<?php
if(!ini_get('safe_mode')){
	set_time_limit(3600);
}
 define("DEBUG", false);
 $debug =true;
error_reporting(-1);
date_default_timezone_set('PRC');
$cids = array(136,139,124,132,134,135,122,112,113,137,133,9,127,4,117,116,115,114,100);//部分未添加
$cid_test = array(136,139,124);

main($cids);
function main($cids){
	$url = 'http://www.789wz.com/Welcome/get_msg';
	foreach ($cids as $cid) {
		$response	= get_response($url,$cid);
		acces_log($cid);	
	}
	acces_log(date("Y-m-d H:i:s"));
	
}

function get_response($url,$cid){
	echo $get_url = $url.'?cid='.$cid;
	$ch	=	curl_init($get_url);
	// curl_setopt($ch,CURLOPT_URL, urlencode($get_url));
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 0);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch,CURLOPT_TIMEOUT, 36);
	$result	= curl_exec($ch);
	curl_close($ch);
	var_dump($result);

	if (curl_errno($ch)) {
		printf("curl error".curl_getinfo($ch)."cid= ".$cid);
		log_message(curl_getinfo($ch,CURLINFO_HTTP_CODE),$cid);
	} else {
		if (DEBUG) {
			log_message($result,$cid);
			return $result;
		} else {
			return $result;
		}
	}
	// var_dump(file_get_contents($get_url));
}


function log_message($curl_getinfo,$cid){
	$path = dirname(__FILE__);

	$path = implode("/",explode("\\", $path)); 
	var_dump($path);
	$file = $path.'/log/'.time().'error.txt';
	printf($file);
	if(!file_exists($file)){
		if (is_dir($path.'/log')) {
			mkdir($path.'/log/');
		}
		
		touch($file);
		chmod($file, 0777);
	}
	file_put_contents($file, 'error_info '.$curl_getinfo.'and  cid= '.$cid.' time ='.time(),FILE_APPEND);
}

function acces_log($msg){
	$path = dirname(__FILE__);
	$path = implode("/",explode("\\", $path)); 
	$file = $path.'/log/acces_log.txt';
	if(!file_exists($file)){
		mkdir($path.'/log/');
		touch($file);
		chmod($file, 0777);
	}
	file_put_contents($file, $msg.' ',FILE_APPEND);
}