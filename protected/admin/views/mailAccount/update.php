<?php
/* @var $this MailAccountController */
/* @var $model MailAccount */

$this->breadcrumbs=array(
	'Mail Accounts'=>array('index'),
	$model->mai_account_id=>array('view','id'=>$model->mai_account_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MailAccount', 'url'=>array('index')),
	array('label'=>'Create MailAccount', 'url'=>array('create')),
	array('label'=>'View MailAccount', 'url'=>array('view', 'id'=>$model->mai_account_id)),
	array('label'=>'Manage MailAccount', 'url'=>array('admin')),
);
?>

<h1>Update MailAccount <?php echo $model->mai_account_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>