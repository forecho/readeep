<?php
/* @var $this PostPostsController */
/* @var $model PostPosts */

$this->breadcrumbs=array(
	'Post Posts'=>array('index'),
	$model->title,
);
?>
<div class="row">
	<div class="medium-9 large-9 columns">
		<article>
			<header>
				<?php //echo $model->id; ?>
				<?php echo CHtml::link(CHtml::image($model->image, '',array('class'=>'w100')), $model->image); ?>
				<h1 class="mtb10"><?php echo $model->title; ?></h1>
				<?php echo $model->create_time; ?>

				<?php echo $model->admin->username; ?>

				<?php $tags = explode(' ', $model->tags); ?>
				<?php foreach ($tags as $key => $value): ?>
				<?php echo $value; ?>
				<?php endforeach ?>
			</header>
			<section class="mtb20">
				<?php echo $model->content; ?>
				<?php echo $model->view_count; ?>
				<?php echo $model->thanks_count; ?>
				<?php echo $model->like_count; ?>
			</section>
		</article>
  	</div>
  	<div class="medium-3 large-3 columns headspace-20">
  		<aside class="sidebar">

		<div class="block column-about">
		  	<a href="/WebNotes" class="avatar-link">
		    	<img class="avatar-big" ng-src="http://p1.zhimg.com/53/d2/53d2d98a0_l.jpg" src="http://p1.zhimg.com/53/d2/53d2d98a0_l.jpg">
		  	</a>
		  	<a href="/WebNotes" class="title ng-binding">小道消息</a>
		  	<!-- ngIf: column.creator.slug == me.slug -->
		  	<div class="followers" ng-switch="" on="!!column.followersCount">
			    <!-- ngSwitchWhen: true --><a ng-switch-when="true" href="/WebNotes/followers" class="ng-scope ng-binding">5023 人关注</a>
			    <!-- ngSwitchWhen: false -->
		  	</div>
		  	<div class="description ng-binding" ng-bind-html="column.description | linky">小道消息，只有小道消息才能拯救中国互联网。</div>
		</div>

		<div class="block rel-topics ng-hide" ng-show="post.state != 'censoring' &amp;&amp; (post.topics.length || ownPost(post))">
		  	<!-- ngIf: post.topics.length -->
		  	<!-- ngIf: ownPost(post) -->
		</div>

		</aside>
  	</div>
</div>
