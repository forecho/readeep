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
        $weixin->makeEvent();
        $msgType = empty($weixin->msg->MsgType) ? '' : strtolower($weixin->msg->MsgType);
        // 获得用户发过来的消息
        $content = $weixin->msg->Content;
        $createTime = $weixin->msg->CreateTime;

 		// 获取 open_id
        $open_id = $weixin->msg->FromUserName;
        $uid = $this->_isUser($open_id, $id, $createTime, $content);

        switch ($msgType) {
            case 'text':
                //你要处理文本消息代码
            	echo $weixin->makeText($uid);
            	// echo $weixin->makeText(Yii::app()->session['uid']);
            	// echo $weixin->makeText($open_id);
                // 优先文本关键字回复
                $item = $this->_text($content, $id);
                if ($item) {
                    // 如果有匹配到
                    echo $weixin->makeText($item);
                }else{
                    // 图文回复
                	$item = $this->_search($content, $open_id, $weixin_set->admin_id);
                	echo $weixin->makeNews($item);
                }
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
    private function _isUser($open_id, $weixin_id, $createTime='', $content='')
    {
    	$data = Users::model()->find(
    		'open_id=:openId AND weixin_id=:weixinId',
    		array(':openId'=>$open_id, ':weixinId'=>$weixin_id)
    	);
    	if (!$data) {
            // 添加用户
            //$userInfo = $this->getUserInfo($weixin_id, $createTime='', $content='');
    		$model = new Users;
			$model->open_id = $open_id;
            $model->weixin_id = $weixin_id;
       //      if ($userInfo) {
       //          $model->fake_id = $userInfo['fakeid'];
    			// $model->username = $userInfo['nick_name'];
       //      }
			if($model->save()){
				return Yii::app()->session['uid'] = $model->attributes['id'];
			}
    	} else {
            if(!$data->fake_id){
                // 更新用户
                $userInfo = $this->getUserInfo($weixin_id, $createTime='', $content='');
                if ($userInfo) {
                    $data->fake_id = $userInfo['fakeid'];
                    $data->username = $userInfo['nick_name'];
                    $data->save();
                }
			}
            // 登录次数 == 发送消息数
            $data->saveCounters(array('login_count'=>1));
            return Yii::app()->session['uid'] = $data->id;
    	}
    }

    // 得到用户Fakeid
    private function getUserInfo($weixin_id, $createTime='', $content='')
    {
        Yii::import('ext.wxapi.include.WeiXinApi');
        $option = Options::model()->find(
            '`key`=:key AND `weixin_id`=:weixinId',
            array(':key'=>'login', ':weixinId'=>$weixin_id)
        );
        $login = json_decode($option->value, true);
        $weixin->makeText($login['account']);
        $wxConfig = array(
            'account' => $login['account'],
            'password' => $login['password'],
            'cookiePath' => Yii::getPathOfAlias('application').'/runtime/'.$login['account'].'-cookie', // cookie缓存文件路径
            'webTokenPath' => Yii::getPathOfAlias('application').'/runtime/'.$login['account'].'-webToken', // webToken缓存文件路径
        );
        $wxapi = new WeiXinApi($wxConfig);
        // 得到用户Fakeid
        return $wxapi->getLatestMsgByCreateTimeAndContent($createTime, $content);
    }

    // 文本回复
    private function _text($content, $admin_id)
    {
        $criteria = new CDbCriteria;
        $criteria->addSearchCondition('keyword', $content);
        $criteria->addCondition("type=1");
        $criteria->addCondition("admin_id=".$admin_id);
        $data = WeixinReply::model()->find($criteria);
        return $data->content;
    }


    // 图文回复
    private function _search($content, $open_id, $admin_id)
    // public function actionSearch($content='')
    {
    	$type = substr($content, 0, 1 );
    	$iMsg = substr($content, 1 );

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
                $count = PostTags::model()->count('name=:name', array(':name'=>$content));
                if ($count) {
                    $criteria->addSearchCondition('tags', $content);
                    $criteria->limit = 5;
                } else {
                    $criteria->addSearchCondition('title', $content);
                    $criteria->limit = 5;
                }
    			break;
    	}
        $criteria->addCondition("status=1");
    	$criteria->addCondition("admin_id=".$admin_id);
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