<?php
/* @var $this ContactGroupController */
/* @var $model ContactGroup */

$this->breadcrumbs=array(
	'Contact Groups'=>array('index'),
	$model->contact_group_id=>array('view','id'=>$model->contact_group_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContactGroup', 'url'=>array('index')),
	array('label'=>'Create ContactGroup', 'url'=>array('create')),
	array('label'=>'View ContactGroup', 'url'=>array('view', 'id'=>$model->contact_group_id)),
	array('label'=>'Manage ContactGroup', 'url'=>array('admin')),
);
?>

<h1>Update ContactGroup <?php echo $model->contact_group_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>