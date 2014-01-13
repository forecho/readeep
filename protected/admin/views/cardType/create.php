<?php
/* @var $this CardTypeController */
/* @var $model CardType */

$this->breadcrumbs=array(
	'Card Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CardType', 'url'=>array('index')),
	array('label'=>'Manage CardType', 'url'=>array('admin')),
);
?>

<h1>Create CardType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>