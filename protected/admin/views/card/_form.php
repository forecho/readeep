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

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('class'=>'form-control','size'=>50,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'thumb'); ?>
		<?php $this->widget('ext.yii-elFinder.ServerFileInput', array(
		        'model' => $model,
		        'attribute' => 'thumb',
		        'connectorRoute' => 'elfinder/connector',
		    )
		);?>
		<?php echo $form->error($model,'thumb'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php $this->widget('ext.yii-elFinder.ServerFileInput', array(
		        'model' => $model,
		        'attribute' => 'image',
		        'connectorRoute' => 'elfinder/connector',
		    )
		);?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'card_type_id'); ?>
		<?php echo $form->dropDownList(
					$model,
					'card_type_id',
					CardType::model()->getAllCardTypeName(),
					array('class'=>'form-control')
				); ?>
		<?php echo $form->error($model,'card_type_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'music'); ?>
		<?php $this->widget('ext.yii-elFinder.ServerFileInput', array(
		        'model' => $model,
		        'attribute' => 'music',
		        'connectorRoute' => 'elfinder/connector',
		    )
		);?>
		<?php echo $form->error($model,'music'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton(
			$model->isNewRecord ? 'Create' : 'Save',
			array('class'=>'btn btn-primary')
		); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->