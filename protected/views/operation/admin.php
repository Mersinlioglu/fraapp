<?php
/* @var $this OperationController */
/* @var $model Operation */

$this->breadcrumbs=array(
	'Operations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Operation', 'url'=>array('index')),
	array('label'=>'Create Operation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#operation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Operations</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 

// this is the date picker
$dateisOn = '<div style="width:160px; margin:0 auto;">'.$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	'name' => 'Operation[date_first]',
	'language' => 'de',
	'value' => $model->date_first,
	// additional javascript options for the date picker plugin
	'options'=>array(
		'showAnim'=>'fold',
		'dateFormat'=>'dd.mm.yy',
		'changeMonth' => 'true',
		'changeYear'=>'true',
		'constrainInput' => 'false',
	),
	'htmlOptions'=>array(
		'style'=>'height:20px;width:70px;',
	),
	// DONT FORGET TO ADD TRUE this will create the datepicker return as string
),true) . ' - ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	'name' => 'Operation[date_last]',
	'language' => 'de',
	'value' => $model->date_last,
	// additional javascript options for the date picker plugin
	'options'=>array(
		'showAnim'=>'fold',
		'dateFormat'=>'dd.mm.yy',
		'changeMonth' => 'true',
		'changeYear'=>'true',
		'constrainInput' => 'false',
	),
	'htmlOptions'=>array(
		'style'=>'height:20px;width:70px',
	),
),true).'</div>';




$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'operation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate'=>"function() {
		jQuery('#Operation_date_first').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['de'], {'showAnim':'fold','dateFormat':'dd.mm.yy','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
		jQuery('#Operation_date_last').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['de'], {'showAnim':'fold','dateFormat':'dd.mm.yy','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false', 'css':'width:70px'}));
	}",
	'columns'=>array(
		// array(
		// 	'header'=>'Date',  
		// 	'value'=>'Yii::app()->dateFormatter->format("dd.MM.y",strtotime($data->before_flight_check_time))',
		// ),
		// 'id',
		// 'user_id',
		array(
			'name'=>'user.name',  
			'value'=>'$data->user->fullName', 
			'filter' => CHtml::textField('Operation[fullName]', ''),
		),
		array(
			'name'=>'flight_id',  
			'value'=>'$data->flight->code',
			'filter' => CHtml::listData(Flight::model()->findAll(), 'id','code'),
		),
		array(
			'name'=>'aircrafttype_id',  
			'value'=>'$data->aircrafttype->name',
			'filter' => CHtml::listData(AircraftType::model()->findAll(), 'id','name'),
		),
		// 'before_flight_check_time',
		// 'onblock',
		array(
            'name' => 'before_flight_check_time',
            'filter' => $dateisOn,
            'value'=>'($data->before_flight_check_time>0) ? date("d.m.Y, H:m:s",$data->before_flight_check_time) : "N/A"',
        ),
		array(
			'name'=>'onblock',  
			'filter'=>'',  
            'value'=>'($data->onblock>0) ? date("d.m.Y, H:m:s",$data->onblock) : "N/A"',
		),
		array(
			'name'=>'erp_entry_done',  
			'filter'=>'',  
            'value'=>'($data->erp_entry_done>0) ? date("d.m.Y, H:m:s",$data->erp_entry_done) : "N/A"',
		),
		/*
		'door_opened',
		'gettingout_passangers',
		'cleaning',
		'security_check',
		'boarding_business',
		'boarding_economy',
		'doors_closed',
		'bagage_doors_closed',
		'pushback',
		'op_error_log',
		'erp_entry_done',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			// 'template'=>'{update} {delete}',
		),

	),
	'itemsCssClass' => 'table table-striped table-bordered table-hover'

)); ?>
