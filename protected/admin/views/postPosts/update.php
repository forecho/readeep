<?php
/* @var $this PostPostsController */
/* @var $model PostPosts */

$this->breadcrumbs=array(
	'Post Posts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create PostPosts', 'url'=>array('create')),
	array('label'=>'View PostPosts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PostPosts', 'url'=>array('admin')),
);
?>

<h1>Update PostPosts <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>