<?php
/* @var $this CardController */
/* @var $data Card */
?>

<div class="medium-3 large-3 columns">
	<div class="panel p0 bd0">
		<?php echo CHtml::link(CHtml::image($data->thumb, '',array('class'=>'w100')), array('create', 'id'=>$data->id)); ?>
		<p><?php echo CHtml::encode($data->title); ?></p>
	</div>
</div>