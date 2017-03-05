<?php
/* @var $this ComicsController */
/* @var $model Comics */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comics-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'artist_id'); ?>
        <?php echo $form->dropDownList($model,'artist_id', CHtml::listData(Artist::model()->findAll(),"id","name")); ?>
		<?php echo $form->error($model,'artist_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sequel_to'); ?>
		<?php echo $form->textField($model,'sequel_to'); ?>
		<?php echo $form->error($model,'sequel_to'); ?>
	</div>

    <?php foreach ($model->pages as $page) { ?>


        <a><?php echo $page['id']; ?></a>


    <?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->