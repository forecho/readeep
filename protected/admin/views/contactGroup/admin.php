<?php
/* @var $this ContactGroupController */
/* @var $model ContactGroup */

$this->breadcrumbs=array(
	'Contact Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ContactGroup', 'url'=>array('index')),
	array('label'=>'Create ContactGroup', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contact-group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Contact Groups</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contact-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'contact_group_id',
		'mail_template_id',
		'contact_group_name',
		'contact_group_parent_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
