<?php

class SiteController extends Controller
{
	private $_weixinToken = "forecho";

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
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
        
        $item['items'][0]['title'] = "hello";
    	$item['items'][0]['description'] = "美图";
    	$item['items'][0]['picurl'] = "http://img.weimob.com/static/19/98/8b/image/20131112/20131112113604_35285.jpg";
    	$item['items'][0]['url'] = "http://www.baidu.com";

    	$weixin->init();
        $reply = '';
        $msgType = empty($weixin->msg->MsgType) ? '' : strtolower($weixin->msg->MsgType);
        // 获得用户发过来的消息
        $type = intval($weixin->msg->Content);
		// var_dump($weixin->msg);

        switch ($msgType)
        {
        case 'text':
        	echo $weixin->makeText($type);
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

    // 模拟登录微信发消息
    public function actionSend()
    {
    	Yii::import('ext.login.LoginWeixin');
    	$arr = array(
			'account' => '',
			'password' => ''
		);
		$w = new LoginWeixin($arr);
		var_dump($w->getAllUserInfo());//获取所有用户信息
		$a = $w->sendMessage('群发内123123123容');
    }


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}