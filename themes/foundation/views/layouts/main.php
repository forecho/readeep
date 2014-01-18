<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/foundation.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/normalize.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/foundation-icons/foundation-icons.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="off-canvas-wrap">
	<div class="inner-wrap">
		<nav class="top-bar docs-bar hide-for-small" data-topbar="">
			 <ul class="title-area">
			    <li class="name">
			    	<h1><a href="http://foundation.zurb.com/">Foundation</a></h1>
			    </li>
			</ul>
		<section class="top-bar-section">
			<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index')),
					array('label'=>'Post', 'url'=>array('/postPosts/index')),
					array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'Contact', 'url'=>array('/site/contact')),
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
			)); ?>
		    <ul class="right">
				<li class="divider"></li>
				<li class="has-dropdown not-click">
					<a href="http://foundation.zurb.com/learn/features.html" class="">Learn</a>
					<ul class="dropdown"><li class="title back js-generated"><h5><a href="javascript:void(0)">Back</a></h5></li>
						<li><a href="http://foundation.zurb.com/learn/about.html">About</a></li>
					</ul>
				</li>
				<li class="divider"></li>
				<li>
					<a href="http://foundation.zurb.com/business/services.html" class="">Business</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="http://foundation.zurb.com/docs" class="">Docs</a>
				</li>
				<li class="divider"></li>
			</ul>
		  </section>
		</nav>


	    <nav class="tab-bar show-for-small">
			<section class="left-small">
				<a class="left-off-canvas-toggle menu-icon"><span></span></a>
			</section>

			<section class="middle tab-bar-section">
				<h1 class="title">Foundation</h1>
			</section>

			<section class="right-small">
				<a class="right-off-canvas-toggle menu-icon"><span></span></a>
			</section>
	    </nav>

	    <aside class="left-off-canvas-menu">
			<ul class="off-canvas-list">
				<li><label>Foundation</label></li>
				<li><a href="#">The Psychohistorians</a></li>
				<li><label>Foundation and Empire</label></li>
				<li><a href="#">The General</a></li>
				<li><label>Second Foundation</label></li>
				<li><a href="#">Search by the Mule</a></li>
				<li><a href="#">Search by the Foundation</a></li>
			</ul>
	    </aside>

	    <aside class="right-off-canvas-menu">
			<ul class="off-canvas-list">
				<li><label>Users</label></li>
				<li><a href="#">Emperor Cleon I</a></li>
				<li><a href="#">Salvor Hardin</a></li>
				<li><a href="#">Bel Riose</a></li>
			</ul>
	    </aside>

	    <section class="main-section">
			<div class="row">
				<div class="large-12 columns">
					<?php echo $content; ?>
				</div>
			</div>
	    </section>
	    <div class="clear"></div>

		<div id="footer">
			<div class="row">
				<div class="large-12 columns">
				Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
				All Rights Reserved.<br/>
				<?php echo Yii::powered(); ?>
				</div>
			</div>
		</div><!-- footer -->

  		<a class="exit-off-canvas"></a>

	</div>
</div>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/foundation/foundation.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/foundation/foundation.offcanvas.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/foundation/foundation.topbar.js"></script>
<script>
	$(document).foundation();
</script>
</body>
</html>
