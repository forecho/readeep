<?php
/* @var $this WeixinSetController */
/* @var $model WeixinSet */

$this->breadcrumbs=array(
	'Weixin Sets'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List WeixinSet', 'url'=>array('index')),
	array('label'=>'Create WeixinSet', 'url'=>array('create')),
	array('label'=>'Update WeixinSet', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WeixinSet', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WeixinSet', 'url'=>array('admin')),
);
?>

<h1>View WeixinSet #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'token',
		'url',
		'name',
		'wx_id',
		'rawid',
		'avatar',
		'qr_code',
		'admin_id',
		'description',
	),
)); ?>
