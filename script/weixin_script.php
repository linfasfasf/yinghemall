<?php
error_reporting(-1);
main();

$redirect_url = '';
function main(){
	global $redirect_url;
	$uuid = getUUID();
	
	$tip  = show_QRImage($uuid);
	while (($code =wait_for_login($tip,$uuid))!='200') {
		if ($code == '201') {
			$tip = 0;
		}
	}
	echo $redirect_url;
		

}
function getUUID(){
	
	$url ='http://login.weixin.qq.com/jslogin';
	$param  = array(
		'appid'=> 'wx782c26e4c19acffb',
        'fun'=>'new',
        'lang'=>'zh_CN',
        '_'=>time(),
	);

	$url = $url.'?'.http_build_query($param);
	$ch	= curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 6);
	$result	=	curl_exec($ch);
	if (curl_errno($ch)) {
		var_dump(curl_getinfo($ch,CURLINFO_HTTP_CODE));
		curl_close($ch);
	} else {
		preg_match("/window.QRLogin.code = (\d+)/", $result,$match);
		$code = $match[1];
		preg_match('/window.QRLogin.uuid = "(\S+?)"/', $result,$match1);
		$uuid = $match1[1];
		curl_close($ch);
		if ($code == 200) {
			return $uuid;
		} else {
			return false;
		}
	}
}

function show_QRImage($uuid){
	$url = 'http://login.weixin.qq.com/qrcode/'.$uuid;
	$params = array(
		't' => 'webwx', 
		'_' =>	time(),
		);
	$url = $url.'?'.http_build_query($params);
	$image	= file_get_contents($url);
	$path = implode("/",explode("\\", dirname(__FILE__)));
	if (file_exists($file = $path.'/qrImage.jpg')) {
		unlink($file);
	} 
	file_put_contents($file, $image,LOCK_EX);
	exec($file);
	return $tip =1;
}

function wait_for_login($tip,$uuid){
	global $redirect_url;
	$url = 'http://login.weixin.qq.com/cgi-bin/mmwebwx-bin/login?tip='.$tip.'&uuid='.$uuid.'&_='.time();
	echo $url;
	echo "test";
	$result = file_get_contents($url);
	preg_match('/window.code=(\d+);/', $result,$match);
	$code = $match[1];
	echo "test2";
	if ($code == '201') {
		echo '成功扫描,请在手机上点击确认以登录'.PHP_EOL;
		
	} elseif ($code == '200') {
		printf("正在登陆");
		preg_match('/window.redirect_uri="(\S+?)"/',$result, $match1);
		$redirect_url = $match1[1].'&fun=new';
		// echo $redirect_url;

	}
	return $code;
}
function login(){
	global $redirect_url;
	$xml = file_get_contents($redirect_url);

}
	
