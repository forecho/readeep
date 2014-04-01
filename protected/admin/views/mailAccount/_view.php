<?php
/* @var $this MailAccountController */
/* @var $data MailAccount */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mai_account_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mai_account_id), array('view', 'id'=>$data->mai_account_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mail_account')); ?>:</b>
	<?php echo CHtml::encode($data->mail_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mail_password')); ?>:</b>
	<?php echo CHtml::encode($data->mail_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('host')); ?>:</b>
	<?php echo CHtml::encode($data->host); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('port')); ?>:</b>
	<?php echo CHtml::encode($data->port); ?>
	<br />


</div>