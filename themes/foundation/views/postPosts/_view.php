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
			<time datetime="<?php echo $data->create_time; ?>"><?php echo timeShaft($data->create_time); ?></time>
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
		<?php  echo CHtml::link('', array('view', 'id'=>$data->id), array('class'=>'post-link')); ?>
	  	<div class="post-img" style="background-image: url(<?php echo $data->image; ?>);"></div>
	</div>
</div>