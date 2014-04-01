<?php
/* @var $this MailAccountController */
/* @var $model MailAccount */

$this->breadcrumbs=array(
	'Mail Accounts'=>array('index'),
	$model->mai_account_id,
);

$this->menu=array(
	array('label'=>'List MailAccount', 'url'=>array('index')),
	array('label'=>'Create MailAccount', 'url'=>array('create')),
	array('label'=>'Update MailAccount', 'url'=>array('update', 'id'=>$model->mai_account_id)),
	array('label'=>'Delete MailAccount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mai_account_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MailAccount', 'url'=>array('admin')),
);
?>

<h1>View MailAccount #<?php echo $model->mai_account_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mai_account_id',
		'mail_account',
		'mail_password',
		'host',
		'port',
	),
)); ?>
