<?php
/* @var $this ImagesController */
/* @var $data Images */
?>


<div class="row">
	<div class="col-xs-6 col-md-3">
		<?php echo CHtml::link(
			CHtml::image(Yii::app()->baseUrl . "/uploads/images/" . $data->filename),
			'#',
			array('class'=>'thumbnail')
		);?>
	</div>
</div>