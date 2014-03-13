<?php
/* @var $this OperationController */
/* @var $data Operation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_id')); ?>:</b>
	<?php echo CHtml::encode($data->flight_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aircrafttype_id')); ?>:</b>
	<?php echo CHtml::encode($data->aircrafttype_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('before_flight_check_time')); ?>:</b>
	<?php echo CHtml::encode($data->before_flight_check_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('onblock')); ?>:</b>
	<?php echo CHtml::encode($data->onblock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('door_opened')); ?>:</b>
	<?php echo CHtml::encode($data->door_opened); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('gettingout_passangers')); ?>:</b>
	<?php echo CHtml::encode($data->gettingout_passangers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cleaning')); ?>:</b>
	<?php echo CHtml::encode($data->cleaning); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('security_check')); ?>:</b>
	<?php echo CHtml::encode($data->security_check); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('boarding_business')); ?>:</b>
	<?php echo CHtml::encode($data->boarding_business); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('boarding_economy')); ?>:</b>
	<?php echo CHtml::encode($data->boarding_economy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doors_closed')); ?>:</b>
	<?php echo CHtml::encode($data->doors_closed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bagage_doors_closed')); ?>:</b>
	<?php echo CHtml::encode($data->bagage_doors_closed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pushback')); ?>:</b>
	<?php echo CHtml::encode($data->pushback); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('erp_entry_done')); ?>:</b>
	<?php echo CHtml::encode($data->erp_entry_done); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('op_error_log')); ?>:</b>
	<?php echo CHtml::encode($data->op_error_log); ?>
	<br />

	*/ ?>

</div>