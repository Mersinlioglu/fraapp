<?php
/* @var $this OperationController */
/* @var $model Operation */
/* @var $form CActiveForm */
?>

<h1 class="header">Before Flight
    <span class="header-line"></span> 
</h1>

<div class="form beforeFlightForm">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'operation-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->hiddenField($model,'user_id'); ?>
	
	<div class="row-fluid">
		<div class="span4">
			<?php echo CHtml::label('Flight Number*', 'Operation_flight_id' , array('class'=>'span4')); ?>
			<?php echo $form->dropDownList($model,'flight_id', CHtml::listData(Flight::model()->findAll(), 'id', 'code') ); ?>
			<?php echo $form->error($model,'flight_id'); ?>
		</div>
		<div class="span4">
			<?php echo CHtml::label('Aircraft Type*', 'Operation_aircrafttype_id' ,array('class'=>'span4')); ?>
			<?php echo $form->dropDownList($model,'aircrafttype_id', CHtml::listData(AircraftType::model()->findAll(), 'id', 'name') ); ?>
			<?php echo $form->error($model,'aircrafttype_id'); ?>
		</div>
		<div class="span4">
			<?php echo CHtml::label('A/C REG*', 'Operation_aircrafttype_id' ,array('class'=>'span4')); ?>
			<?php echo $form->dropDownList($model,'registration_id', CHtml::listData(Registration::model()->findAll(), 'id', 'code') ); ?>
			<?php echo $form->error($model,'aircrafttype_id'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<?php // echo CHtml::label('1. Entered meal information!', 'mealInfo', array('class'=>'')); ?>

			<label class="" for="mealInfo">1. Entered meal information!
				<i id="code1" class="icon-question-sign" data-toggle="tooltip" title="( @ r &#x23ce; : 22/|***mob***--18c/cl***157y/cl***)"></i>
			</label>
			<script type="text/javascript">
				$('#code1').tooltip("show");
			</script>


		</div>
		<?php echo CHtml::checkBox('mealInfo', null , array('class'=>'span4')); ?>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<?php echo CHtml::label('2. CFG was checked!', 'sittingOrder'); ?>
		</div>
		<?php echo CHtml::checkBox('sittingOrder', null , array('class'=>'span4')); ?>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<?php echo CHtml::label('3. ZFW was checked!', 'zfw'); ?>
		</div>
		<?php echo CHtml::checkBox('zfw', null , array('class'=>'span4')); ?>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<?php echo CHtml::label('4. Co-Mail was checked!', 'comail'); ?>
		</div>
		<?php echo CHtml::checkBox('comail', null , array('class'=>'span4')); ?>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<?php echo CHtml::label('5. Kargo ve Posta maillerinin ciktisi alindi!', 'printPostAndMail'); ?>
		</div>
		<?php echo CHtml::checkBox('printPostAndMail', null , array('class'=>'span4')); ?>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<?php echo CHtml::label('6. Gelen ucaktaki özel durumlar kontrol edildi!', 'specialExceptionsComingPlane'); ?>
		</div>
		<?php echo CHtml::checkBox('specialExceptionsComingPlane', null , array('class'=>'span4')); ?>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<?php echo CHtml::label('7. Giden ucaktaki özel durumlar kontrol edildi!', 'specialExceptionsGoingPlane'); ?>
		</div>
		<?php echo CHtml::checkBox('specialExceptionsGoingPlane', null , array('class'=>'span4')); ?>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<?php echo CHtml::label('8. Genel görüntü, business listesi, özel yemek listesi kontrol edildi!', 'specialLists'); ?>
		</div>
		<?php echo CHtml::checkBox('specialLists', null , array('class'=>'span4')); ?>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<?php echo CHtml::label('9. Ucus planindan min yakit yakitmgs\'ye bildirildi!', 'specialLists'); ?>
		</div>
		<?php echo CHtml::checkBox('specialLists', null , array('class'=>'span4')); ?>
	</div>

	<div class="row">
		<script type="text/javascript">
			// function validate(){
			// 	var valid = true;
			// 	// $('.beforeFlightForm input[type=checkbox]').each(function(index){
			// 	$('input[type=checkbox]').each(function(index){
			// 		if(!$(this).is(':checked')){
			// 			valid = false;
			// 			// continue;
			// 		}
			// 	});
			// 	return valid;
			// }
		</script>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Start Operation' : 'Save', array('class'=>'btn btn-primary btn-large', 'onclick'=>'return areAllCheckBoxesChecked();')); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->