<?php
/* @var $this WeixinSetController */
/* @var $data WeixinSet */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('token')); ?>:</b>
	<?php echo CHtml::encode($data->token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wx_id')); ?>:</b>
	<?php echo CHtml::encode($data->wx_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rawid')); ?>:</b>
	<?php echo CHtml::encode($data->rawid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avatar')); ?>:</b>
	<?php echo CHtml::encode($data->avatar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qr_code')); ?>:</b>
	<?php echo CHtml::encode($data->qr_code); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_id')); ?>:</b>
	<?php echo CHtml::encode($data->admin_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	*/ ?>

</div>