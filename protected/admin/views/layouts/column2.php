<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<!-- <div class="col-xs-12 col-sm-6 col-md-8"> -->
<div class="col-xs-14 col-sm-8 col-md-10">
	<?php
		// 显示提示消息
		foreach(Yii::app()->user->getFlashes() as $key => $message) {
		    echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
		}
		Yii::app()->clientScript->registerScript('fade', "setTimeout(function() { $('.alert').fadeOut('slow'); }, 3000);");
	?>

	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="col-sm-4 col-md-2">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>