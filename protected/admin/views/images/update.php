<?php
/* @var $this ImagesController */
/* @var $model Images */

$this->breadcrumbs=array(
	'Images'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Images', 'url'=>array('index')),
	array('label'=>'Create Images', 'url'=>array('create')),
	array('label'=>'View Images', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Images', 'url'=>array('admin')),
);
?>

<h1>Update Images <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>