<?php /* @var $this Controller */ ?>



<?php $this->beginContent('//layouts/main'); ?>


<section class="col-md-5 col-sm-5 hidden-xs" id="sidebar" >


    <form method="get" action="search">
        <input name="for" type="text" placeholder="Search" class="form-control" value="<?php echo (isset($this->search) ? CHtml::encode($this->search) : ""); ?>" >
    </form>



    

    <?php
    if (Yii::app()->user->isAdmin()) { ?>

        <section class="admin-controls">

        <h5>Admin</h5>

    <?php

        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'Operations',
        ));
        $this->widget('zii.widgets.CMenu', array(
            'items'=>$this->menu,
            'htmlOptions'=>array('class'=>'operations'),
        ));
        $this->endWidget();
    ?>

        </section>


        <?php } ?>





    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
    <?php endif?>





</section>



<section class="col-sm-15 col-md-15 main-content" >
    <?php echo $content; ?>
</section>


<?php $this->endContent(); ?>