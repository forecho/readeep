<?php
/* @var $this PostPostsController */
/* @var $model PostPosts */

$this->breadcrumbs=array(
	'Post Posts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage PostPosts', 'url'=>array('admin')),
);
?>

<h1>Create PostPosts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'token'=>$token)); ?>