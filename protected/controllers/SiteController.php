<?php
/**
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2013-12-20
 *Function:
 *       Site Controller
 *
 */


class SiteController extends Controller
{
   	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xDDDDDD,
                                'height'=>40,
                                'width'=>100,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
                                'layout'=>'column3',
			),
		);
	}

        public function filters(){
           return array(
                 'accessControl + admin,logout', //权限控制只用于该2个动作，其余动作不需要权限控制
                 );
        }


        /*
         * @对于通过验证的用户, ?对应匿名用户，*两者包含起来
         * 验证规则将会按它们在此列出的顺序匹配
         * */
        public function accessRules()
        {
           return array(
                 array(
                    'allow',             
                    'users'=>array('@'),
                    ),
                 array(
                    'deny',
                    'users'=>array('*'),
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
	   	$articles=Article::model()->serviceInfo()->publishedandSetTop()->recently()->findAll();
		$contactWay = Article::model()->findByAttributes(array('publisher'=>Yii::app()->params['contactTelTitle']));
		if(empty($articles))
		   Yii::log('Article titles is null','warning','db.actionIndex');
		if(!isset($contactWay))
		   Yii::log( '首页不能获取联系人！错误：', 'warning', 'db' . $this->action->id);
		$this->render('index', array('articles'=>$articles, 'contactWay'=>$contactWay));
	}

        public function actionMore()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$model = new Article('search');
		$model->dbCriteria->compare('category_id', Category::$CATE_SERVICE_INFO);
		$model->unsetAttributes(); //campus_id默认值为0,去除默认值，则GridView中会显示所有用户
		if(isset($_GET['Article']))
				$model->attributes=$_GET['Article'];
		if(empty($articles))
		   Yii::log('Article titles is null','warning','db.actionIndex');
		$this->render('more', array('model'=>$model));
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
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{

		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/sha256.js',CClientScript::POS_HEAD);
			$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='loginForm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
                         //  $this->redirect(Yii::app()->user->returnUrl);
                           $this->redirect(Yii::app()->createUrl("site/admin"));
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->createUrl('site/login'));
	}

	public function actionRule()
	{
		$rules=Article::model()->regulationRules()->findAll();			   
		if(empty($rules))
			   Yii::log('Article about rule is null', 'warning', 'db.actionRule');
		$this->render('rule', array('rules'=>$rules));
	}
	
	public function actionTechExplore()
	{
		$criteria=new CDbCriteria(array(
			'select'=>'article_id, category_id, title, left(content,800)  as content, update_time, create_time',
			'condition'=>'category_id='. Category::$CATE_TECH_EXPLORE,
			'order'=>'create_time DESC',
			));
		$dataProvider=new CActiveDataProvider('Article', array(
			'pagination'=>array(
			   'pageSize'=>Yii::app()->params['techArticlesPerPage'],
			   ),
			'criteria'=>$criteria,
			));
		$this->render('techExplore', array('dataProvider'=>$dataProvider));
	}

	public function actionSpecial()
	{
		$specialClassroomItems=Dictionary::model()->specialClassroomItems()->findAll();
		$siteSpecialArticle=Article::model()->findByAttributes(array('publisher'=>Yii::app()->params['siteSpecialArticle']));
		if(empty($specialClassroomItems) || empty($siteSpecialArticle))
				Yii::log('Article about specialclassroom is null', 'warning', 'db.actionSpecial');
		$this->render('specialClassroom',array('classroomItems'=>$specialClassroomItems, 'siteSpecialArticle'=>$siteSpecialArticle));
	
	}

	public function actionIntroduce()
	{
		$this->layout='column3';
		$siteIntroduceArticle=Article::model()->findByAttributes(array('publisher'=>Yii::app()->params['siteIntroduceArticle']));
		if(empty($siteIntroduceArticle))
				Yii::log('Articla about classroom introduce is null','warning', 'db.actionIntroduce');
		$this->render('classroomIntroduce', array('siteIntroduceArticle'=>$siteIntroduceArticle));
	}

	public function actionCampusBus()
	{
		$this->layout='column3';
		$html=new simple_html_dom();
		$html->load_file('./protected/data/zongwuchuCampusBus.html');	
		$content=$html->find('div.cont',0)->children(3);
		$res='';
		while($content!=null)
		{
				$res.=$content->outertext;
				$content=$content->next_sibling();
		}
		$html->clear();
		if(empty($res))
		   Yii::log('Article abou campus bus is null', 'warning', 'uc.actionCampusBus');
		$this->render('campusBus',array('campusBus'=>$res));
	}


	public function actionArticle()
	{
		$id=Yii::app()->request->getParam('id');
		$cate=Yii::app()->request->getParam('cate');
		if(!isset($id) || !isset($cate))
		   throw new CHttpException(404,'非法请求');
		$article=Article::model()->findByPk($id);
		if(empty($article))
			Yii::log('CAN NOT find article id='. $id, 'warning', 'db.actionArticle');
		$this->render('article',array('article'=>$article,'cate'=>$cate));
	}


	public function actionClassroomDetail()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/slider.js',CClientScript::POS_HEAD);
		$this->layout='column3';
		$bid=Yii::app()->request->getParam('bid');
		$className=Yii::app()->request->getParam('className');
		if(!isset($bid) || !isset($className))
		   throw new CHttpException(404,'非法请求');
		$classroom=$bid.'_'. $className;
		$this->render('classroomDetail',array('classroom'=>$classroom,'bid'=>$bid, 'className'=>$className));
	}


	public function actionGetSpecialRoom()
	{
		if(Yii::app()->request->isAjaxRequest)
		{
				$id=Yii::app()->request->getParam('id');
				$article=Article::model()->findByPk($id);
				if(empty($article))
						Yii::log('CAN NOT find article id='. $id, 'error', 'db.actionArticle');
				$res=array('article'=>$article); 
				 echo CJSON::encode($res);
		}else
		   throw new CHttpException('404','非法请求');
	}


	public function actionTeamStyle()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/slides.min.jquery.js',CClientScript::POS_HEAD);
		$this->layout='column4';
		$this->render('teamStyle',array());
	}

	public function actionServiceList()
	{
		$this->layout='column5';
		$this->render('serviceList',array());
	}


	public function actionFeedback()
	{
		$model=new CommentForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='commentForm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['CommentForm']))
		{
			$model->attributes=$_POST['CommentForm'];
			// validate user input and redirect to the previous page if valid
			$resCode = 0;
			$resMes = 'OK';
			if($model->validate())
			{
					$model->save();
			}
			else
			{
				  $errors="";
				  foreach($model->getErrors() as $k=>$a)
					 $errors .= implode($a,';');
				  Yii::log( '不能提交评论！错误：' . $errors, 'warning','db' . $this->action->id);
				  $resCode = 1;
				  $resMes = '不能提交评论！错误: ' . $errors;
			}
			echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
			Yii::app()->end();
		}

		$criteria=new CDbCriteria(array(
				 'condition'=>'status='. Comment::$STATUS_PASS . ' or status=' . Comment::$STATUS_SET_TOP,
				 'order'=>'status, create_time DESC',
				 ));

		$dataProvider=new CActiveDataProvider('Comment', array(
				 'pagination'=>array(
					'pageSize'=>Yii::app()->params['commentsPerPage'],
					),
				 'criteria'=>$criteria,
				 ));

		// display the login form
		$this->render('feedBack',array('model'=>$model, 'comments'=>$dataProvider));
	}


	public function actionAdmin()
	{
		$this->layout='columnBE'; 
		$this->render('admin', array());
	}
}
