<?php
/* @var $this OptionsController */
/* @var $model Options */

$this->breadcrumbs=array(
	'Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Options', 'url'=>array('index')),
	array('label'=>'Manage Options', 'url'=>array('admin')),
);
?>

<h1>Create Options</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>