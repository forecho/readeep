<?php

echo "自动绑定DEMO开始:<br/>";

$appAccount = 'xxx';
$appPasswd = 'xx';

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

$wxInfo = $demo->getWxInfo($ch, $token);
var_dump($wxInfo.'<br/>');
exit();
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
$backurl = 'http://mini.beta.vikduo.com/Api/index/wx/64';
$callback_token = 'k2ocuIVf6Kg0bb1idYzH';
$set = $demo->setCallbackProfile($ch, $backurl, $callback_token, $token);
$html = strpos($set , '"ret":"0"') != null ? true : false;
var_dump($set.'<br/>');
var_dump($html);

exit('end');

class demo {
	var $appAccount = '1157324096';
    var $appPasswd = 'a12345678';
	var $callBack = array();
	var $cookieName = '';

	/**
	 * 登录微信后台
	 */
	function init($appAccount, $appPasswd, $cookieFileName) {
		$url = "https://mp.weixin.qq.com/cgi-bin/login?lang=zh_CN";
		$ch = curl_init($url);
		$post["username"] = $appAccount;
		$post["pwd"] = md5($appPasswd);
		$post["f"] = "json";
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
	function setCallbackProfile($ch,$backurl,$callback_token,$token, $type){
		$url = "https://mp.weixin.qq.com/advanced/callbackprofile?t=ajax-response&lang=zh_CN";
		$post["callback_token"] = $callback_token;
		$post["url"] = $backurl;
		$post["token"] = $token;
		$post["type"] = $type;
		$post["f"] = "json";
		curl_setopt($ch,CURLOPT_URL, $url);
		//curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_HEADER, 1);
		//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:28.0) Gecko/20100101 Firefox/28.0');
		//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
		//curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		//curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch, CURLOPT_REFERER, 'https://mp.weixin.qq.com/misc/skeyform?form=advancedswitchform&lang=zh_CN');
		$html = curl_exec($ch);
		curl_close($ch);
		//var_dump($html);
		return $html;
	}


	/**
	 * 获取微信相关认证信息appid，appkey 等
	 */
	function getWxInfo($ch, $token){
		$url = "https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=".$token."&lang=zh_CN&f=json";

		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_HEADER,0);
		//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:28.0) Gecko/20100101 Firefox/28.0');
		//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
		curl_setopt($ch, CURLOPT_HTTPGET, 1);
		//curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch, CURLOPT_REFERER, '	https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token='.$token.'&lang=zh_CN');
		$html = curl_exec($ch);
		$arr = json_decode($html,true);
		echo "<pre>";
		print_r($arr);
		return $arr['advanced_info']['dev_info'];
	}
}