<?php
/* @var $this WeixinSetController */
/* @var $model WeixinSet */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'weixin-set-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'token'); ?>
		<?php echo $form->textField($model,'token',array('class'=>'form-control','size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'token'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control','size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'wx_id'); ?>
		<?php echo $form->textField($model,'wx_id',array('class'=>'form-control','size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'wx_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'rawid'); ?>
		<?php echo $form->textField($model,'rawid',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'rawid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php $this->widget('ext.yii-elfinder.ServerFileInput', array(
		        'model' => $model,
		        'attribute' => 'avatar',
		        'connectorRoute' => 'elfinder/connector',
		    )
		);?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'qr_code'); ?>
		<?php $this->widget('ext.yii-elfinder.ServerFileInput', array(
		        'model' => $model,
		        'attribute' => 'qr_code',
		        'connectorRoute' => 'elfinder/connector',
		    )
		);?>
		<?php echo $form->error($model,'qr_code'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'admin_id'); ?>
		<?php echo $form->textField($model,'admin_id'); ?>
		<?php echo $form->error($model,'admin_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'class'=>'form-control','maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton(
			$model->isNewRecord ? 'Create' : 'Save',
			array('class'=>'btn btn-primary')
		); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->