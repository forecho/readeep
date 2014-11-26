<?php
/* @var $this ImagesController */
/* @var $model Images */

$this->breadcrumbs=array(
	'Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Images', 'url'=>array('index')),
	array('label'=>'Manage Images', 'url'=>array('admin')),
);
?>

<h1>Create Images</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>