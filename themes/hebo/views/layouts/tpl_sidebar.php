<!-- <div class="">
  <input class="input-block-level" id="appendedInput" placeholder="Search..." type="text">
</div> -->

<h3>Operations</h3>
<?php
    $this->widget('zii.widgets.CMenu', array(
        'items'=>$this->menu,
        'htmlOptions'=>array('class'=>'nav nav-list'),
    ));  
?>