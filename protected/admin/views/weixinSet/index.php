<?php
/* @var $this WeixinSetController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Weixin Sets',
);

$this->menu=array(
	array('label'=>'Create WeixinSet', 'url'=>array('create')),
	array('label'=>'Manage WeixinSet', 'url'=>array('admin')),
);
?>

<h1>Weixin Sets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
