<?php

class PostPostsController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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

    public function actions()
    {
            return array(
                'connector' => array(
                    'class'    => 'ext.yii-elfinder.ElFinderConnectorAction',
                    'settings' => array(
                        'root'       => Yii::getPathOfAlias('webroot') . '/uploads/',
                        'URL'        => Yii::app()->baseUrl . '/uploads/',
                        'rootAlias'  => 'Home',
                        'mimeDetect' => 'none'
                    )
                ),
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
                array('allow', // allow all users to perform 'index' and 'view' actions
                    'actions' => array('index', 'view'),
                    'users'   => array('*'),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array('create', 'update'),
                    'users'   => array('@'),
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions' => array('admin', 'delete'),
                    'users'   => array('admin'),
                ),
                array('deny', // deny all users
                    'users' => array('*'),
                ),
            );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {

            Yii::import('ext.yii-tinymce.*');
            $model = new PostPosts;
            $obj = new QiNiuClound();
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['PostPosts']))
            {
                    if (isset($_POST['tags']))
                    {
                            // 添加标签
                            $this->createTags($_POST['tags']);
                            $model->tags = implode(' ', $_POST['tags']);
                    }
                    $model->attributes = $_POST['PostPosts'];
                    $model->weixin_id  = Yii::app()->session['weixin_id'];
                    ;
                    if ($model->save())
                    {
                            Yii::app()->user->setFlash('success', "Thinks saved success!");
                            $this->redirect(array('view', 'id' => $model->id));
                    }
            }

            $this->render('create', array(
                'model' => $model,
                'token' => $obj->getUpToken(),
            ));
    }

    /**
     * 添加标签到标签库
     */
    public function createTags($tags)
    {
            foreach ($tags as $key => $value)
            {
                    $count[$key] = PostTags::model()->countByAttributes(array(
                        'name'     => $value,
                        'admin_id' => Yii::app()->user->id
                    ));
                    // 判断标签是否存在
                    if (!$count[$key])
                    {
                            $tags[$key]           = new PostTags;
                            $tags[$key]->name     = $value;
                            $tags[$key]->admin_id = Yii::app()->user->id;
                            $tags[$key]->weixin   = Yii::app()->session['weixin_id'];
                            $tags[$key]->save();
                    }
            }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
            Yii::import('ext.yii-tinymce.*');
            $model = $this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['PostPosts']))
            {
                    $model->attributes = $_POST['PostPosts'];
                    // 标签
                    if (isset($_POST['tags']))
                    {
                            // 添加标签
                            $this->createTags($_POST['tags']);
                            $model->tags = implode(' ', $_POST['tags']);
                    }
                    if ($model->save())
                            $this->redirect(array('view', 'id' => $model->id));
            }

            $this->render('update', array(
                'model' => $model,
            ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
            $dataProvider = new CActiveDataProvider('PostPosts');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model             = new PostPosts('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PostPosts']))
                $model->attributes = $_GET['PostPosts'];

        $this->render('admin', array(
            'model' => $model,
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
        $model = PostPosts::model()->findByPk($id);
        if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PostPosts $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-posts-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }
    }

}

