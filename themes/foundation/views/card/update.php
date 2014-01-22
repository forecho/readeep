<?php
/* @var $this CardController */
/* @var $model Card */

$this->breadcrumbs=array(
	'Cards'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Card', 'url'=>array('index')),
	array('label'=>'Create Card', 'url'=>array('create')),
	array('label'=>'View Card', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Card', 'url'=>array('admin')),
);
?>

<h1>Update Card <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>