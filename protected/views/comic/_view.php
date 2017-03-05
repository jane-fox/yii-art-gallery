<?php
/* @var $this ComicsController */
/* @var $data Comics */
?>

<div class="view">

    <h3><?php echo $data->title; ?></h3>

    <?php foreach ($data->pages as $page) { ?>


        <a href="<?php echo Yii::app()->request->baseUrl . '/content/view/' . $page->id; ?>" class="thumb" style="background-image: url('<?php echo Yii::app()->params['content_path'] . '/thumb/' . $page->file; ?>')">

        </a>

    <?php } ?>



</div>