<?php
/* @var $this CardController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cards',
);

$this->menu=array(
	array('label'=>'Create Card', 'url'=>array('create')),
	array('label'=>'Manage Card', 'url'=>array('admin')),
);
?>

<h1>Cards</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
