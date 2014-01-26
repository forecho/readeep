<?php

class ApiController extends Controller
{
	public function actionWeixin($id)
    {
        $weixin_set = WeixinSet::model()->findByPk($id);
        $weixin = new Weixin($_GET);
        $weixin->token = $weixin_set->token;
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

        $rawid = $weixin->msg->ToUserName;
        $admin = WeixinSet::model()->find('rawid=:rawid', array('rawid'=>$rawid));
		// var_dump($weixin->msg);

 		// 获取 open_id
        $open_id = $weixin->msg->FromUserName;
        $uid = $this->_isUser($open_id, $admin->admin_id);

        switch ($msgType)
        {
        case 'text':
            //你要处理文本消息代码
        	// echo $weixin->makeText($msg);
        	//echo $weixin->makeText(Yii::app()->session['uid']);
        	// echo $weixin->makeText($open_id);
        	$item = $this->_search($msg, $open_id);
        	echo $weixin->makeNews($item);
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

    /**
     * 判断是否存在 并写入 session
     * 返回写入 session 的用户 id
     */
    public function _isUser($open_id, $admin_id)
    {
    	$data = Users::model()->find(
    		'open_id=:openId AND admin_id=:adminId',
    		array(':openId'=>$open_id, ':adminId'=>$admin_id)
    	);
    	if (!$data) {
    		$model = new Users;
			$model->open_id = $open_id;
			$model->admin_id = $admin_id;
			if($model->save()){
				return Yii::app()->session['uid'] = $model->attributes['id'];
			}
			exit;
    	} else {
    		if($data->save()){
    			// 登录次数 == 发送消息数
    			$data->saveCounters(array('login_count'=>1));
				return Yii::app()->session['uid'] = $data->id;
			}
    	}
    }

    public function _search($msg, $open_id)
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
		    $item['items'][$key]['url'] = Yii::app()->request->hostInfo.'/index.php?r=postPosts/view&id='.$value->attributes['id'].'&oid='.$open_id;
		}
    	// $item['items'][0]['title'] = "hello";
    	// $item['items'][0]['description'] = "美图";
    	// $item['items'][0]['picurl'] = "http://img.weimob.com/static/19/98/8b/image/20131112/20131112113604_35285.jpg";
    	// $item['items'][0]['url'] = "http://www.baidu.com";
    	return $item;
    }


}