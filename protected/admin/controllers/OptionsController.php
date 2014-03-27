<?php

class OptionsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $cnzzKey = 'A34dfwfF';
	public $cnzzDomain = 'http://wss.cnzz.com/user/companion/shopex.php';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('qiniu','cnzzIndex','cnzzCreate','cnzzView'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionQiniu()
	{
		$model=new QiniuForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$model->attributes=Yii::app()->config->get("qiniu",$model->attributes);
		if(isset($_POST['QiniuForm']))
		{
			$model->attributes=$_POST['QiniuForm'];
	        if($model->validate())
	        {
	           	Yii::app()->config->set("qiniu",$model->attributes);
	           	Yii::app()->user->setFlash('success', "保存成功！");
	           	$this->refresh();
	        }
		}
		$this->render('qiniu',array(
			'model'=>$model,
		));
	}

	public function actionCnzzIndex()
	{
		$data = false;
        $url = false;
		$data = Options::model()->find(
				"`key`=:key AND `weixin_id`=:weixinId",
				array(
					':key'=>'cnzz',
					':weixinId'=>Yii::app()->session['weixin_id']
				)
			);
		var_dump($url);
        if ($data) {
            $value = json_decode($data->value, true);
        	$url = 'http://wss.cnzz.com/user/companion/shopex_login.php?site_id='.$value['cnzzUser'].'&password='.$value['cnzzPass'];
        }

		$this->render('cnzz_index',array(
			'data'=>$data,
			'url'=>$url,
		));
	}

	public function actionCnzzCreate()
	{
		$url = false;
		$data = Options::model()->find(
				"`key`=:key AND `weixin_id`=:weixinId",
				array(
					':key'=>'cnzz',
					':weixinId'=>Yii::app()->session['weixin_id']
				)
			);
        if ($data) {
        	$this->index();
            exit();
        }

        $domain = $_SERVER['HTTP_HOST'];
		$key = md5($domain.$this->cnzzKey);

        $val = file_get_contents($this->cnzzDomain.'?domain='.$domain.'&key='.$key);
        if(!empty($val)){
        	$option = new Options;
            $data = array();
            $arr = explode('@', $val);
            $option->key = 'cnzz';
            $info['cnzzUser'] = $arr[0];
            $info['cnzzPass'] = $arr[1];
            $info['is_open'] = 1;
            $option->weixin_id = Yii::app()->session['weixin_id'];
            $option->value = json_encode($info);
            if($option->save()){
            	Yii::app()->user->setFlash('success', "注册账号成功！");
            }else{
            	Yii::app()->user->setFlash('success', "注册账号失败！");
            }
        }else{
            Yii::app()->user->setFlash('success', "注册账号失败了！");
        }
        $this->render('cnzz_index',array(
			'data'=>$data,
			'url'=>$url,
		));
	}


	public function actionCnzzView()
	{
		$this->layout='//layouts/column1';
		$data = Options::model()->find(
				"`key`=:key AND `weixin_id`=:weixinId",
				array(':key'=>'cnzz', ':weixinId'=>Yii::app()->session['weixin_id'])
			);
        $value = json_decode($data->value, true);
        $url = 'http://wss.cnzz.com/user/companion/shopex_login.php?site_id='.$value['cnzzUser'].'&password='.$value['cnzzPass'];
        $this->render('cnzz_view',array(
			'url'=>$url,
		));
	}
}
