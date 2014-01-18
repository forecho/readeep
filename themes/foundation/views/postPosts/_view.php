<?php
/* @var $this PostPostsController */
/* @var $data PostPosts */
?>

<div class="medium-6 large-6 columns">
<div class="panel p0 bd0 post-list">
	<h1><?php echo $data->title; ?></h1>
	<div>
		<a href=""><?php echo $data->admin->username; ?></a>
		<span></span>
		<time datetime="<?php echo $data->create_time; ?>"><?php echo $data->create_time; ?></time>
		<a href="">
			<i class="fi-comment"></i>
			<span><?php if ($data->comment_count): ?>
				<?php echo $data->comment_count; ?>条评论</span>
			<?php else: ?>
				没有评论</span>
			<?php endif ?>
		</a>
		<a href="">
			<i class="fi-like"></i>
			<span><?php if ($data->like_count): ?>
				<?php echo $data->like_count; ?> 赞</span>
			<?php else: ?>
				没有赞</span>
			<?php endif ?>
		</a>
	</div>
	<?php // echo CHtml::link(CHtml::image($data->image, '',array('class'=>'w100')), array('view', 'id'=>$data->id), array('class'=>'post-img')); ?>
	<?php  echo CHtml::link('', array('view', 'id'=>$data->id), array('class'=>'post-link')); ?>
  	<div class="post-img" style="background-image: url(<?php echo $data->image; ?>);"></div>
  	<!-- <h5>This is a regular panel.</h5>
  	<p>It has an easy to override visual style, and is appropriately subdued.</p> -->
</div>
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('excerpt')); ?>:</b>
	<?php echo CHtml::encode($data->excerpt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order')); ?>:</b>
	<?php echo CHtml::encode($data->order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tags')); ?>:</b>
	<?php echo CHtml::encode($data->tags); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_count')); ?>:</b>
	<?php echo CHtml::encode($data->view_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thanks_count')); ?>:</b>
	<?php echo CHtml::encode($data->thanks_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('like_count')); ?>:</b>
	<?php echo CHtml::encode($data->like_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_id')); ?>:</b>
	<?php echo CHtml::encode($data->admin_id); ?>
	<br />

	*/ ?>

</div>