<?php
/* @var $this ImagesController */
/* @var $model Images */

$this->breadcrumbs=array(
	'Images'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Images', 'url'=>array('index')),
	array('label'=>'Create Images', 'url'=>array('create')),
	array('label'=>'Update Images', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Images', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Images', 'url'=>array('admin')),
);
?>

<h1>View Images #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'name',
		'size',
		'cdn_url',
		'admin_id',
		'created',
		'modified',
	),
)); ?>
