<?php
/* @var $this WeixinSetController */
/* @var $model WeixinSet */

$this->breadcrumbs=array(
	'Weixin Sets'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WeixinSet', 'url'=>array('index')),
	array('label'=>'Create WeixinSet', 'url'=>array('create')),
	array('label'=>'View WeixinSet', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WeixinSet', 'url'=>array('admin')),
);
?>

<h1>Update WeixinSet <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>