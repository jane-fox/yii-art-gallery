<?php
/* @var $this ComicsController */
/* @var $model Comics */

$this->breadcrumbs=array(
	'Comics'=>array('index'),
	$model->title,
);

    $this->menu=array(
        array('label'=>'List Comics', 'url'=>array('index')),
        array('label'=>'Create Comics', 'url'=>array('create')),
        array('label'=>'Update Comics', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Delete Comics', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        array('label'=>'Manage Comics', 'url'=>array('admin')),
    );
    ?>

    <h1><?php echo $model->title; ?></h1>

    <?php //var_dump($model->pages); ?>




    <?php foreach ($model->pages as $page) { ?>


        <a href="<?php echo Yii::app()->request->baseUrl . '/content/view/' . $page->id; ?>" class="thumb" style="background-image: url('<?php echo Yii::app()->params['content_path'] . '/thumb/' . $page->file; ?>')">

        </a>

    <?php } ?>

    <?php /*$this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            'id',
            'title',
            'artist_id',
            'sequel_to',
            'date',
        ),
    ));*/ ?>
