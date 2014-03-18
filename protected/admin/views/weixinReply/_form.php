<?php
/* @var $this WeixinReplyController */
/* @var $model WeixinReply */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'weixin-reply-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="form-group">
		<?php echo $form->labelEx($model,'keyword'); ?>
		<?php echo $form->textField($model,'keyword',array('class' => 'form-control','size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'keyword'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model, 'type', WeixinReply::model()->getReplyTypeName(), array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('class' => 'form-control','rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div style="display: none;">
		<div class="form-group">
			<?php echo $form->labelEx($model,'title'); ?>
			<?php echo $form->textField($model,'title',array('class' => 'form-control','size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'excerpt'); ?>
			<?php echo $form->textField($model,'excerpt',array('class' => 'form-control','size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'excerpt'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'image'); ?>
			<?php echo $form->textField($model,'image',array('class' => 'form-control','size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'image'); ?>
		</div>
	</div>
	<a href="javascript:;" id="advanced">显示高级设置</a>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->