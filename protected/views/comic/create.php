<?php
/* @var $this ComicsController */
/* @var $model Comics */

$this->breadcrumbs=array(
	'Comics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Comics', 'url'=>array('index')),
	array('label'=>'Manage Comics', 'url'=>array('admin')),
);
?>

<h1>Create Comics</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>