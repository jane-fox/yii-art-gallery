<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Content', 'url'=>array('index')),
	array('label'=>'Create Content', 'url'=>array('create')),
	array('label'=>'Update Content', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Content', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Content', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

</div>
</div>
</div>


<img src="<?php echo Yii::app()->request->baseUrl . "/" . Yii::app()->params['content_path']  . $model->file; ?>" />


<?php foreach (explode(" ", $model->tags) as $tag) { ?>

    <a href="<?php echo Yii::app()->request->baseUrl . "/search?for=" . $tag; ?>"><?php echo $tag; ?></a>

<?php } ?>


<?php foreach ($model->comments as $comment) { ?>

    <a href=""><?php echo $comment->text; ?></a>

<?php } ?>


<!--
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'file',
		'title',
		'artist_id',
		'date',
		'active',
	),
)); ?>
-->


