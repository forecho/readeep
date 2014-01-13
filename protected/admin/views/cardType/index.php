<?php
/* @var $this CardTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Card Types',
);

$this->menu=array(
	array('label'=>'Create CardType', 'url'=>array('create')),
	array('label'=>'Manage CardType', 'url'=>array('admin')),
);
?>

<h1>Card Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
