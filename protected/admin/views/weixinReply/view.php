<?php
/* @var $this WeixinReplyController */
/* @var $model WeixinReply */

$this->breadcrumbs=array(
	'Weixin Replies'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List WeixinReply', 'url'=>array('index')),
	array('label'=>'Create WeixinReply', 'url'=>array('create')),
	array('label'=>'Update WeixinReply', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WeixinReply', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WeixinReply', 'url'=>array('admin')),
);
?>

<h1>View WeixinReply #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'excerpt',
		'image',
		'keyword',
		'type',
		'content',
		'admin_id',
	),
)); ?>
