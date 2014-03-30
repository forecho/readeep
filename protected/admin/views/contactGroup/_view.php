<?php
/* @var $this ContactGroupController */
/* @var $data ContactGroup */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_group_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->contact_group_id), array('view', 'id'=>$data->contact_group_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mail_template_id')); ?>:</b>
	<?php echo CHtml::encode($data->mail_template_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_group_name')); ?>:</b>
	<?php echo CHtml::encode($data->contact_group_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_group_parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->contact_group_parent_id); ?>
	<br />


</div>