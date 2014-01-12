<?php
/* @var $this PostPostsController */
/* @var $model PostPosts */

$this->breadcrumbs=array(
	'Post Posts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List PostPosts', 'url'=>array('index')),
	array('label'=>'Create PostPosts', 'url'=>array('create')),
	array('label'=>'Update PostPosts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PostPosts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PostPosts', 'url'=>array('admin')),
);
?>

<h1>View PostPosts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'excerpt',
		'image',
		'content',
		'create_time',
		'status',
		'order',
		'tags',
		'view_count',
		'thanks_count',
		'like_count',
		'admin_id',
	),
)); ?>
