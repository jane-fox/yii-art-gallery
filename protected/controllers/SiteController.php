<?php

class SiteController extends Controller
{
    public $layout='//layouts/sidebar';

    /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */


    //Login page
    public function actionLogin() {

        $model = new Member("login");

        // collect user input data
        if(isset($_POST['Member'])) {
            $model->attributes=$_POST['Member'];

            // validate user input
            if($model->validate()) {

                //Validate username / pass
                if ($model->login()) {

                    $this->redirect(Yii::app()->user->returnUrl);

                }

            }

        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }


    //Register for membership
    public function actionRegister()
    {
        $model = new Member("register");

        // collect user input data
        if(isset($_POST['Member'])) {

            $model->attributes=$_POST['Member'];

            // validate user input and redirect to the previous page if valid
            if($model->validate()) {

                $model->password = CPasswordHelper::hashPassword($model->password, 13);

                $model->save();

                $this->redirect(Yii::app()->user->returnUrl);

            }


        }
        // display the login form
        $this->render('register', array('model' => $model));
    }



	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}