<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6,)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php
		if($model->start_date){	
			$start_date = date("d.m.Y",strtotime($model->start_date));
			$end_date = date("d.m.Y",strtotime($model->end_date));
		}else {
			$start_date = '';
			$end_date = '';
		}

		$model->start_date = $start_date;
		$model->end_date = $end_date;
		 ?>
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php //echo $model->getEndDate(); ?>
		<?php 
		Yii::app()->clientScript->registerScript('ticket_dates',"
				$(function(){
					var start_date = '{$start_date}';
					var end_date = '{$end_date}';

					$('#Ticket_start_date').datepicker({
						minDate: new Date(Date.now()),
						dateFormat: 'dd.mm.yy',
						// defaultDate: start_date,
						showAnim: 'fadeIn',
						onSelect: function(){
							var minDate = $(this).datepicker('getDate');
				            $('#Ticket_end_date').datepicker( 'option', 'minDate', minDate);
						}
					});

					$('#Ticket_end_date').datepicker({
						minDate: new Date(Date.now()),
						dateFormat: 'dd.mm.yy',
						defaultDate: end_date,
						showAnim: 'fadeIn',
						onSelect: function() {
				            // var maxDate = $(this).datepicker('getDate');
				            var maxDate = $(this).val();
				            $('#Ticket_start_date').datepicker( 'option', 'maxDate', maxDate);
				        }
					});
				});
			");
		?>
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?php echo $form->textField($model,'end_date'); ?>
		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">
		<h3>Assign Users * :</h3>
		<?php echo CHtml::dropDownList('Ticket[aUserAssignmentIDs]', $model->getUserAssignmentIDs() ,CHtml::listData(User::getAllUsers(),'id','name'), array('multiple' => 'true', 'size' => '7',) ); ?>
		<?php echo $form->error($model,'user_assignment'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->