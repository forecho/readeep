<?php
/* @var $this CardController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cards',
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'emptyText'=>'暂时没有数据',
    'ajaxUpdate'=> false,//这样就不会AJAX翻页
   	'template'=>'{items}{pager}',
    'pager' => array(
            'header'=>false,
            'htmlOptions'=>array('class'=>'pagination'),
            'selectedPageCssClass' => 'active',
            'hiddenPageCssClass' => 'disabled',
        ),
    'htmlOptions'=>array('class'=>'list-group'),
    'itemsTagName'=>'div',
    'itemsCssClass'=>'row',
    'pagerCssClass'=>'pagination',
)); ?>
