<?php
$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$model->title,
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
            'value'=> $model->accepted > 0 ? date("d.m.Y, H:i:s",$model->accepted) : 'N/A',
            // 'visible'=> $model->accepted && Yii::app()->user->isAdmin() ? true : false,
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
));



// echo $model->accepted . "<br>";
// echo Yii::app()->dateFormatter->format("d.M.y, h:m:s",strtotime($model->accepted));


 ?>
<script type="text/javascript">
	// $( document ).ready(function() {
	// });
	var onSuccess = function(){
		// alert("ahaa");
		// $('#setAsDoneBtn').addClass('btn-success');
		// alert($('#setAsDoneBtn').html());
		// $('#setAsDoneBtn').text('Done');

		var element = document.getElementById("setAsDoneBtn");
		element.value = 'Done';
		element.classList.remove("btn-success");
		element.classList.add("btn-primary");
		element.classList.add("disabled");
	}
</script>

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'form-id',
        'action' => Yii::app()->createUrl("task/view", array('id' => $model->id)),  //<- your form action here
)); ?>

<?php
if(!$model->done){

	if($model->editor_id == NULL){
		//Assign to me
		echo CHtml::hiddenField('assignToMe');
		$btnName = 'Assign to me';
		echo CHtml::submitButton($btnName, array('class'=>'btn btn-large btn-success', ));

	} else if($model->editor_id == Yii::app()->user->getId()) {
		//Set as done
		echo CHtml::hiddenField('setAsDone');
		$btnName = 'Set as done';
		echo CHtml::submitButton($btnName, array('class'=>'btn btn-large btn-success', ));
	}

}
else
	echo "Task is done.";
?>

<?php $this->endWidget(); ?>

<div id="setAsDoneResponse"></div>
