<?php
/* @var $this OperationController */
/* @var $model Operation */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_id'); ?>
		<?php echo $form->textField($model,'flight_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aircrafttype_id'); ?>
		<?php echo $form->textField($model,'aircrafttype_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'before_flight_check_time'); ?>
		<?php echo $form->textField($model,'before_flight_check_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'onblock'); ?>
		<?php echo $form->textField($model,'onblock'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'door_opened'); ?>
		<?php echo $form->textField($model,'door_opened'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gettingout_passangers'); ?>
		<?php echo $form->textField($model,'gettingout_passangers'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cleaning'); ?>
		<?php echo $form->textField($model,'cleaning'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'security_check'); ?>
		<?php echo $form->textField($model,'security_check'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'boarding_business'); ?>
		<?php echo $form->textField($model,'boarding_business'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'boarding_economy'); ?>
		<?php echo $form->textField($model,'boarding_economy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doors_closed'); ?>
		<?php echo $form->textField($model,'doors_closed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bagage_doors_closed'); ?>
		<?php echo $form->textField($model,'bagage_doors_closed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pushback'); ?>
		<?php echo $form->textField($model,'pushback'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'erp_entry_done'); ?>
		<?php echo $form->textField($model,'erp_entry_done'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'op_error_log'); ?>
		<?php echo $form->textArea($model,'op_error_log',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->