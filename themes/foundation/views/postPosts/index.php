<?php
/* @var $this PostPostsController */

$this->breadcrumbs=array(
	'Post Posts',
);
?>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$model->search(),
    'itemView'=>'_view',
    'emptyText'=>'暂时没有数据',
    'ajaxUpdate'=> false,//这样就不会AJAX翻页
   	'template'=>'{items}{pager}',
    'pager' => array(
            'header'=>false,
            'htmlOptions'=>array('class'=>'pagination'),
            'selectedPageCssClass' => 'current',
            'hiddenPageCssClass' => 'disabled',
            'firstPageLabel'=>'首页',//定义首页按钮的显示文字
            'lastPageLabel'=>'尾页',//定义末页按钮的显示文字
            'nextPageLabel'=>'下一页',//定义下一页按钮的显示文字
            'prevPageLabel'=>'上一页',//定义上一页按钮的显示文字
        ),
    'htmlOptions'=>array('class'=>'list-group'),
    'itemsTagName'=>'div',
    'itemsCssClass'=>'row',
    'pagerCssClass'=>'pagination',
));
?>
