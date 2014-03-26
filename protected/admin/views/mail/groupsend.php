<script>
        $(function() {
                $('#user_name_list').dblclick(function() {
                        if ($(this).val()) {
                                var select_obj = jQuery(this).find('option:selected');
                                var value = select_obj.val();
                                if (!$('#user_id_' + value).val()) {//判断是否存在
                                        select_obj.clone().appendTo("#user_name_show");
                                        $('#send_user_box').clone().val(value).attr('id', 'user_id_' + value).appendTo('#user_box');
                                }
                        }
                });
                $('#user_name_show').dblclick(function() {
                        if ($(this).val()) {
                                jQuery("#user_id_" + $(this).find('option:selected').val()).remove();
                                jQuery("#user_name_show option:selected").remove();
                        }
                });
        });

        function searchUser() {
                var url = "<?php echo $this->createUrl('mail/ajaxSearchUsr') ?>";
                var user_rank = $('#user_rank_select').find('option:selected').val();
                var group_id = $('#group_id').find('option:selected').val();
                var user_name = $('#user_name_box').val();
                $('#user_name_list').html('');
                $.get(url, {rank_id: user_rank, user_name: user_name, group_id: group_id}, function(data) {
                        $('#user_name_list').html(data);
                });
//        alert(url);
        }
</script>

<div class="pageHeader">
        <div style="height: 20px;">

        </div>

</div>
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
<div class="pageContent">

        <div id="tabbody-div" style="height: 100%;">
                <table width="90%" id="general-table">
                        <!-- 商品搜索 -->
                        <tbody>
                                <tr>
                                        <td style="padding-left: 50px;" colspan="5">
                                                <!--会员等级：-->
                                                <?php echo CHtml::dropDownList('rank_id', '0', $rankList, array('id' => 'user_rank_select')); ?>
                                                <?php
                                                        if ($arrGroup)
                                                        {
                                                                echo CHtml::dropDownList('group_id', 0, $arrGroup);
                                                        }
                                                ?>
                                                用户名：<input id="user_name_box" type="text" name="user_name" size="15">
                                                <input style="float: none; display: inline;" type="button" value=" 搜索 " onclick="searchUser()"  > 不填为搜索全部用户
                                        </td>

                                </tr>
                                <tr>
                                        <td width="25%" align="center">
                                                <select name="user_name_list[]" id="user_name_list" size="20" style="width:90%" multiple="true">
                                                </select>
                                        </td>
                                        <td align="left" valign="top" idth="25%">
                                                <table width="100%">
                                                        <tbody>
                                                                <tr >
                                                                        <td width="100" align="left" colspan="3">   </td>

                                                                </tr>
                                                                <tr>

                                                                        <td height="50" align="left" width="20%">需要发送邮件的用户：</td>

                                                                        <td id="user_box" align="left" width="50%">
                                                                                <select name="user_list[]" id="user_name_show" size="20" style="width:90%" multiple="true">
                                                                                </select>
                                                                        </td>
                                                                </tr>
                                                        </tbody></table>

                                        </td>
                                        <td align="left" valign="top" width="25%">
                                                <table width="100%">
                                                        <tbody>
                                                                <tr >

                                                                        <td height="50" align="left" width="10%">邮件标题：<input type="text" name='subject'></td>
                                                                </tr>
                                                                <tr>

                                                                        <td height="50" align="left" width="10%">邮件正文：</td>
                                                                </tr>
                                                                <tr>

                                                                        <td height="50" align="left" width="10%"> <?php echo CHtml::textArea('content', '', array('class' => 'editor', 'rows'  => 15, 'cols'  => 100, 'tools' => 'simple')); ?> </td>
                                                                </tr>
                                                        </tbody></table>

                                        </td>
                                </tr>
                                <tr>
                                        <td style="padding-left: 50px;" colspan="5">
                                                <br/><br/><br/><br/>
                                        </td>
                                </tr>

                        </tbody>
                </table>


        </div>
        <div class="formBar">
                <ul>
                        <li><div class="buttonActive"><div class="buttonContent"><button type="submit">发送邮件</button></div></div></li>
                        <li><div class="button"><div class="buttonContent"><button class="close" type="button">关闭</button></div></div></li>
                </ul>
        </div>
        <?php $this->endwidget(); ?>
</div>






<div class="pageContent">

</div>