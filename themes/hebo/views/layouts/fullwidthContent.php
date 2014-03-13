<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<section >
	

		<?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
                'homeLink'=>CHtml::link('Dashboard'),
                'htmlOptions'=>array('class'=>'breadcrumb')
            )); ?><!-- breadcrumbs -->
        <?php endif?>
        
        <!-- Include content pages -->
        <?php echo $content; ?>

    
    <div class="span2">
		<?php include_once('tpl_sidebar.php');?>
		
</section>


<?php $this->endContent(); ?>