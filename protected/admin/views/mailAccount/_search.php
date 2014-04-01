<?php
/* @var $this MailAccountController */
/* @var $model MailAccount */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'mai_account_id'); ?>
		<?php echo $form->textField($model,'mai_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mail_account'); ?>
		<?php echo $form->textField($model,'mail_account',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'host'); ?>
		<?php echo $form->textField($model,'host',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'port'); ?>
		<?php echo $form->textField($model,'port'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->