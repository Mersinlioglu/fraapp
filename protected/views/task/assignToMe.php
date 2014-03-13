<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Success!</strong>
</div>

<?php
echo CHtml::ajaxSubmitButton('Set as done',Yii::app()->createUrl('task/setAsDone'),
                    array(
                        'type'=>'get',
                        'data'=> 'js:{ id: '.$model->id.' }',                        
                        'success'=>"js:function(string){ 
                        		onSuccess();
                        }",
                        'update'=>'#setAsDoneResponse'
                    ),array('class'=>'btn btn-large btn-success', 'id'=>'setAsDoneBtn'));
?>