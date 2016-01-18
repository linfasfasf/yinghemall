<?php
error_reporting(-1);
define('DEBUG', true);
main();
$skey='';
$wxsid = '';
$wxuin = '';
$pass_ticket = '';
$redirect_url = '';
$My = array();
$ContactList = array();
$baserequest = array();
function main(){
	global $redirect_url,$base_url;
	$uuid = getUUID();
	
	$tip  = show_QRImage($uuid);
	while (($code =wait_for_login($tip,$uuid))!='200') {
		if ($code == '201') {
			$tip = 0;
		}
	}
	echo $redirect_url;
	if(login()){
		printf('login fail');
	}
	$base_url='http://wx.qq.com/cgi-bin/mmwebwx-bin';
	if (!webwxinit()) {
		printf('init fail');
	}
	// getcontact();

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
	$result = file_get_contents($url);
	preg_match('/window.code=(\d+);/', $result,$match);
	$code = $match[1];
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
	global $redirect_url,$baserequest,$skey, $wxsid, $wxuin, $pass_ticket;
	$xml = file_get_contents($redirect_url);
	$xml = simplexml_load_string($xml);
	// print_r($xml);
	$skey = (string)$xml->skey;
	$wxsid = (string)$xml->wxsid;
	$wxuin = (string)$xml->wxuin;
	$pass_ticket = (string)$xml->pass_ticket;
	// var_dump($skey);
	$baserequest  = array(
		'Uin' =>$wxuin,
		'Sid' =>$wxsid,
		'Skey'=>$skey,
		'DeviceID'=>'e000000000000000'
		);
	return true;
}
function webwxinit(){
	global $base_url,$baserequest,$pass_ticket,$skey;
	$json_info = json_encode(array('BaseRequest'=>$baserequest));
	$url = $base_url.'/webwxinit?pass_ticket='.$pass_ticket.'&skey='.$skey.'&r='.time();
	echo $url;
	var_dump($baserequest);

	var_dump($json_info);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json_info);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=UTF-8'));
	$result = curl_exec($ch);
	curl_close($ch);
	// var_dump($result);

	global $My,$ContactList;
	$result  = json_decode($result,true);
	var_dump($result);

	$ErrMsg = $result['BaseResponse']['ErrMsg'];
	$Ret 	= $result['BaseResponse']['Ret'];
	$My 	= $result['User'];
	$ContactList = $result['ContactList'];

	if (DEBUG) {
		var_dump($ContactList);
	}
	if ($Ret != 0) {
		return false;
	}else{
		return true;
	}

}

function getcontact(){
	global $skey,$pass_ticket,$base_url;

	$url = $base_url.'/webwxgetcontact?pass_ticket='.$pass_ticket.'&skey='.$skey.'&r='.time();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// curl_setopt($ch, CURLOPT_POST, 1);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, $jsoninfo);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType: application/json; charset=UTF-8'));
	$result = curl_exec($ch);
	if (DEBUG) {
		var_dump($result);
	}
	$result_decode = json_decode($result,true);
	// var_dump($result_decode);
}

















