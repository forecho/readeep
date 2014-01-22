<?php
/* @var $this CardInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Card Infos',
);

$this->menu=array(
	array('label'=>'Create CardInfo', 'url'=>array('create')),
	array('label'=>'Manage CardInfo', 'url'=>array('admin')),
);
?>

<h1>Card Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
