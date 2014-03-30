<?php
/* @var $this ContactGroupController */
/* @var $model ContactGroup */

$this->breadcrumbs=array(
	'Contact Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContactGroup', 'url'=>array('index')),
	array('label'=>'Manage ContactGroup', 'url'=>array('admin')),
);
?>

<h1>Create ContactGroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'template'=>$template)); ?>