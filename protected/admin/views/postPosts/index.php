<?php
/* @var $this PostPostsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Post Posts',
);

$this->menu=array(
	array('label'=>'Create PostPosts', 'url'=>array('create')),
	array('label'=>'Manage PostPosts', 'url'=>array('admin')),
);
?>

<h1>Post Posts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
