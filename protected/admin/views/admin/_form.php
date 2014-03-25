<?php
/* @var $this AdminController */
/* @var $model Admin */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admin-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->labelEx($model,'username'); ?>
	<div class="form-group">
		
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<?php echo $form->labelEx($model,'email'); ?>
	<div class="form-group">
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<?php echo $form->labelEx($model,'password'); ?>
	<div class="form-group">
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<?php echo $form->labelEx($model,'login_ip'); ?>
	<div class="form-group">
		<?php echo $form->textField($model,'login_ip',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'login_ip'); ?>
	</div>
		<?php echo $form->labelEx($model,'login_time'); ?>

	<div class="form-group">
		<?php echo $form->textField($model,'login_time'); ?>
		<?php echo $form->error($model,'login_time'); ?>
	</div>
		<?php echo $form->labelEx($model,'login_count'); ?>

	<div class="form-group">
		<?php echo $form->textField($model,'login_count'); ?>
		<?php echo $form->error($model,'login_count'); ?>
	</div>
		<?php echo $form->labelEx($model,'create_ip'); ?>

	<div class="form-group">
		<?php echo $form->textField($model,'create_ip',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'create_ip'); ?>
	</div>
		<?php echo $form->labelEx($model,'create_time'); ?>

	<div class="form-group">
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>
		<?php echo $form->labelEx($model,'status'); ?>

	<div class="form-group">
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
		<?php echo $form->labelEx($model,'invite_code'); ?>
	<div class="form-group">
		<?php echo $form->textField($model,'invite_code',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'invite_code'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->