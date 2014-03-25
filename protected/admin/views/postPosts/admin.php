<?php
/* @var $this PostPostsController */
/* @var $model PostPosts */

$this->breadcrumbs=array(
	'Post Posts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create PostPosts', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#post-posts-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Post Posts</h1>

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
	'id'=>'post-posts-grid',
	'dataProvider'=>$model->search(),
	'pager' => array(
		'header'=>false,
        'htmlOptions'=>array('class'=>'pagination'),
       'selectedPageCssClass' => 'active',
        'hiddenPageCssClass' => 'disabled',
	),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'image',
         	'value'=> 'CHtml::image($data->image)',
         	'type'=>'raw',
		),
		'title',
		'author',
		'create_time',
		'view_count',
		'thanks_count',
		'like_count',
		// 'weixin_id',
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
));
 ?>
