<?php
/* @var $this WeixinSetController */
/* @var $model WeixinSet */

$this->breadcrumbs=array(
	'Weixin Sets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WeixinSet', 'url'=>array('index')),
	array('label'=>'Manage WeixinSet', 'url'=>array('admin')),
);
?>

<h1>Create WeixinSet</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>