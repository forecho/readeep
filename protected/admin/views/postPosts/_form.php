<?php
        /* @var $this PostPostsController */
        /* @var $model PostPosts */
        /* @var $form CActiveForm */
?>
<div class="form">

    <?php
        $form = $this->beginWidget('CActiveForm', array(
           'id' => 'post-posts-form',
            'htmlOptions' => array('name' => 'myForm'),
            // 'enableClientValidation'=>true,
            // 'clientOptions' => array(
            //     'validateOnSubmit'=>true,
            // ),
        ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

     <div class="form-group">
        <?php echo $form->labelEx($model, 'author'); ?>
        <?php echo $form->textField($model, 'author', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'author'); ?>
    </div>

    <div class="form-group">
        <?php $this->widget('backend.components.imageLoader', array(
              'crumbs' => array(
                array('name' => 'Home', 'url' => array('site/index')),
                array('name' => 'Login'),
              ),
              'delimiter' => ' &rarr; ', // if you want to change it
        )); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'image'); ?>
            <input id="file" name="file" class="ipt" type="file" multiple="multiple"/>
            <input id="token" name="token" type="hidden" class="ipt form-control" value="<?php echo $token;?>">
            <input id="key" name="key" type="hidden" class="ipt form-control" value="">
            <div id="progressbar"><div class="progress-label"></div></div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php $this->widget('ext.yii-redactor.ERedactorWidget',array(
            'model'=>$model,
            'attribute'=>'content',
            // Redactor options
            'options'=>array(
                'lang'=>'zh_cn',
            ),
        )); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>



    <div class="form-group">
        <?php echo $form->labelEx($model, 'tags'); ?>
        <?php
            $this->widget('ext.yii-selectize.YiiSelectize', array(
                'name'           => 'tags',
                'selectedValues' => explode(' ', $model->tags),
                'data'           => PostTags::model()->getAllTags(),
                'fullWidth'      => false,
                'htmlOptions'    => array(
                    'style' => 'width: 50%',
                ),
                'multiple'       => true,
            ));
        ?>
        <?php echo $form->error($model, 'tags'); ?>
    </div>
    <div class="form-group">
        <?php //echo $form->textField($model, 'image',array('class' => 'form-control'));  ?>
        <input type='hidden' name='PostPosts[image]' value='' id='PostPosts_image'></input>
    </div>

    <div style="display: none;">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'excerpt'); ?>
            <?php echo $form->textArea($model, 'excerpt', array('rows'      => 6, 'cols'      => 50, 'class'     => 'form-control', 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'excerpt'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'create_time'); ?>
            <?php
                $this->widget('application.extensions.timepicker.EJuiDateTimePicker', array(
                    'model'       => $model,
                    'attribute'   => 'create_time',
                    'language'    => 'zh-CN',
                    'options'     => array(
                        'hourGrid'    => 4,
                        'hourMin'     => 9,
                        'hourMax'     => 17,
                        'timeFormat'  => 'hh:mm',
                        'changeMonth' => true,
                        'changeYear'  => false,
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                        'class'    => 'form-control',
                        'style'    => 'width:180px;'
                    ),
                ));
            ?>
            <?php echo $form->error($model, 'create_time'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'status'); ?>
            <?php echo $form->dropDownList($model, 'status', PostPosts::model()->getPostStatus(), array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'order'); ?>
            <?php echo $form->textField($model, 'order', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'order'); ?>
            <p class="hint">
                提示：数字越小，越排前面。0在第一位。
            </p>
        </div>
    </div>
    <a href="javascript:;" id="advanced">显示高级设置</a>

    <div class="form-group">
        <a class="btn btn-primary" id="submit" name="submit">提交</a>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    document.getElementById("submit").onclick = function() {
    if (document.getElementById('key').value.length == 0)
    {
        var microTime=new Date();

        var imgPath="<?php echo $imgPathPre;?>"+microTime.getTime();
        var path = document.getElementById("file").value;
        var fileName = imgPath;
        document.getElementById('key').value=imgPath;
        document.getElementById('PostPosts_image').value = imgPath;
    }
    qiniuAjaxUp();
};
function qiniuAjaxUp()
{
    var Qiniu_UploadUrl = "http://up.qiniu.com";
    var progressbar = $("#progressbar"),
    progressLabel = $(".progress-label");
    //普通上传
    var Qiniu_upload = function(f, token, key) {
        var xhr
        if (window.XMLHttpRequest){
        // code for IE7+, Firefox, Chrome, Opera, Safari
           xhr = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhr.open('POST', Qiniu_UploadUrl, true);
        var formData, startDate;
        formData = new FormData();
        if (key !== null && key !== undefined)
        formData.append('key', key);
        formData.append('token', token);
        formData.append('file', f);
        var taking;
        xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var nowDate = new Date().getTime();
                taking = nowDate - startDate;
                var x = (evt.loaded) / 1024;
                var y = taking / 1000;
                var uploadSpeed = (x / y);
                var formatSpeed;
                if (uploadSpeed > 1024) {
                    formatSpeed = (uploadSpeed / 1024).toFixed(2) + "Mb\/s";
                } else {
                    formatSpeed = uploadSpeed.toFixed(2) + "Kb\/s";
                }
                var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                progressbar.progressbar("value", percentComplete);
                // console && console.log(percentComplete, ",", formatSpeed);
            }
        }, false);
        xhr.onreadystatechange = function(response) {
            if (xhr.readyState == 4 && xhr.status == 200 && xhr.responseText != "") {
                var blkRet = JSON.parse(xhr.responseText);
                // onsole && console.log(blkRet);
                // $("#dialog").html(xhr.responseText).dialog();

                document.getElementById('post-posts-form').submit();
            } else if (xhr.status != 200 && xhr.responseText) {

            }
        };
        startDate = new Date().getTime();
        // $("#progressbar").show();
        xhr.send(formData);
    };
    var token = $("#token").val();
    if ($("#file")[0].files.length > 0 && token != "") {
        Qiniu_upload($("#file")[0].files[0], token, $("#key").val());
    } else {
        console && console.log("form input error");
    }
}
function getFileName(path) {
    var pos1 = path.lastIndexOf('/');
    var pos2 = path.lastIndexOf('\\');
    var pos = Math.max(pos1, pos2)
    if (pos < 0)
        return path;
    else
        return path.substring(pos + 1);
}
</script>