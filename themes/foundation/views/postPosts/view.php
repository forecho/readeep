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
		<article class="post-view">
			<header>
				<?php //echo $model->id; ?>
				<?php echo CHtml::link(CHtml::image($model->image, '',array('class'=>'w100')), $model->image); ?>
				<h1 class="mtb10"><?php echo $model->title; ?></h1>
				<ul>
					<li>
						<i class="fi-torso"></i>
						<?php echo $model->admin->username; ?>
					</li>
					<li>
						<i class="fi-calendar"></i>
						<?php echo timeShaft($model->create_time); ?>
					</li>
					<li>
						<i class="fi-eye"></i>
						<?php echo $model->view_count; ?>次围观
					</li>
				</ul>
			</header>
			<section class="mtb20">
				<?php echo $model->content; ?>
			</section>
			<footer>
				<div>
					<?php if ($like_count) {
						echo CHtml::link(
								CHtml::tag('i', array('class'=>'fi-like'), ' <em>'.$model->like_count.'</em> 赞'),
								'javaccript:;',
								array('class'=>'button tiny button-hover')
							);
					} else {
						echo CHtml::ajaxLink(
						    	CHtml::tag('i', array('class'=>'fi-like'), ' <em>'.$model->like_count.'</em> 赞'),
							    array('postPosts/addLike'),
							    array(
							    	'type'=>'GET',
							        'dataType'=>'json',
							        'data'=>'js:{ "id":'.$model->id.' }',
							        'success'=>'function(html){ jQuery("#post-like em").html(html); }',
							        'complete' => 'function() {
							          	$("#post-like").addClass("button-hover");
							          	$("#post-like").removeAttr("id");
							        }',
							    ),
							    array('class'=>'button tiny', 'id'=>'post-like','live'=>false)
							);
					} ?>
					<?php if ($thanks_count) {
						echo CHtml::link(
								CHtml::tag('i', array('class'=>'fi-heart'), ' '.$model->thanks_count.' 感谢'),
								'javaccript:;',
								array('class'=>'button tiny button-hover')
							);
					} else {
						echo CHtml::ajaxLink(
						    CHtml::tag('i', array('class'=>'fi-heart'), ' <em>'.$model->thanks_count.'</em> 感谢'),
						    array('postPosts/addThanks'),
						    array(
						    	'type'=>'GET',
						        'dataType'=>'json',
						        'data'=>'js:{ "id":'.$model->id.' }',
						        'success'=>'function(html){ jQuery("#post-thanks em").html(html); }',
						        'complete' => 'function() {
						          	$("#post-thanks").addClass("button-hover");
						          	$("#post-thanks").removeAttr("id");
						        }',
						    ),
						    array('class'=>'button tiny', 'id'=>'post-thanks','live'=>false)
						);
					} ?>
				</div>
			</footer>
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
