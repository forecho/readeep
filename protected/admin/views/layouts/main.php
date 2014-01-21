<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
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
					array('label'=>t('Home', 'menu'), 'url'=>array('/site/index')),
					array('label'=>t('Card','menu'), 'url'=>array('/card/index')),
					array('label'=>t('Post','menu'), 'url'=>array('/postPosts/index')),
					array('label'=>t('CardType','menu'), 'url'=>array('/cardType/index')),
					array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'Contact', 'url'=>array('/site/contact')),
				),
				'htmlOptions'=>array('class'=>'nav navbar-nav'),
			)); ?>
			<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
				'htmlOptions'=>array('class'=>'nav navbar-nav navbar-right'),
			)); ?>
		</div>
	</div>
</div>

<div class="container page-header" id="page">
	<div class="page-header">
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>
	</div>
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
</body>
</html>
