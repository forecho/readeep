<?php
/* @var $this ContactPersonController */
/* @var $model ContactPerson */

$this->breadcrumbs=array(
	'Contact People'=>array('index'),
	$model->contact_person_id,
);

$this->menu=array(
	array('label'=>'List ContactPerson', 'url'=>array('index')),
	array('label'=>'Create ContactPerson', 'url'=>array('create')),
	array('label'=>'Update ContactPerson', 'url'=>array('update', 'id'=>$model->contact_person_id)),
	array('label'=>'Delete ContactPerson', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->contact_person_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContactPerson', 'url'=>array('admin')),
);
?>

<h1>View ContactPerson #<?php echo $model->contact_person_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'contact_person_id',
		'admin_id',
		'contact_group_id',
		'mobile',
		'gender',
		'email',
		'birthday',
		'address',
		'nickname',
	),
)); ?>
