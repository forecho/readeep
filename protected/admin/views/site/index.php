<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<div class="row">
	<?php foreach ($data as $key => $value): ?>
		<div class="col-sm-6 col-md-4">
			<a href="<?php echo Yii::app()->createUrl('weixinSet/view', array('id' => $value->id)); ?>">
				<div class="thumbnail">
					<img src="<?php echo $value->avatar; ?>" alt="<?php echo $value->name; ?>">
					<div class="caption">
						<h3><?php echo $value->name; ?></h3>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach ?>
</div>