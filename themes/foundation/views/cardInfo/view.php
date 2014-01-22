<?php
/* @var $this CardInfoController */
/* @var $model CardInfo */

$this->breadcrumbs=array(
	'Card Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List CardInfo', 'url'=>array('index')),
	array('label'=>'Create CardInfo', 'url'=>array('create')),
	array('label'=>'Update CardInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CardInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CardInfo', 'url'=>array('admin')),
);
?>

<h1>View CardInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'card_id',
		'content',
		'has_music',
		'user_id',
		'name',
	),
)); ?>
