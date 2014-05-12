<div class="form beforeFlightForm">

<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/fraapp.js',CClientScript::POS_END);
  // $cs->registerCssFile($baseUrl.'/css/yourcss.css');
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'operation-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>


	<table class="table table-striped table-bordered sp-input">
		<tr>
			<th colspan="9">CABIN</th>
		</tr>
		<tr>
			<td>
				<table class="table table-bordered">
					<tr>
						<th colspan="3">CONFIGURATION</th>
					</tr>
					<tr>
						<td>C/CL</td>
						<td>Y/CL</td>
						<td>T/CL</td>
					</tr>
					<tr>
						<td><?php echo $form->textField($model, 'cabin_config_ccl'); ?></td>
						<td><?php echo $form->textField($model, 'cabin_config_ycl'); ?></td>
						<td><?php echo $form->textField($model, 'cabin_config_tcl'); ?></td>
					</tr>
				</table>
			</td>
			<td>
				<table class="table table-bordered">
					<tr>
						<th colspan="3">PAX</th>
					</tr>
					<tr>
						<td>C/CL</td>
						<td>Y/CL</td>
						<td>T/CL</td>
					</tr>
					<tr>
						<td><?php echo $form->textField($model, 'cabin_pax_ccl'); ?></td>
						<td><?php echo $form->textField($model, 'cabin_pax_ycl'); ?></td>
						<td><?php echo $form->textField($model, 'cabin_pax_tcl'); ?></td>
					</tr>
				</table>
			</td>
			<td>
				<table class="table table-bordered">
					<tr>
						<th>INF</th>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td><?php echo $form->textField($model, 'cabin_inf'); ?></td>
					</tr>
				</table>
			</td>
			<td>
				<table class="table table-bordered">
					<tr>
						<th>ID/DZ</th>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td><?php echo $form->textField($model, 'cabin_id_dz'); ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>


	<!-- Outgoing delay codes -->
	<table class="table table-striped table-bordered outgoing">
		<tr>
			<th colspan="9">OUTGOING DELAY CODES</th>
		</tr>
		<tr>
			<td>
				<table class="table table-bordered">
					<tr>
						<th></th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
					</tr>
					<tr>
						<th>Code</th>
						<td><?php echo $form->textField($delayCode, 'cod1'); ?></td>
						<td><?php echo $form->textField($delayCode, 'cod2'); ?></td>
						<td><?php echo $form->textField($delayCode, 'cod3'); ?></td>
						<td><?php echo $form->textField($delayCode, 'cod4'); ?></td>
					</tr>
					<tr>
						<th>Minute</th>
						<td><?php echo $form->textField($delayCode, 'min1'); ?></td>
						<td><?php echo $form->textField($delayCode, 'min2'); ?></td>
						<td><?php echo $form->textField($delayCode, 'min3'); ?></td>
						<td><?php echo $form->textField($delayCode, 'min4'); ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	


	<?php echo CHtml::label('Teknisyen', 'Operation_technician_id' ,array('class'=>'span4')); ?>
	<?php echo $form->dropDownList($model,'technician_id', CHtml::listData(User::getAllTechnicians(), 'id', 'username') ); ?>
	<?php //echo $form->error($model,'aircrafttype_id'); ?>



	<table class="operationSteps table table-striped table-bordered">
		<tr>
			<th>Operation Description</th>
			<th>Check</th>
			<th>Time</th>
		</tr>
		<tr>
			<td>1. Ucak bilgileri ERP sistemine girildi</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('erp_entry_done', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'erp_entry_done'); ?>
				</div>
			</td>
			<td></td>
		</tr>
	</table>

	<div class="row">
		<?php echo CHtml::label('2. Operasyonla ilgili aksakliklar veya yorumlar.', 'Operation_op_error_log' ); ?>
		<?php echo $form->textArea($model, 'op_error_log', array('style'=>'width:99%;', 'rows'=>'10')); ?>
	</div>

	<div class="row">
		<?php echo CHtml::submitButton('Save and create a new Operation', array('class'=>'btn btn-primary btn-large', 'onclick'=>'return areAllCheckBoxesChecked();')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->


