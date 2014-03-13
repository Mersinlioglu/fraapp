<?php if($model->hasErrors()): ?>

<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Error!</strong>
	<?php echo CHtml::errorSummary($model); ?>
</div>

<?php else: ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Success!</strong>
</div>
<?php endif; ?>




