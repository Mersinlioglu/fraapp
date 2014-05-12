<?php
/* @var $this OperationController */
/* @var $model Operation */

$this->breadcrumbs=array(
	'Operations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Operation', 'url'=>array('index')),
	array('label'=>'Create Operation', 'url'=>array('create')),
	array('label'=>'Update Operation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Operation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Operation', 'url'=>array('admin')),
);
?>

<h2 class="header">View Operation #<?php echo $model->flight->code; ?>
	(<?php echo $model->aircrafttype->name; ?>)
	<small><?php echo $model->before_flight_check_time>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->before_flight_check_time) : 'N/A'; ?></small>
    <span class="header-line"></span> 
</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		// 'id',
		// 'aircrafttype.name',
		// 'before_flight_check_time',
		// 'onblock',
		// 'door_opened',
		// 'gettingout_passangers',
		array(
			'label'=>'A/C REG',
			'value'=> $model->registration ? $model->registration->code : 'N/A', 
		),
		array(
			'name'=>'before_flight_check_time',
			'value'=> $model->before_flight_check_time>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->before_flight_check_time) : 'N/A', 
		),
		array(
			'name'=>'onblock',
			'value'=> $model->onblock>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->onblock) : 'N/A', 
		),
		array(
			'name'=>'door_opened',
			'value'=> $model->door_opened>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->door_opened) : 'N/A', 
		),
		array(
			'name'=>'gettingout_passangers',
			'value'=> $model->gettingout_passangers>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->gettingout_passangers) : 'N/A', 
		),
		array(
			'name'=>'cleaning',
			'value'=> $model->cleaning>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->cleaning) : 'N/A', 
		),
		array(
			'name'=>'security_check',
			'value'=> $model->security_check>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->security_check) : 'N/A', 
		),
		array(
			'name'=>'boarding_business',
			'value'=> $model->boarding_business>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->boarding_business) : 'N/A', 
		),
		array(
			'name'=>'boarding_economy',
			'value'=> $model->boarding_economy>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->boarding_economy) : 'N/A', 
		),
		array(
			'name'=>'doors_closed',
			'value'=> $model->doors_closed>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->doors_closed) : 'N/A', 
		),
		array(
			'name'=>'bagage_doors_closed',
			'value'=> $model->bagage_doors_closed>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->bagage_doors_closed) : 'N/A', 
		),
		array(
			'name'=>'pushback',
			'value'=> $model->pushback>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->pushback) : 'N/A', 
		),
		array(
			'name'=>'erp_entry_done',
			'value'=> $model->erp_entry_done>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->erp_entry_done) : 'N/A', 
		),
		'op_error_log',
	),
	'htmlOptions'=>array(
			'class'=>'table table-striped table-bordered table-hover view-table',
		),
)); ?>

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
					<td><?php echo $model->cabin_config_ccl; ?></td>
					<td><?php echo $model->cabin_config_ycl; ?></td>
					<td><?php echo $model->cabin_config_tcl; ?></td>
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
					<td><?php echo $model->cabin_pax_ccl; ?></td>
					<td><?php echo $model->cabin_pax_ycl; ?></td>
					<td><?php echo $model->cabin_pax_tcl; ?></td>
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
					<td><?php echo $model->cabin_inf; ?></td>
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
					<td><?php echo $model->cabin_id_dz; ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php if($model->delayCode): ?>
<!-- Outgoing delay codes -->
<table class="table table-striped table-bordered">
	<tr>
		<th colspan="9">OUTGOING DELAY CODES</th>
	</tr>
	<tr>
		<td>
			<table class="table table-bordered">
				<tr>
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>4</th>
				</tr>
				<tr>
					<td><?php echo $model->delayCode->cod1; ?></td>
					<td><?php echo $model->delayCode->cod2; ?></td>
					<td><?php echo $model->delayCode->cod3; ?></td>
					<td><?php echo $model->delayCode->cod4; ?></td>
				</tr>
				<tr>
					<td><?php echo $model->delayCode->min1; ?></td>
					<td><?php echo $model->delayCode->min2; ?></td>
					<td><?php echo $model->delayCode->min3; ?></td>
					<td><?php echo $model->delayCode->min4; ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php endif; ?>

<table class="operationSteps table table-striped table-bordered">
	<tr>
		<th>Operation Description</th>
		<th>Time</th>
	</tr>
	<tr>
		<td>1. Ucak bilgileri ERP sistemine girildi</td>
		<td>
			<div class="row-fluid">
				<?php echo $model->erp_entry_done>0 ? Yii::app()->dateFormatter->format('HH:mm:ss, dd MMM yyyy',$model->erp_entry_done) : 'N/A'; ?>
			</div>
		</td>
	</tr>
</table>

<table class="operationSteps table table-striped table-bordered">
	<tr>
		<th>2. Operasyonla ilgili aksakliklar veya yorumlar.</th>
	</tr>
	<tr>
		<td><?php echo $model->op_error_log; ?></td>
	</tr>
</table>

<table class="operationSteps table table-striped table-bordered">
	<tr>
		<th>Business (ortalama)</th>
		<th>Economy (ortalama)</th>
	</tr>
	<tr>
		<td><?php echo $model->getAverageBusinessPresence(); ?></td>
		<td><?php echo $model->getAverageEconomyPresence(); ?></td>
	</tr>
</table>

<?php if($model->technician != null): ?>
<table class="operationSteps table table-striped table-bordered">
	<tr>
		<th>Teknisyen</th>
	</tr>
	<tr>
		<td><?php echo $model->technician->name . ' ' . $model->technician->lastname; ?></td>
	</tr>
</table>
<?php endif; ?>

