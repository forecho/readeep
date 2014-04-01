<?php
$this->breadcrumbs = array(
    'Post Posts' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Manage PostPosts', 'url' => array('admin')),
);
?>
<?php
$this->pageTitle = Yii::app()->name . ' - 送信';
$this->breadcrumbs = array('送信',);
?>  

<h1>邮件送信</h1>  

<!-- 显示提示信息 --> 
<!-- begin -->
<?php
if (Yii::app()->user->hasFlash('success'))
{
    ?>  
    <div class="flash-success">  
        <?php
        echo Yii::app()->user->getFlash('success');
        ?>  
    </div>  
    <?php
}
?>  

<?php
if (Yii::app()->user->hasFlash('failed'))
{
    ?>  
    <div class="flash-error">  
        <?php
        echo Yii::app()->user->getFlash('failed');
        ?>  
    </div>  
    <?php
}
?> 
<!-- end -->
<!-- 显示提示信息 -->  

<div class="form">  
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mail-form',
        'method' => 'post',
        'htmlOptions'=>array('name'=>'myForm'),
//        'enableClientValidation' => true,
//        'clientOptions' => array(),
    ));
    ?>    
    <?php //echo $form->errorSummary($model);  ?>  
    <!-- 送信元 -->  
    <div class="row">  
        <?php echo $form->labelEx($model, 'from'); ?>  
        <input name="MailForm[from]" id="MailForm_from" type="text" value="<?php echo $mailAccount->mail_account; ?>" readonly>
        <?php echo $form->error($model, 'from'); ?>  
    </div>  
    <!-- 送信先 -->  
    <div class="row">  
        <?php echo $form->labelEx($model, 'to'); ?>  
        <?php echo $form->textField($model, 'to'); ?>  
        <?php echo $form->error($model, 'to'); ?>  
    </div>  
    <!-- 件名 -->  
    <div class="row">  
        <?php echo $form->labelEx($model, 'subject'); ?>  
        <?php echo $form->textField($model, 'subject'); ?>  
        <?php echo $form->error($model, 'subject'); ?>  
    </div>  
    <!-- 内容 -->  
    <div class="row">  
        <?php echo $form->labelEx($model, 'body'); ?>  
        <?php echo $form->textArea($model, 'body', array('cols' => '80', 'rows' => '10',)); ?>  
        <?php echo $form->error($model, 'body'); ?>  
    </div>  

    <div class="row">  
        <div class="form-group">
            <button  class="btn btn-primary" id="submit" name="submit" onclick="submit()">送信</button>
        </div> 
    </div>  
    <?php $this->endWidget(); ?>  
</div>