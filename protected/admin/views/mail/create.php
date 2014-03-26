<?php
$this->breadcrumbs=array(
    'Post Posts'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'Manage PostPosts', 'url'=>array('admin')),
);
?>

<h1>Create PostPosts</h1>
?>
<div class="pageContent">
        <?php
                $form = $this->beginWidget('CActiveForm', array('id'          => "dwz_form",
                    'htmlOptions' => array(
                        'class'      => 'pageForm required-validate',
                        'onsubmit'   => 'return iframeCallback(this);',
                        'novalidate' => 'novalidate',
                        'target'     => "callbackframe",
                        'enctype'    => 'multipart/form-data',
                )));
        ?>
        <div class="pageFormContent" layoutH="97">
                
                <div class="panelBar">
                <ul class="toolBar">
                        <li><a class="add" href="<?php echo $this->createUrl('mail/create'); ?>" target="navTab"><span>添加</span></a></li>
                        <!--<li><a class="delete" href="demo/common/ajaxDone.html?uid={sid_user}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>-->

                        <li class="line">line</li>
                        <!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
                </ul>
        </div>
                <div class="tabs" currentIndex="0" eventType="click">
                        <div class="tabsHeader">
                                <div class="tabsHeaderContent">
                                        <ul>
                                                <li><a href="javascript:;"><span>通用信息</span></a></li>
                                        </ul>
                                </div>
                        </div>
                        <div class="tabsContent" style="height:720px;margin: 0 auto;">
                                <!--通用信息-->
                                <div>
                                        <dl class="nowrap">
                                                <dt>邮件模板 </dt>
                                                <dd>   
                                                        <input id="selTemplate" name="MailTemplates[template_id]">
                                                      
                                                </dd>
                                        </dl>
                                        <dl class="nowrap">
                                                <dt><?php echo $form->labelEx($model, 'template_subject'); ?></dt>
                                                <dd>
                                                        <?php
                                                                echo $form->textfield($model, 'template_subject');
                                                        ?>
                                                </dd>    

                                        </dl>
                                        <dl class="nowrap">
                                                <dt><?php echo $form->labelEx($model, 'is_html'); ?></dt>
                                                <dd class="yii_label">

                                                        <?php
                                                                echo $form->radioButtonList($model, 'is_html', array(1 => '源码显示', 0 => '正常显示'), array('separator' => '&nbsp;', 'style'     => 'float:none;'), array(''));
                                                        ?>
                                                </dd>    
                                        </dl>
                                        <div class="unit">
                                                <dl class="nowrap">
                                                        <dt><?php echo $form->labelEx($model, 'template_content'); ?></dt>
                                                        <dd>
                                                                <textarea class="editor" id="MailTemplates_template_content" name="MailTemplates[template_content]" rows="15" cols="100" upLinkUrl="upload.php" upLinkExt="zip,rar,txt" 
                                                                         upImgUrl="upload.php" upImgExt="jpg,jpeg,gif,png" upFlashUrl="upload.php" upFlashExt="swf"upMediaUrl="upload.php" upMediaExt:"avi">
                                                                        <?php echo $model->template_content;?>
                                                                </textarea>
                                                        </dd>
                                                </dl>  
                                </div>
                                <div class="tabsFooter">
                                        <div class="tabsFooterContent"></div>
                                </div>
                        </div>
                </div>
        </div>
        </div>
        <div class="formBar">
                <ul>
                        <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
                        <li><div class="button"><div class="buttonContent"><button class="close" type="button">关闭</button></div></div></li>
                </ul>
        </div>
        <?php $this->endwidget(); ?>
</div>
<script>
        function changeTemplate()
        {
                var template_id = $("#selTemplate").val();//取框中的用户名 
                //alert(template_id);
                $.ajax({//一个Ajax过程 
                        type: "post", //以post方式与后台沟通 
                        url: "<?php echo $this->createUrl('Mail/ajaxTemplate') ?>", //与此php页面沟通 
                        dataType: 'json', //从php返回的值以 JSON方式 解释 
                        data: 'template_id=' + template_id, //发给php的数据有两项，分别是上面传来的u和p 
                        success: function(json) {//如果调用php成功
                                //alert(json.template_subject); //把php中的返回值（json.template_subject）给 alert出来 
                               // $('#MailTemplates_is_html_' + is_html).attr("checked", "checked");
                                $('#MailTemplates_template_subject').val(json.template_subject);
                                $('#MailTemplates_template_content').val(json.template_content);
                        }
                })
        }
 

</script>