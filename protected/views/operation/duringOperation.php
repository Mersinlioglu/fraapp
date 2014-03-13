<?php
/* @var $this OperationController */
/* @var $model Operation */
/* @var $form CActiveForm */
?>

<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/fraapp.js',CClientScript::POS_END);
  // $cs->registerCssFile($baseUrl.'/css/yourcss.css');
?>

<h1 class="header">During Operation
    <span class="header-line"></span> 
</h1>

<div class="form beforeFlightForm">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'operation-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<table class="table table-striped ">
		<tr>
			<td>Sectiginiz ucak tipinin <?php echo $model->aircrafttype->name; ?> boden süresi</td>
			<td><?php echo $model->aircrafttype->ground_time; ?> dk</td>
		</tr>
		<tr>
			<td>Tarifeli kalkisi</td>
			<td><?php echo $model->flight->departure_time; ?></td>
		</tr>
		<tr>
			<td>Pushback icin kalan zaman birimi</td>
			<td><p id="counter1"></p></td>
		</tr>
	</table>

	<script type="text/javascript">
	
		// the difference timestamp
		var timestamp = <?php echo $model->flight->getRemainingTime(); ?>;

		// timestamp /= 1000; // from ms to seconds

		function component(x, v) {
		    return Math.floor(x / v);
		}

		function addLeadingZeros(number, length) {
		    var num = '' + number;
		    while (num.length < length) num = '0' + num;
		    return num;
		}

		var $div = $('#counter1');

		setInterval(function() { // execute code each second

		    timestamp--; // decrement timestamp with one second each second

		    var days    = component(timestamp, 24 * 60 * 60),      // calculate days from timestamp
		        hours   = component(timestamp,      60 * 60) % 24, // hours
		        minutes = component(timestamp,           60) % 60, // minutes
		        seconds = component(timestamp,            1) % 60; // seconds

		    hours = addLeadingZeros(hours, 2);
		    minutes = addLeadingZeros(minutes, 2);
		    seconds = addLeadingZeros(seconds, 2);

		    // $div.html(days + " days, " + hours + ":" + minutes + ":" + seconds); // display
		    $div.html(hours + ":" + minutes + ":" + seconds); // display

		}, 1000); // interval each second = 1000 ms
	</script>


	<hr>

	<table class="operationSteps table table-striped table-bordered">
		<tr>
			<th>Operation Description</th>
			<th>Check</th>
			<th>Estimated</th>
			<th>Time</th>
		</tr>
		<tr>
			<td>1. Ucak onblock oldu</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'onblock'); ?>
				</div>
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>2. Ucak kapisi acildi</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'door_opened'); ?>
				</div>
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>3. Ucaktan yolcular inmeye basladi</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('gettingout_passangers', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'gettingout_passangers'); ?>
				</div>
			</td>
			<td><?php echo $model->aircrafttype->estimatedOperationTime->gettingout_passangers; ?> dk</td>
			<td></td>
		</tr>
		<tr>
			<td>4. Ucaga temizlik girdi</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('cleaning', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'cleaning'); ?>
				</div>
			</td>
			<td><?php echo $model->aircrafttype->estimatedOperationTime->cleaning; ?> dk</td>
			<td></td>
		</tr>
		<tr>
			<td>5. Security check basladi</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('security_check', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'security_check'); ?>
				</div>
			</td>
			<td><?php echo $model->aircrafttype->estimatedOperationTime->security_check; ?> dk</td>
			<td></td>
		</tr>
		<tr>
			<td>6. Boarding ok for Business</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('boarding_business', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'boarding_business'); ?>
				</div>
			</td>
			<td><?php echo $model->aircrafttype->estimatedOperationTime->boarding_business; ?> dk</td>
			<td></td>
		</tr>
		<tr>
			<td>7. Boarding ok for Economy</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('boarding_economy', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'boarding_economy'); ?>
				</div>
			</td>
			<td><?php echo $model->aircrafttype->estimatedOperationTime->boarding_economy; ?> dk</td>
			<td></td>
		</tr>
		<tr>
			<td>8. Kapilar kapatildi</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('doors_closed', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'doors_closed'); ?>
				</div>
			</td>
			<td><?php echo $model->flight->getDepartureTimeBefore(5); ?></td>
			<td></td>
		</tr>
		<tr>
			<td>9. Bagaj kapilari kapandi</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('bagage_doors_closed', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'bagage_doors_closed'); ?>
				</div>
			</td>
			<td><?php echo $model->flight->getDepartureTimeBefore(5); ?></td>
			<td></td>
		</tr>
		<tr>
			<td>10. Push back oldu</td>
			<td>
				<div class="row-fluid">
					<?php echo CHtml::checkBox('pushback', null, array('class'=>'span4')); ?>
					<?php echo $form->hiddenField($model,'pushback'); ?>
				</div>
			</td>
			<td><?php echo $model->flight->departure_time; ?></td>
			<td></td>
		</tr>
	</table>

	<div class="row">
		<?php echo CHtml::submitButton('Continue', array('class'=>'btn btn-primary btn-large', 'onclick'=>'return areAllCheckBoxesChecked();')); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->