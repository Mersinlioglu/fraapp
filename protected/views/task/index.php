<?php
/* @var $this TaskController */

$this->breadcrumbs=array(
	'Task',
);
?>

<h1 class="header">Tickets
    <span class="header-line"></span> 
</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>