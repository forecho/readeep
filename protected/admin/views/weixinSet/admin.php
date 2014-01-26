<?php
/* @var $this WeixinSetController */
/* @var $model WeixinSet */

$this->breadcrumbs=array(
	'Weixin Sets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List WeixinSet', 'url'=>array('index')),
	array('label'=>'Create WeixinSet', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#weixin-set-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Weixin Sets</h1>

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
	'id'=>'weixin-set-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'token',
		'name',
		'wx_id',
		'rawid',
		'avatar',
		/*
		'qr_code',
		'admin_id',
		'description',
		*/
		array(
			'class'=>'CButtonColumn',
		   	'template'=>'{update} {view} {delete}',
		    'buttons'=>array (
		        'update'=> array(
		            'label'=>'',
		            'imageUrl'=>'',
		            'options'=>array( 'class'=>'glyphicon glyphicon-pencil', 'title'=>t('update', 'menu')),
		        ),
		        'view'=>array(
		            'label'=>'',
		            'imageUrl'=>'',
		            'options'=>array( 'class'=>'glyphicon glyphicon-search', 'title'=>t('view', 'menu')),
		        ),
		        'delete'=>array(
		            'label'=>'',
		            'imageUrl'=>'',
		            'options'=>array( 'class'=>'glyphicon glyphicon-trash', 'title'=>t('delete', 'menu')),
		        ),
		    ),
		    'htmlOptions'=>array('style' => 'width: 70px')
		),
	),
	'itemsCssClass'=>'table table-striped table-bordered table-hover',
)); ?>
