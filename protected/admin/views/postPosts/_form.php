<?php
/* @var $this PostPostsController */
/* @var $model PostPosts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-posts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'excerpt'); ?>
		<?php echo $form->textArea($model,'excerpt',array('rows'=>6, 'cols'=>50,'class'=>'form-control','maxlength'=>255)); ?>
		<?php echo $form->error($model,'excerpt'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php $this->widget('ext.yii-elfinder.ServerFileInput', array(
		        'model' => $model,
		        'attribute' => 'image',
		        'connectorRoute' => 'elfinder/connector',
		    )
		);?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php $this->widget('ext.yii-tinymce.TinyMce', array(
		    'model' => $model,
		    'attribute' => 'content',
		    // Optional config
		    'compressorRoute' => 'tinyMce/compressor',
		    // 'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
		    'spellcheckerUrl' => array('tinyMce/spellchecker'),
		    'fileManager' => array(
		        'class' => 'ext.yii-elfinder.TinyMceElFinder',
		        'connectorRoute'=>'elfinder/connector',
		    ),
		    'htmlOptions' => array(
		        'rows' => 30,
		        'cols' => 60,
		    ),
		));?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'create_time'); ?>
			<?php $this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
			    'model'=>$model,
			    'attribute'=>'create_time',
			    'language'=>'zh-CN',
			    'options'=>array(
			        'hourGrid' => 4,
			        'hourMin' => 9,
			        'hourMax' => 17,
			        'timeFormat' => 'hh:mm',
			        'changeMonth' => true,
			        'changeYear' => false,
			        ),
			    'htmlOptions'=>array(
		    		'readonly'=>true,
		    		'class'=>'form-control',
		    		'style'=>'width:180px;'
		    	),
			)); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array('1'=>'发布','0'=>'草稿'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'order'); ?>
		<?php echo $form->textField($model,'order',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'order'); ?>
		<p class="hint">
			提示：数字越小，越排前面。0在第一位。
		</p>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php $this->widget('ext.yii-selectize.YiiSelectize', array(
		    'name' => 'tags',
		    'selectedValues' => explode(' ', $model->tags),
		    'data' => PostTags::model()->getAllTags(),
		    'fullWidth' => false,
		    'htmlOptions' => array(
		        'style' => 'width: 50%',
		    ),
		    'multiple' => true,
		)); ?>
		<?php //echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'tags'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton(
			$model->isNewRecord ? 'Create' : 'Save',
			array('class'=>'btn btn-primary')
		); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->