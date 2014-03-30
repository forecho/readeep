<?php
/* @var $this ContactPersonController */
/* @var $model ContactPerson */

$this->breadcrumbs=array(
	'Contact People'=>array('index'),
	$model->contact_person_id=>array('view','id'=>$model->contact_person_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContactPerson', 'url'=>array('index')),
	array('label'=>'Create ContactPerson', 'url'=>array('create')),
	array('label'=>'View ContactPerson', 'url'=>array('view', 'id'=>$model->contact_person_id)),
	array('label'=>'Manage ContactPerson', 'url'=>array('admin')),
);
?>

<h1>Update ContactPerson <?php echo $model->contact_person_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>