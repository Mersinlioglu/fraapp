<?php
/* @var $this OperationController */
/* @var $model Operation */
/* @var $form CActiveForm */
?>

<div class="form beforeFlightForm">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'operation-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'col1', array('class'=>'span8')); ?>
		<?php echo $form->checkBox($model,'col1', array('class'=>'span4')); ?>
		<?php echo $form->error($model,'col1'); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'col1', array('class'=>'span8')); ?>
		<?php echo $form->checkBox($model,'col1', array('class'=>'span4')); ?>
		<?php echo $form->error($model,'col1'); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'col1', array('class'=>'span8')); ?>
		<?php echo $form->checkBox($model,'col1', array('class'=>'span4')); ?>
		<?php echo $form->error($model,'col1'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->