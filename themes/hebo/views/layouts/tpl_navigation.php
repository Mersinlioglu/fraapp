<section id="navigation-main">  
<div class="navbar">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
   

          <div class="nav-collapse">
            <?php 
            $forAdmin = !Yii::app()->user->isGuest && in_array(Yii::app()->user->getState('type'), array(1,4));
            $forUser = !Yii::app()->user->isGuest && in_array(Yii::app()->user->getState('type'), array(2,3));

            $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
                    'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Home', 'url'=>array('/site/index'),),
                        array('label'=>'User', 'url'=>array('/user/index'), 'visible'=> $forAdmin ),
                        array('label'=>'Tasks', 'url'=>array('/task/index'), 'visible'=> $forUser ),
                        array('label'=>'Ticket', 'url'=>array('/ticket/index'), 'visible'=> $forAdmin ),
                        array('label'=>'Sales', 'url'=>array('/site/sales')),
                        
                        array('label'=>'Operation (Employee)', 'url'=>array('/operation/beforeFlight'), 'visible'=> $forUser ),
                        array('label'=>'Operation (Admin)', 'url'=>array('/operation/admin'), 'visible'=> $forAdmin  ),

                        array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                        array('label'=>'Contact', 'url'=>array('/site/contact')),
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest,),
                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>
</section><!-- /#navigation-main -->