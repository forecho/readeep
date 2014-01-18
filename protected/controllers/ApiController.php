<?php

class ApiController extends Controller
{
	private $_weixinToken = "forecho";

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionWeixin()
    {
        $weixin = new Weixin($_GET);
        $weixin->token = $this->_weixinToken;
        $weixin->debug = true;

        //网址接入时使用
        if (isset($_GET['echostr']))
        {
            $weixin->valid();
        }

    	$weixin->init();
        $reply = '';
        $msgType = empty($weixin->msg->MsgType) ? '' : strtolower($weixin->msg->MsgType);
        // 获得用户发过来的消息
        $msg = $weixin->msg->Content;
		// var_dump($weixin->msg);

        switch ($msgType)
        {
        case 'text':
        	$item = $this->_search();
        	// echo $weixin->makeText($msg);
        	echo $weixin->makeNews($item);
            //你要处理文本消息代码
            break;
        case 'image':
        	echo "image";
            //你要处理图文消息代码
            break;
        case 'location':
        	echo "location";
            //你要处理位置消息代码
            break;
        case 'link':
        	echo "link";
            //你要处理链接消息代码
            break;
        case 'event':
        	echo "event";
            //你要处理事件消息代码
            break;
        default:
        	echo "无效";
            //无效消息情况下的处理方式
            break;
        }
        $weixin->reply($reply);
    }

    public function _search($value='')
    {
    	$item['items'][0]['title'] = "hello";
    	$item['items'][0]['description'] = "美图";
    	$item['items'][0]['picurl'] = "http://img.weimob.com/static/19/98/8b/image/20131112/20131112113604_35285.jpg";
    	$item['items'][0]['url'] = "http://www.baidu.com";
    	return $item;
    }


}