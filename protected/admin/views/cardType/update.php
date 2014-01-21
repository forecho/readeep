<?php
/* @var $this CardTypeController */
/* @var $model CardType */

$this->breadcrumbs=array(
	'Card Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create CardType', 'url'=>array('create')),
	array('label'=>'View CardType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CardType', 'url'=>array('admin')),
);
?>

<h1>Update CardType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>