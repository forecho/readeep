<?php
/* @var $this ContactGroupController */
/* @var $model ContactGroup */

$this->breadcrumbs=array(
	'Contact Groups'=>array('index'),
	$model->contact_group_id,
);

$this->menu=array(
	array('label'=>'List ContactGroup', 'url'=>array('index')),
	array('label'=>'Create ContactGroup', 'url'=>array('create')),
	array('label'=>'Update ContactGroup', 'url'=>array('update', 'id'=>$model->contact_group_id)),
	array('label'=>'Delete ContactGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->contact_group_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContactGroup', 'url'=>array('admin')),
);
?>

<h1>View ContactGroup #<?php echo $model->contact_group_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'contact_group_id',
		'mail_template_id',
		'contact_group_name',
		'contact_group_parent_id',
	),
)); ?>
