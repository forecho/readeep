<?php
/* @var $this MailAccountController */
/* @var $model MailAccount */

$this->breadcrumbs=array(
	'Mail Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MailAccount', 'url'=>array('index')),
	array('label'=>'Manage MailAccount', 'url'=>array('admin')),
);
?>

<h1>Create MailAccount</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>