<?php
/* @var $this WeixinReplyController */
/* @var $model WeixinReply */

$this->breadcrumbs=array(
	'Weixin Replies'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WeixinReply', 'url'=>array('index')),
	array('label'=>'Create WeixinReply', 'url'=>array('create')),
	array('label'=>'View WeixinReply', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WeixinReply', 'url'=>array('admin')),
);
?>

<h1>Update WeixinReply <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>