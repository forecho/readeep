<?php
/* @var $this ContactGroupController */
/* @var $model ContactGroup */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'contact_group_id'); ?>
		<?php echo $form->textField($model,'contact_group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mail_template_id'); ?>
		<?php echo $form->textField($model,'mail_template_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_group_name'); ?>
		<?php echo $form->textField($model,'contact_group_name',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_group_parent_id'); ?>
		<?php echo $form->textField($model,'contact_group_parent_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->