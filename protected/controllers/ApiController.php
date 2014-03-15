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
        // 微信事件操作
        echo $weixin->makeEvent();
        $msgType = empty($weixin->msg->MsgType) ? '' : strtolower($weixin->msg->MsgType);
        // 获得用户发过来的消息
        $msg = $weixin->msg->Content;

        $rawid = $weixin->msg->ToUserName;
        $admin = WeixinSet::model()->find('rawid=:rawid', array(':rawid'=>$rawid));
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
            // 优先文本关键字回复
            $item = $this->_text($msg, $admin->admin_id);
            if ($item) {
                // 如果有匹配到
                echo $weixin->makeText($item);
            }
            // 图文回复
        	$item = $this->_search($msg, $open_id, $admin->admin_id);
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

    // 文本回复
    public function _text($msg, $admin->admin_id)
    {
        return '测试';
        $criteria = new CDbCriteria;
        $criteria->addSearchCondition('keyword', $msg);
        $criteria->addCondition("type=1");
        $criteria->addCondition("$admin_id=".$admin_id);
        $data = WeixinReply::model()->find($criteria);
        return $data->content;
    }


    // 图文回复
    public function _search($msg, $open_id, $admin_id)
    // public function actionSearch($msg='')
    {
    	$type = substr($msg, 0, 1 );
    	$iMsg = substr($msg, 1 );

		$criteria = new CDbCriteria;
    	switch ($type) {
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
                $criteria->limit = $type;
                break;
    		case '%':
    			$criteria->addSearchCondition('title', $iMsg);
                $criteria->limit = 5;
    			break;
    		case '#':
    			$criteria->addSearchCondition('tags', $iMsg);
                $criteria->limit = 5;
    			break;
    		default:
                // 优先匹配关键字回复 再匹配文本回复
                $count = PostTags::model()->count('name=:name', array(':name'=>$msg));
                if ($count) {
                    $criteria->addSearchCondition('tags', $msg);
                    $criteria->limit = 5;
                } else {
                    $criteria->addSearchCondition('title', $msg);
                    $criteria->limit = 5;
                }
    			break;
    	}
        $criteria->addCondition("status=1");
    	$criteria->addCondition("$admin_id=".$admin_id);
    	$criteria->addCondition("create_time<".time());
		$criteria->order = 'create_time DESC';
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