<?php
/* @var $this AdminController */
/* @var $model Admin */
/* @var $form CActiveForm */
?>
<!-- 显示提示信息 --> 
<!-- begin -->


<?php
if (Yii::app()->user->hasFlash('failed'))
{

    echo "<div class=flash-error>  ";
    echo Yii::app()->user->getFlash('invitefailed');
    echo " </div> ";
}
?> 
<!-- end -->
<!-- 显示提示信息 --> 
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'admin-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->labelEx($model, 'username'); ?>
    <div class="form-group">

        <?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>
    <?php echo $form->labelEx($model, 'email'); ?>
    <div class="form-group">
        <?php echo $form->textField($model, 'email', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <?php echo $form->labelEx($model, 'password'); ?>
    <div class="form-group">
        <?php echo $form->passwordField($model, 'password', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <?php echo $form->labelEx($model, 'invite_code'); ?>
    <div class="form-group">
        <?php echo $form->textField($model, 'invite_code', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'invite_code'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->