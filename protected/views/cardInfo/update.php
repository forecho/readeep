<?php
/* @var $this CardInfoController */
/* @var $model CardInfo */

$this->breadcrumbs=array(
	'Card Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CardInfo', 'url'=>array('index')),
	array('label'=>'Create CardInfo', 'url'=>array('create')),
	array('label'=>'View CardInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CardInfo', 'url'=>array('admin')),
);
?>

<h1>Update CardInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>