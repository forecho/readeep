<?php
/* @var $this WeixinReplyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Weixin Replies',
);

$this->menu=array(
	array('label'=>'Create WeixinReply', 'url'=>array('create')),
	array('label'=>'Manage WeixinReply', 'url'=>array('admin')),
);
?>

<h1>Weixin Replies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
