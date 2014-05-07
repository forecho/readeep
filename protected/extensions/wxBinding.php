<?php

echo "自动绑定DEMO开始:<br/>";

$appAccount = 'xxx';
$appPasswd = 'xxx';

$demo = new demo();

//处理Cookie
$demo->cookieName = $appAccount.'-cookie.txt';
$file = $demo->cookieName;
$data = '';
file_put_contents($file, $data);

$ch = $demo->init($appAccount, $appPasswd, $demo->cookieName);
echo $demo->callBack['redirect_url'].'<br/>';

//获取Token
$tokenRaw = explode('&token=', basename($demo->callBack['redirect_url']));
$token = $tokenRaw[1];
var_dump($token.'<br/>');

echo "获取微信相关认证信息appid，appkey 等";
$wxInfo = $demo->getWxInfo($ch, $token);
echo "<pre>";
print_r($wxInfo);
echo "<hr>";
//打开开发者模式
$htmlRaw = $demo->openAdvancedSwitch($ch, 1, $token, 2, $demo->cookieName);
print_r($htmlRaw.'<br/>');
$html = strpos($htmlRaw, 'ok') != null ? true : false;
if($html == true) {
	echo "打开开发者模式".'<br/>';
} else {
	echo "打开开发者模式失败".'<br/>';
}

//设置回调
$backurl = 'http://www.readeep.com/index.php?r=api/weixin&id=1';
$callback_token = 'forecho';
$type = 2;
$set = $demo->setCallbackProfile($ch, $backurl, $callback_token, $token, $type);
$html = strpos($set , '"ret":"0"') != null ? true : false;
if ($html) {
	echo "智能绑定成功!";
} else {
	echo "智能绑定失败! 请30秒后重试! 请勿频繁操作!";
}
var_dump($set.'<br/>');
var_dump($html);

exit('end');

class demo {
	var $appAccount = 'xxx';
    var $appPasswd = 'xxx';
	var $callBack = array();
	var $cookieFileName = '';

	/**
	 * 登录微信后台
	 */
	function init($appAccount, $appPasswd, $cookieFileName) {
		$url = "https://mp.weixin.qq.com/cgi-bin/login?lang=zh_CN";
		$post["username"] = $appAccount;
		$post["pwd"] = md5($appPasswd);
		$post["f"] = "json";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:28.0) Gecko/20100101 Firefox/28.0');
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3000);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFileName);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_REFERER, 'http://mp.weixin.qq.com/');
		$this->callBack = curl_exec($ch);
		if ($this->callBack === FALSE) {
			echo "cURL Error: " . curl_error($ch);
		}
		$this->callBack = json_decode($this->callBack, true);
		//curl_close($ch);
		return $ch;
	}

	// /**
	//  * 开启高级模式 $flag = 1 ,关闭＝0；
	//  */
	function openAdvancedSwitch($ch,$flag,$token,$type, $cookieFileName){
		$url = "https://mp.weixin.qq.com/misc/skeyform?form=advancedswitchform&lang=zh_CN";
		$post["flag"] = $flag;
		$post["token"] = $token;
		$post["type"] = $type;
		$post["f"] = "json";
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:28.0) Gecko/20100101 Firefox/28.0');
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFileName);
		curl_setopt($ch, CURLOPT_REFERER, 'https://mp.weixin.qq.com/misc/skeyform?form=advancedswitchform&lang=zh_CN');
		$html = curl_exec($ch);
		//curl_close($ch);
		return $html;
	}

	/**
	 * 设置接管高级模式的地址
	 */
	function setCallbackProfile($ch,$backurl,$callback_token,$token,$type){
		// $url = "https://mp.weixin.qq.com/advanced/callbackprofile?t=ajax-response&token=".$token."&lang=zh_CN";
		$url = "https://mp.weixin.qq.com/advanced/callbackprofile?t=ajax-response&lang=zh_CN";
		$post["callback_token"] = $callback_token;
		$post["url"] = $backurl;
		$post["token"] = $token;
		$post["type"] = $type;
		$post["f"] = "json";
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_REFERER, 'https://mp.weixin.qq.com/misc/skeyform?form=advancedswitchform&lang=zh_CN');
		$html = curl_exec($ch);
		curl_close($ch);
		return $html;
	}


	/**
	 * 获取微信相关认证信息appid，appkey 等
	 */
	function getWxInfo($ch, $token){
		$url = "https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=".$token."&lang=zh_CN&f=json";
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPGET, 1);
		curl_setopt($ch, CURLOPT_REFERER, '	https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token='.$token.'&lang=zh_CN');
		$html = curl_exec($ch);
		$arr = json_decode($html,true);
		return $arr;
	}
}