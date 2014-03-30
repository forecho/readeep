<?php
/* @var $this ContactPersonController */
/* @var $model ContactPerson */

$this->breadcrumbs=array(
	'Contact People'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContactPerson', 'url'=>array('index')),
	array('label'=>'Manage ContactPerson', 'url'=>array('admin')),
);
?>

<h1>Create ContactPerson</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>