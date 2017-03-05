<?php /* @var $this Controller */ ?>
<?php $base_url = Yii::app()->request->baseUrl; ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8" />
    <meta name="language" content="en" />
    <meta name="description" content="Art Gallery">
    <meta name="author" content="">
    <meta name="keywords" content="art, comics">

    <link rel="icon" href="<?php echo $base_url; ?>/favicon.ico">

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/admin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/form.css" />


    <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/bootstrap.min.js"></script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>



<header class="list-header">
    <h2><?php echo Yii::app()->controller->id; ?></h2>



    <a href="<?php echo $base_url; ?>/<?php echo Yii::app()->controller->id; ?>/create" class="add-btn">
        Add New <span class="glyphicon glyphicon-plus-sign" ></span>
    </a>

    <?php  ?>

</header>



<div class="container">



<nav>

    <h1><a href="<?php echo $base_url; ?>"><span>Art</span> Gallery</a></h1>

    <ul>
        <li><a href="<?php echo $base_url; ?>/content/admin"><span class="glyphicon glyphicon-picture"></span>Content</a></li>
        <li><a href="<?php echo $base_url; ?>/comic/admin"><span class="glyphicon glyphicon-th-large"></span>Comics</a></li>
        <li><a href="<?php echo $base_url; ?>/artist/admin"><span class="glyphicon glyphicon-edit"></span>Artists</a></li>
        <li><a href="<?php echo $base_url; ?>/member/admin"><span class="glyphicon glyphicon-user"></span>Members</a></li>
        <li><a href="<?php echo $base_url; ?>/comment/admin"><span class="glyphicon glyphicon-comment"></span>Comments</a></li>
        <!--<li><a href="<?php echo $base_url; ?>/tag/admin"><span class="glyphicon glyphicon-tags"></span>Tags</a></li>-->
    </ul>


</nav>





    <?php if ( isset($error) ) { ?>
        <p class="bg-warning site-notice"><?php echo $error; ?></p>
    <?php } ?>


    <?php if ( isset($info) ) { ?>
        <p class="bg-info site-notice"><?php echo $info; ?></p>
    <?php } ?>



        <?php echo $content; ?>

</div>



</body>
</html>
