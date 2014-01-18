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
			</header>
			<section class="mtb20">
				<?php echo $model->content; ?>
				<?php echo $model->view_count; ?>
				<?php echo $model->thanks_count; ?>
				<?php echo $model->like_count; ?>
			</section>
		</article>
  	</div>
  	<div class="medium-3 large-3 columns pl10">
  		<aside class="sidebar">
			<div class="block column-about">
				<?php echo CHtml::link(
						CHtml::image($model->admin->avatar, '',array('class'=>'avatar-big')),
						array('view', 'aid'=>$model->admin_id),
						array('class'=>'avatar-link')
				);?>
				<?php echo CHtml::link($model->admin->username,
						array('view', 'aid'=>$model->admin_id),
						array('class'=>'title')
				);?>
			  	<div class="mt10 description"><?php echo $model->admin->description; ?></div>
			  	<div class="tags mt10">
			  		<?php $tags = explode(' ', $model->tags); ?>
					<?php foreach ($tags as $key => $value): ?>
						<?php echo CHtml::link($value,
								array('view', 'tag'=>$value),
								array('class'=>'tag')
						);?>
					<?php endforeach ?>
			  	</div>
			</div>
		</aside>
  	</div>
</div>
