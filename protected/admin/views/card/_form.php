<?php
/* @var $this CardController */
/* @var $model Card */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'card-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'thumb'); ?>
		<?php $this->widget('ext.yii-elFinder.ServerFileInput', array(
		        'model' => $model,
		        'attribute' => 'thumb',
		        'connectorRoute' => 'elfinder/connector',
		    )
		);?>
		<?php echo $form->error($model,'thumb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php $this->widget('ext.yii-elFinder.ServerFileInput', array(
		        'model' => $model,
		        'attribute' => 'image',
		        'connectorRoute' => 'elfinder/connector',
		    )
		);?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',CardType::model()->getAllCardTypeName()); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'music'); ?>
		<?php $this->widget('ext.yii-elFinder.ServerFileInput', array(
		        'model' => $model,
		        'attribute' => 'music',
		        'connectorRoute' => 'elfinder/connector',
		    )
		);?>
		<?php echo $form->error($model,'music'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->