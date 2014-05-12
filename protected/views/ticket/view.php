<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Ticket', 'url'=>array('index')),
	array('label'=>'Create Ticket', 'url'=>array('create')),
	array('label'=>'Update Ticket', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ticket', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>

<h1 class="header">View Ticket #<?php echo $model->title; ?>
    <span class="header-line"></span> 
</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		// 'id',
		'oCreator.fullname',
		'title',
		'description',
		'start_date',
		'end_date',
		'assignedUsers',
		array(
            'label'=>'Editor',
            'type'=>'raw',
            'value'=>$model->oEditor ? $model->oEditor->fullName : '',
            'visible'=> $model->oEditor ? true : false,
        ),
		array(
            'label'=>'Accepted',
            'type'=>'raw',
            'value'=> $model->accepted != "" ? $model->accepted : 'N/A',
        ),
		array(
            'label'=>'Done',
            'type'=>'raw',
            'value'=> $model->done > 0 ? date("d.m.Y, H:i:s",$model->done) : 'N/A',
            'visible'=> $model->done > 0 ? true : false,
        ),
	),
	'htmlOptions'=>array(
			'class'=>'table table-striped table-bordered table-hover',
		),
)); ?>
