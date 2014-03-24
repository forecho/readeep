<?php
/* @var $this OptionsController */
/* @var $model Options */

$this->breadcrumbs=array(
	'Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Qiniu Options', 'url'=>array('qiniu')),
	array('label'=>'Manage Options', 'url'=>array('admin')),
);
?>

<h1>Qiniu Options</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'options-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
    'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'bucket'); ?>
		<?php echo $form->textField($model,'bucket',array('class' => 'form-control','size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'bucket'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('class' => 'form-control','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'accessKey'); ?>
		<?php echo $form->textField($model,'accessKey',array('class' => 'form-control','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'accessKey'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'secretKey'); ?>
		<?php echo $form->textField($model,'secretKey',array('class' => 'form-control','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'secretKey'); ?>
	</div>


	<div class="form-group buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->