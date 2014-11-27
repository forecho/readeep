<?php
/* @var $this ImagesController */
/* @var $model Images */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'images-form',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'filename'); ?>
		<?php echo $form->fileField($model,'filename[]',array('size'=>60,'maxlength'=>255,'multiple'=>true,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'filename'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
	<div class="row buttons">
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
// $(document).ready(function (e){
// 	$("#images-form").on('submit',(function(e){
// 	e.preventDefault();
// 		$.ajax({
// 			url: "upload.php",
// 			type: "POST",
// 			data:  new FormData(this),
// 			contentType: false,
// 			cache: false,
// 			processData:false,
// 			success: function(data){
// 				$("#targetLayer").html(data);
// 			},
// 			error: function(){}
// 		});
// 	}));
// });
</script>