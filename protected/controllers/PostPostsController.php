<?php

class PostPostsController extends Controller
{
	public $layout='//layouts/column1';

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	// public function accessRules()
	// {
	// 	return array(
	// 		array('allow',  // allow all users to perform 'index' and 'view' actions
	// 			'actions'=>array('index','view'),
	// 			'users'=>array('*'),
	// 		),
	// 		array('allow', // allow authenticated user to perform 'create' and 'update' actions
	// 			'actions'=>array('addLike','addThanks'),
	// 			'users'=>array('@'),
	// 		),
	// 	);
	// }

	public function actionIndex()
	{
		$model=new PostPosts('search');
		$model->unsetAttributes();  // clear any default values
		$model->status = 1; // 筛选掉草稿
		$model->create_time = '<'.time(); // 定时发布
		if(isset($_GET['PostPosts']))
			$model->attributes=$_GET['PostPosts'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		// 计时器 围观+1
		$model->saveCounters(array('view_count'=>1));
		$this->render('view',array(
			'model'=>$model,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PostPosts the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PostPosts::model()->findByPk($id,
					'status=:status and create_time<:createTime',
					array(':status'=>1, ':createTime'=>time())
				);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	// 点赞
	public function actionAddLike($id='')
	{
		$model = $this->loadModel($id);
		// 计时器 赞+1
		$model->saveCounters(array('like_count'=>1));
		$this->_postAction($id, 1); // 1为赞
		echo $model->like_count;
	}

	public function actionAddThanks($id='')
	{
		$model = $this->loadModel($id);
		// 计时器 收藏+1
		$model->saveCounters(array('thanks_count'=>1));
		$this->_postAction($id, 2); // 1为感谢
		echo $model->thanks_count;
	}


	public function _postAction($id, $type)
	{
		$model = new PostActions;
		$model->post_id = $id;
		$model->type = $type;
		$model->user_id = 2; //用户登录
		$model->save();
	}
}