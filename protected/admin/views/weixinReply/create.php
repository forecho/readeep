<?php
/* @var $this WeixinReplyController */
/* @var $model WeixinReply */

$this->breadcrumbs=array(
	'Weixin Replies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WeixinReply', 'url'=>array('index')),
	array('label'=>'Manage WeixinReply', 'url'=>array('admin')),
);
?>

<h1>Create WeixinReply</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>