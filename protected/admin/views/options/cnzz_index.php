<?php
/* @var $this OptionsController */
/* @var $model Options */

$this->breadcrumbs=array(
	'Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Qiniu Options', 'url'=>array('qiniu')),
	array('label'=>'Cnzz Options', 'url'=>array('cnzzIndex')),
);
?>

<h1>Cnzz Options</h1>

<?php if (empty($url)) {
	echo CHtml::link("开启在线统计", array('cnzzCreate'), array('class'=>'btn btn-primary'));
} else {
	echo CHtml::link("在当前窗口查看统计", array('cnzzView'), array('class'=>'btn btn-info'));
	echo " ";
	echo CHtml::link("新窗口查看", $url, array('class'=>'btn btn-success', 'target'=>'_blank'));
} ?>