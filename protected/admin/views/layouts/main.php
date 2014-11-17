<?php /* @var $this Controller */ ?>
<!DOCTYPE html >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/webroot/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/webroot/css/sb-admin-2.css" />
    <link href="/webroot/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/webroot/css/style.css" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="navbar navbar-default navbar-fixed-top">
   <div class="navbar-header">
        <?php echo CHtml::link(Yii::app()->name, array('site/index'), array('class'=>'navbar-brand')); ?>
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse" id="navbar-main">
        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
            'htmlOptions'=>array('class'=>'nav navbar-nav navbar-right mr10'),
        )); ?>
    </div>

    <?php $this->beginWidget('zii.widgets.CPortlet', array(
            'contentCssClass'=>'sidebar-nav navbar-collapse',
            'htmlOptions'=>array('class'=>'navbar-default sidebar', 'role' => 'navigation'),
        ));
        $this->widget('zii.widgets.CMenu',array(
            'htmlOptions'=>array('class'=>'nav', 'id'=>'side-menu'),
            'items'=>array(
                array(
                    'label'=>'网站概况',
                    'url'=>array('/admin'),
                    'active'=>$this->id=='admin'?true:false
                ),
                array(
                    'label'=>t('WeixinSet', 'menu'),
                    'url'=>array('/'),
                    'active'=>$this->id=='weixinSet'?true:false,
                    'submenuOptions'=>array('class'=>'nav nav-second-level collapse'),
                    'items'=>array(
                        array(
                            'label'=>'文本回复',
                            'url'=>array('/weixinSet/admin'),
                        ),
                    ),
                ),
                array(
                    'label'=>t('WeixinReply', 'menu'),
                    'url'=>array('/'),
                    'active'=>$this->id=='weixinReply'?true:false,
                    'submenuOptions'=>array('class'=>'nav nav-second-level collapse'),
                    'items'=>array(
                        array(
                            'label'=>'文本回复',
                            'url'=>array('/weixinSet/admin'),
                        ),
                    ),
                ),
                array(
                    'label'=>t('Post', 'menu'),
                    'url'=>array('/'),
                    'active'=>$this->id=='postPosts'?true:false,
                    'submenuOptions'=>array('class'=>'nav nav-second-level collapse'),
                    'items'=>array(
                        array(
                            'label'=>'文章列表',
                            'url'=>array('/postPosts/admin'),
                        ),
                        array(
                            'label'=>'新建文章',
                            'url'=>array('/postPosts/create'),
                        ),
                    ),
                ),
                array(
                    'label'=>t('Options', 'menu'),
                    'url'=>array('/'),
                    'active'=>$this->id=='weixinReply'?true:false,
                    'submenuOptions'=>array('class'=>'nav nav-second-level collapse'),
                    'items'=>array(
                        array(
                            'label'=>'七牛',
                            'url'=>array('/weixinSet/admin'),
                        ),
                        array(
                            'label'=>'邮件',
                            'url'=>array('/weixinSet/admin'),
                        ),
                    ),
                ),
                array(
                    'label'=>t('Statistics', 'menu'),
                    'url'=>array('/'),
                    'active'=>$this->id=='weixinReply'?true:false,
                    'submenuOptions'=>array('class'=>'nav nav-second-level collapse'),
                    'items'=>array(
                        array(
                            'label'=>'文章统计',
                            'url'=>array('/weixinSet/admin'),
                        ),
                        array(
                            'label'=>'会员统计',
                            'url'=>array('/weixinSet/admin'),
                        ),
                    ),
                ),
                array(
                    'label'=>'图片管理',
                    'url'=>array('/picture'),
                    'active'=>$this->id=='picture'?true:false,
                ),
                array(
                    'label'=>'管理员管理',
                    'url'=>array('/'),
                    'active'=>$this->id=='admin'?true:false,
                    'submenuOptions'=>array('class'=>'nav nav-second-level collapse'),
                    'items'=>array(
                        array(
                            'label'=>'管理员列表',
                            'url'=>array('/admin/admin'),
                        ),
                        array(
                            'label'=>'新建管理员',
                            'url'=>array('/admin/create'),
                        ),
                    ),
                    'visible'=>(Yii::app()->user->name == 'admin'),
                ),
                array(
                    'label'=>'密码修改',
                    'url'=>array('/manager/changepswd'),
                    'linkOptions'=>array('target'=>'_blank'),
                    'submenuOptions'=>array('class'=>'nav nav-second-level collapse'),
                    'items'=>array(
                        array(
                            'label'=>'网站概况',
                            'url'=>array('/admin'),
                            'active'=>$this->id=='admin'?true:false
                        ),
                    ),
                    'active'=>($this->id=='manager' && $this->action->id=='changepswd')?true:false,
                ),
                array(
                    'label'=>'登陆',
                    'url'=>array('/site/login'),
                    'visible'=>Yii::app()->user->isGuest
                ),
                array(
                    'label'=>'退出 ('.Yii::app()->user->name.')',
                    'url'=>array('/site/logout'),
                    'itemOptions'=>array('class'=>'li_login'),
                    'visible'=>!Yii::app()->user->isGuest
                )
            ),
        ));

        $this->endWidget();?>
</div>

<div class="" id="page-wrapper">
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    <div class="row">
        <?php echo renderFlash(); ?>
        <?php echo $content; ?>
    </div>
    <div class="clear"></div>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
        All Rights Reserved.<br/>
        <?php echo Yii::powered(); ?>
    </div><!-- footer -->

</div><!-- page -->
<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/webroot/js/script.js"></script>
<script src="/webroot/js/plugins/metisMenu/metisMenu.min.js"></script>
<script src="/webroot/js/sb-admin-2.js"></script>
<script>
$('ul.nav li a').each(function(){
    if ($(this)[0].href == window.location.href) {
        $(this).addClass('active');
    }
});
</script>
</body>
</html>
