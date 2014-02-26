<?php

class CommentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/columnBE';

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
			array('allow',
                           'actions'=>array('trash', 'PhysicalDelete', 'restore'),
                           'users'=>array('@'),
                           'expression'=>'Yii::app()->user->auth & ModuleAuth::MMC_TRASH_ADMIN',
			),
			array('allow', 
                           'actions'=>array('view', 'create', 'update', 'delete', 'index', 'admin'),
                           'users'=>array('@'),
                           'expression'=>'Yii::app()->user->auth & ModuleAuth::MMC_COMMENT_ADMIN',
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Comment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->comment_id));
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
		$model=$this->loadModel($id);
                $model->scenario = 'update';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->comment_id));
                        else
                           {
                              $errors="";
                              foreach($model->getErrors() as $k=>$a)
                                 $errors .= implode($a,';');
                              Yii::app()->user->setFlash('error', '不能更新评论！错误:' . $errors);
                              Yii::log( '不能更新评论！错误：' . $errors, 'warning','db' . $this->action->id);
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
	public function actionPhysicalDelete()
	{
                if(Yii::app()->request->isAjaxRequest)
                {
                   $resCode = 0;
                   $resMes = 'OK';
                   $id = Yii::app()->request->getParam('id'); 
                   $comment = Comment::model()->findByPk($id);
                   if(!isset($comment))
                   {
                        $resCode = 1;
                        $resMes = '评论ID: '. $id .' 不存在!';
                        Yii::log($resMes,'error','db.actionDelete');
                        echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                   }
                   else{ 
                        $comment->delete();
                        echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                   }
                }else
                   throw new CHttpException(404, "请求页面不存在！禁止删除评论!");

	}

       	public function actionRestore()
	{
                if(Yii::app()->request->isAjaxRequest)
                {
                   $resCode = 0;
                   $resMes = 'OK';
                   $id = Yii::app()->request->getParam('id'); 
                   $comment = Comment::model()->findByPk($id);
                   if(!isset($comment))
                   {
                        $resCode = 1;
                        $resMes = '评论ID: '. $id .' 不存在!';
                        Yii::log($resMes,'error','db.actionDelete');
                        echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                   }
                   else{ 
                        $comment->status = Comment::$STATUS_PENDING;
                        $comment->save();
                        echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                   }
                }else
                   throw new CHttpException(404, "请求页面不存在！禁止恢复评论!");

	}



        public function actionTrash()
        {
                $model=new Comment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];

		$this->render('trash',array(
			'model'=>$model,
		));
        
        }

        public function actionDelete()
        {
                if(Yii::app()->request->isAjaxRequest)
                {
                   $resCode = 0;
                   $resMes = 'OK';
                   $id = Yii::app()->request->getParam('id'); 
                   $comment = Comment::model()->findByPk($id);
                   if(!isset($comment))
                   {
                        $resCode = 1;
                        $resMes = '评论ID: '. $id .' 不存在!';
                        Yii::log($resMes,'error','db.actionDelete');
                        echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                   }
                   else{ 
                        $comment->status = Article::$STATUS_DELETED;
                        $comment->save();
                        echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                   }
                }else
                   throw new CHttpException(404, "请求页面不存在！禁止删除文章!");
               
        }
        

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $criteria=new CDbCriteria;
                $criteria->select = 'comment_id, create_time, author, email, content, status';
                $criteria->addCondition('status!=' . Comment::$STATUS_DELETED);
		$dataProvider=new CActiveDataProvider('Comment', array(
                         'criteria'=>$criteria,
                         'sort'=>array('defaultOrder'=>'status, create_time DESC',),
                         )
                      );

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Comment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
