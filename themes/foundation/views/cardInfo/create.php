<?php
/* @var $this CardInfoController */
/* @var $model CardInfo */

$this->breadcrumbs=array(
	'Card Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CardInfo', 'url'=>array('index')),
	array('label'=>'Manage CardInfo', 'url'=>array('admin')),
);
?>

<h1>Create CardInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>