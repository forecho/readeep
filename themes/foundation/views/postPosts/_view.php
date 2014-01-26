<?php
/* @var $this PostPostsController */
/* @var $data PostPosts */
?>

<div class="medium-6 large-6 columns">
	<article class="panel p0 post-list">
		<header>
			<div class="post-title">
			<h1><?php echo $data->title; ?></h1>
				<?php echo CHtml::link(
						$data->weixin_set->name,
						array('view', 'id'=>$data->id)
				);?>
				<span> · </span>
				<time datetime="<?php echo $data->create_time; ?>"><?php echo timeShaft($data->create_time); ?></time>
				<?php
				/* <a href="<?php echo Yii::app()->createUrl('postPosts/view', array('id' => $data->id))?>">
					<i class="fi-comment"></i>
					<span><?php if ($data->comment_count): ?>
						<?php echo $data->comment_count; ?>条评论
					<?php else: ?>
						没有评论
					<?php endif ?></span>
				</a> */
				?>
				<a href="<?php echo Yii::app()->createUrl('postPosts/view', array('id' => $data->id))?>">
					<i class="fi-like"></i>
					<span><?php if ($data->like_count): ?>
						<?php echo $data->like_count; ?> 赞
					<?php else: ?>
						没有赞
					<?php endif ?></span>
				</a>
			</div>
			<?php  echo CHtml::link('', array('view', 'id'=>$data->id), array('class'=>'post-link')); ?>
		  	<div class="post-img" style="background-image: url(<?php echo $data->image; ?>);"></div>
		</header>
	</article>
</div>