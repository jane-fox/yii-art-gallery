<?php

class ContentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    public $layout='//layouts/sidebar';
    public $search;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','search'),
                'users'=>array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete','create','update'),
                'expression'=>'Yii::app()->user->isAdmin()',
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $this->layout = "//layouts/main";
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    public function actionSearch()
    {

        $model = new Content();

        if(isset($_GET['for'])) {

            $p = new CHtmlPurifier();
            $this->search = $p->purify($_GET['for']);
            $this->search = trim($this->search);



            $dataProvider=new CActiveDataProvider('Content', array(
                'pagination'=>array(
                    'pageSize'=>5,
                ),
                'criteria'=>$criteria,
            ));

        }


        $this->render('index',array(
            'model'=>$model,
            'dataProvider'=>$dataProvider,
        ));
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $this->layout = "//layouts/admin";
		$model=new Content("create");



		if(isset($_POST['Content']))
		{
			$model->attributes=$_POST['Content'];

            $file = CUploadedFile::getInstance($model,"file");

            $model->file = $this->uploadFile($file);

            if ($model->validate() && $model->file !== false) {


                if ($model->save()) {
                    $this->redirect(array('view','id'=>$model->id));
                }

            } else {
                $model->addError(array("file" => "Problem uploading file, please try again."));
            }
        }


		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $this->layout = "//layouts/admin";
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        if(isset($_POST['Content']))
        {
            $model->attributes = $_POST['Content'];
var_dump($_POST['Content']); die;
            if (!empty($_POST['Content']['file'])) {
die;
                $file = CUploadedFile::getInstance($model,"file");
                $model->file = $this->uploadFile($file);

            }

            if ($model->save()) {
                $this->redirect(array('view','id'=>$model->id));
            }


        }


		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Content');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        $this->layout = "//layouts/admin";
		$model=new Content('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Content']))
			$model->attributes=$_GET['Content'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    //Accepts a CUploadedFiled
    public function uploadFile($file) {
        //prepend file with unique number to prevent overwrites
        $filename = uniqid() . "_" . $file;


        $path = Yii::app()->params['content_path'] . $filename;

        if ($file->saveAs($path)) {
            //File uploaded successfully. Make thumbnails then save.

            $thumb = Yii::app()->image->load($path);

            $master_dimension = (($thumb->width > $thumb->height) ? Image::HEIGHT : Image::WIDTH);

            $thumb->resize(200,200, $master_dimension);

            $thumb->save(Yii::app()->params['content_path'] . "thumb/" . $filename);

            return $filename;

        }

        return false;

    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Content the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Content::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Content $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='content-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
