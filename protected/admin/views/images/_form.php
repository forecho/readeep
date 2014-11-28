<?php
/* @var $this ImagesController */
/* @var $model Images */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'images-form',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'filename'); ?>
		<?php echo $form->fileField($model,'filename[]',array('id'=>'uploadfile','multiple'=>true,'class'=>'btn btn-primary form-control')); ?>
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
$('#uploadfile').change(function() {
	send();
});
// this script for collecting the form data and pass to the controller action and doing the on success validations
function send(){
    var formData = new FormData($("#images-form")[0]);
    $.ajax({
        url: '<?php echo Yii::app()->createUrl("images/create"); ?>',
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {
            // do some loading options
        },
        success: function (data) {
            // on success do some validation or refresh the content div to display the uploaded images
            alert(1);
            // jQuery("#list-of-post").load("<?php echo Yii::app()->createUrl('//forumPost/forumPostDisplay'); ?>");
        },

        complete: function() {
            // success alerts
        },

        error: function (data) {
            alert("There may a error on uploading. Try again later");
        },
       	cache: false,
        contentType: false, //必须
        processData: false //必须
    });

    return false;
}
</script>