
<div class="pageContent">
        <?php
                $imgPath = dirname(ADMIN) . '/upload/article_img/';
                $form    = $this->beginWidget('CActiveForm', array('id'          => "dwz_form",
                    'htmlOptions' => array(
                        'class'      => 'pageForm required-validate',
                        'onsubmit'   => 'return iframeCallback(this);',
                        'novalidate' => 'novalidate',
                        'target'     => "callbackframe",
                        'enctype'    => 'multipart/form-data',
                )));
        ?>
        <div class="pageFormContent" layoutH="97">
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
                                        <?php
                                                foreach ($mailSettings['vars'] as $key => $value)
                                                {
                                                        echo "<dl class=nowrap>
                                                                <dt>$value[name]</dt>
                                                             ";
                                                        if (isset($value['store_options']))
                                                        {
                                                                $select=array();
                                                                echo "<dd>";
                                                                foreach ($value['store_options'] as $k => $v)
                                                                {
                                                                        $select[$v] = $value['display_options'][$k];
                                                                }
                                                                echo "<dd class=yii_label>";
                                                                echo CHtml::radioButtonList("mail[$value[id]]]", $value['value'], $select, array('separator' => '&nbsp;', 'style'     => 'float:none;'));
                                                                echo "</dd>";
                                                        }
                                                        else
                                                        {
                                                                 echo "<dd class=yii_label>";
                                                                echo CHtml::textField("mail[$value[id]]]", $value['value']);
                                                                echo "</dd>";
                                                        }
                                                        echo "</dl>";
                                                }
                                        ?>
                                       

                                </div>
                                <!--文章内容-->
                                <div>

                                </div>

                        </div>
                        <div class="tabsFooter">
                                <div class="tabsFooterContent"></div>
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
