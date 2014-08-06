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
				<h1 class="mtb10"><?php echo $model->title; ?></h1>
				<ul>
					<li>
						<i class="fi-torso"></i>
						<?php echo $model->weixin_set->name; ?>
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
				<?php echo CHtml::link(CHtml::image($model->image, '',array('class'=>'w100 mb20')), $model->image); ?>
				<?php echo CHtml::image($model->image, '',array('class'=>'w100 mb20') ?>
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
			<!-- Duoshuo Comment BEGIN -->
			<div class="ds-thread" data-thread-key="<?php echo $model->id; ?>" data-title="<?php echo $model->title; ?>" data-image="<?php echo $model->image; ?>"></div>
			<!-- <div class="ds-thread"></div> -->
			<script type="text/javascript">
			var duoshuoQuery = {short_name:"readeep"};
				(function() {
					var ds = document.createElement('script');
					ds.type = 'text/javascript';ds.async = true;
					ds.src = 'http://static.duoshuo.com/embed.js';
					ds.charset = 'UTF-8';
					(document.getElementsByTagName('head')[0]
					|| document.getElementsByTagName('body')[0]).appendChild(ds);
				})();
				</script>
			<!-- Duoshuo Comment END -->
		</article>
  	</div>
  	<div class="medium-3 large-3 columns pl10">
  		<aside class="sidebar">
			<div class="block column-about">
				<?php echo CHtml::link(
						CHtml::image($model->weixin_set->avatar, '',array('class'=>'avatar-big')),
						array('view', 'aid'=>$model->admin_id),
						array('class'=>'avatar-link')
				);?>
				<?php echo CHtml::link($model->weixin_set->name,
						array('view', 'id'=>$model->admin_id),
						array('class'=>'title')
				);?>
			  	<div class="mt10 description"><p><?php echo $model->weixin_set->description; ?></p></div>
			  	<div class="tags mtb10">
			  		<?php $tags = explode(' ', $model->tags); ?>
					<?php foreach ($tags as $key => $value): ?>
						<?php echo CHtml::link($value,
								array('index', 'PostPosts[tags]'=>$value),
								array('class'=>'tag')
						);?>
					<?php endforeach ?>
			  	</div>
			</div>
		</aside>
  	</div>
</div>
<script>
//微信Native图片插件
var srcList = [];
$.each($('section img'),function(i,item){
    var src = 'http://' + location.host + $(this).attr('src');
    if (src) {
        srcList.push(src);
        $(item).click(function(e){
            WeixinJSBridge.invoke('imagePreview', {
                'current' : src,
                'urls' : srcList
            });
        });
    }
});
</script>