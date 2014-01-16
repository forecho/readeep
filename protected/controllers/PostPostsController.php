<?php

class PostPostsController extends Controller
{
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
}