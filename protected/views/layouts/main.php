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
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/master.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/form.css" />


    <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/bootstrap.min.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>








<div class="container" id="site_wrapper">
    <div class="bg-left"></div><div class="bg-right"></div>

    <div style="background-color: inherit" class="clearfix">

        <header id="site_header" class="row clearfix">




            <h1 id="logo"><a href="<?php echo $base_url; ?>"><img src="<?php echo $base_url; ?>/images/logo.png" alt="" style="height:125px;" /></a></h1>




            <?php if (!Yii::app()->user->isGuest) { ?>

                <div id="account_control">
                    <a href="<?php echo $base_url; ?>/logout">Log Out (<?php echo Yii::app()->user->name; ?>)</a>
                </div>

            <?php } ?>


            <ul class="nav">



                <?php if (Yii::app()->user->isGuest) { ?>

                    <li><a href="<?php echo $base_url; ?>/login">Log In</a></li>
                    <li><a href="<?php echo $base_url; ?>/register">Sign Up</a></li>

                <?php } else { ?>

                    <li><a href="<?php echo $base_url; ?>/content" class="{newest_tab}<?php if (Yii::app()->controller->id == "content") echo " active " ;?>">Home</a></li>
                    <!--<li><a href="<?php echo $base_url; ?>content/pinups" class="{pinup_tab}">Pinups</a></li>-->
                    <li><a href="<?php echo $base_url; ?>/comic" class="{comic_tab}<?php if (Yii::app()->controller->id == "comic") echo " active " ;?>">Comics</a></li>
                    <li><a href="<?php echo $base_url; ?>/artist" class="{artist_tab}<?php if (Yii::app()->controller->id == "artist") echo " active " ;?>">Artists</a></li>

                <?php } ?>

            </ul>



        </header>


        <?php if ( isset($error) ) { ?>
            <div class="alert alert-warning">
                <?php echo $error; ?>
            </div>
        <?php } ?>





	<?php echo $content; ?>




	<div class="clear"></div>



</div><!-- page -->

    <footer id="footer">
    </footer><!-- footer -->


</body>
</html>
