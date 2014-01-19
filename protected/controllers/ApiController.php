<?php

class ApiController extends Controller
{
	private $_weixinToken = "forecho";

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
        $username = $weixin->msg->FromUserName;
        $admin = $weixin->msg->ToUserName;
		// var_dump($weixin->msg);

        switch ($msgType)
        {
        case 'text':
        	// echo $weixin->makeText($msg);
        	echo $weixin->makeText($admin);
        	// echo $weixin->makeText($username);
        	// $item = $this->_search($msg);
        	// echo $weixin->makeNews($item);
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

    public function _search($msg='')
    // public function actionSearch($msg='')
    {
    	$type = substr($msg, 0, 1 );
    	$msg = substr($msg, 1 );

		$criteria = new CDbCriteria;
    	switch ($type) {
    		case '%':
    			$criteria->addSearchCondition('title', $msg);
    			break;
    		case '#':
    			$criteria->addSearchCondition('tags', $msg);
    			break;
    		default:
    			# code...
    			break;
    	}
    	$criteria->addCondition("status=1");
    	$criteria->addCondition("create_time<".time());
		$criteria->limit = 10;
		$criteria->order = 'id DESC';
		$data = PostPosts::model()->findAll($criteria);
    	foreach ($data as $key => $value) {
		    $item['items'][$key]['title'] = $value->attributes['title'];
		    $item['items'][$key]['description'] = $value->attributes['excerpt'];
		    $item['items'][$key]['picurl'] = $value->attributes['image'];
		    $item['items'][$key]['url'] = Yii::app()->request->hostInfo.'/index.php?r=postPosts/view&id='.$value->attributes['id'];
		}
    	// $item['items'][0]['title'] = "hello";
    	// $item['items'][0]['description'] = "美图";
    	// $item['items'][0]['picurl'] = "http://img.weimob.com/static/19/98/8b/image/20131112/20131112113604_35285.jpg";
    	// $item['items'][0]['url'] = "http://www.baidu.com";
    	return $item;
    }


}