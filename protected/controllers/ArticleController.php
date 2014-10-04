<?php 
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-16
 *Note:
 *  
 */

class ArticleController extends Controller
{

        public $layout='columnBE';
        private $_model;


        public function filters(){
           return array(
                 'accessControl',             
                 );
        }


        /*
         * @对于通过验证的用户, ?对应匿名用户，*两者包含起来
         * 验证规则将会按它们在此列出的顺序匹配
         * */
        public function accessRules()
        {
           return array(
                array('allow',
                   'actions'=>array('trash', 'PhysicalDelete', 'restore'),
                   'users'=>array('@'),
                   'expression'=>'Yii::app()->user->auth & ModuleAuth::MMC_TRASH_ADMIN',
                   ),
                array('allow',
                   'actions'=>array('setContactTel'),
                   'users'=>array('@'),
                   'expression'=>'Yii::app()->user->auth & ModuleAuth::MMC_HOMEPAGE_ADMIN',
                   ),
                array('allow',
                   'actions'=>array('updateSummary'),
                   'users'=>array('@'),
                   'expression'=>'Yii::app()->user->auth & ModuleAuth::MMC_CLASSROOM_ADMIN',
                   ),
                 array(
                    'allow',             
                   'actions'=>array('createArticle', 'manageArticle', 'view', 'update', 'delete'),
                    'users'=>array('@'),
                   'expression'=>'(Yii::app()->user->auth & ModuleAuth::MMC_HOMEPAGE_ADMIN) | (Yii::app()->user->auth & ModuleAuth::MMC_CLASSROOM_ADMIN) | (Yii::app()->user->auth & ModuleAuth::MMC_RULE_ADMIN) | (Yii::app()->user->auth & ModuleAuth::MMC_TECH_EXPLORE)',
                    ),

                 //多媒体风采访问权限控制
                 array(
                    'allow',
                   'actions'=>array('assistantAdmin', 'feelingAdmin','reportAdmin'),
                    'users'=>array('@'),
                   'expression'=>'(Yii::app()->user->auth & ModuleAuth::MMC_TEAMSTYLE)',
                   ),

                 array(
                    'deny',
                    'users'=>array('*'),
                   ),
                 );
        }


        public function actionTrash()
        {
                $model=new Article('search');
		$model->unsetAttributes();  // clear any default values
                if(isset($_GET['Article']))
                        $model->attributes=$_GET['Article'];
                $this->render('trash',array('model'=>$model));
        }

        public function actionPhysicalDelete()
        {   
                   if(Yii::app()->request->isAjaxRequest)
                   {   
                      $resCode = 0;
                      $resMes = 'OK';
                      $id = Yii::app()->request->getParam('id'); 
                      $article = Article::model()->findByPk($id);
                      if(!isset($article))
                      {   
                         $resCode = 1;
                         $resMes = '评论ID: '. $id .' 不存在!';
                         Yii::log($resMes,'error','db.actionDelete');
                         echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                      }   
                      else{ 
                         $article->delete();
                         echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                      }   
                   }else
                      throw new CHttpException(404, "请求页面不存在！禁止删除文章!");
        }   

        public function actionRestore()
        {   
               if(Yii::app()->request->isAjaxRequest)
               {   
                  $resCode = 0;
                  $resMes = 'OK';
                  $id = Yii::app()->request->getParam('id'); 
                  $article = Article::model()->findByPk($id);
                  if(!isset($article))
                  {   
                     $resCode = 1;
                     $resMes = '评论ID: '. $id .' 不存在!';
                     Yii::log($resMes,'error','db.actionDelete');
                     echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                  }   
                  else{ 
                     $article->status = Article::$STATUS_DRAFT;
                     $article->save();
                     echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                  }   
    
               }else
                  throw new CHttpException(404, "请求页面不存在！禁止恢复文章!");
        } 


        public function actionManageArticle()
        {
                if(!isset($_GET['cate']))
                   throw new CHttpException(404,'非法请求'); 
                $cate = $_GET['cate'];
                $model = new Article('search');
                $model->dbCriteria->compare('category_id', $cate);
                $model->unsetAttributes(); //campus_id默认值为0,去除默认值，则GridView中会显示所有用户
                if(isset($_GET['Article']))
                        $model->attributes=$_GET['Article'];
                $this->render('manageArticle',array('model'=>$model, 'cateId'=>$cate));
        }

        public function actionView()
        {
                $id=Yii::app()->request->getParam('id');
                if(!isset($id))
                   throw new CHttpException(404,'非法请求');
                $article=Article::model()->findByPk($id);
                if(empty($article))
                    Yii::log('CAN NOT find article id='. $id, 'warning', 'db.actionArticle');
                $this->render('article',array('article'=>$article));

        } 

        public function actionCreateArticle()
        {
                $model = new Article();
                if(!isset($_GET['cate']))
                   throw new CHttpException(404,'非法请求'); 
                $model->category_id = $_GET['cate'];
                if($_GET['cate'] ==  Category::$CATE_SPECIAL_CLASSROOM)
                {
                         $model->campus_id = 0;
                         $model->publisher = Yii::app()->params['dictTypeSpecialClassroom'];
                }
                if(isset($_POST['Article']))
                {
                        $model->attributes = $_POST['Article'];
                        $model->create_time = date('Y-m-d H:i:s');
                        $model->update_time = date('Y-m-d H:i:s');
                        try{
                                if($model->save())
                                      //  $data = implode($model->attributes , '::');
                                       // echo $data;
                                       // Yii::app()->end();
                                    $this->redirect(array('view', 'id'=>$model->article_id));
                                else
                                {
                                   $errors="";
                                   foreach($model->getErrors() as $k=>$a)
                                      $errors .= implode($a,';');
                                   Yii::app()->user->setFlash('error', '不能创建文章！错误:' . $errors);
                                   Yii::log( '不能创建文章！错误：' . $errors, 'warning','db' . $this->action->id);
                                }
                        }catch(CDbException $e){
                           throw new CHttpException(400,  implode($e->errorInfo,':'));
                        }
                }
                $this->render('createArticle',array('model'=>$model));
        }

        public function actionUpdate()
        {
                $model=$this->loadModel();
                
                if(isset($_POST['Article']))
                {
                        $model->attributes=$_POST['Article'];
                        $model->update_time = date('Y-m-d H:i:s');
                        try{
                           if($model->save())
                              $this->redirect(array('view','id'=>$model->article_id));
                           else
                           {
                              $errors="";
                              foreach($model->getErrors() as $k=>$a)
                                 $errors .= implode($a,';');
                              Yii::app()->user->setFlash('error', '不能更新文章！错误:' . $errors);
                              Yii::log( '不能更新文章！错误：' . $errors, 'warning','db' . $this->action->id);
                           }
                        }catch(CDbException $e){
                           throw new CHttpException(400,  implode($e->errorInfo,':'));

                        }
                }
                $this->render('update',array('model'=>$model));
    
        } 


        public function actionDelete()
        {
                if(Yii::app()->request->isAjaxRequest)
                {
                   $resCode = 0;
                   $resMes = 'OK';
                   $id = Yii::app()->request->getParam('id'); 
                   $title = Yii::app()->request->getParam('title'); 
                   $article = Article::model()->findByPk($id);
                   if(!isset($article))
                   {
                        $resCode = 1;
                        $resMes = '文章ID: '. $id .' 不存在!';
                        Yii::log($resMes,'error','db.actionDelete');
                        echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                   }
                   else{ 
                        $article->status = Article::$STATUS_DELETED;
                        $article->save();
                        echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                   }
                }else
                   throw new CHttpException(404, "请求页面不存在！禁止删除文章!");
               
        } 


        public function actionSetContactTel()
        {
                $data = Article::model()->findByAttributes(array('publisher'=>Yii::app()->params['contactTelTitle']));
                if(!isset($data))
                   $data = new Article('contactTel');
                if(isset($_POST['contactTel']))
                {
                        $data->content = $_POST['contactTel'];
                        $data->title = Yii::app()->params['contactTelTitle'];
                        $data->publisher = Yii::app()->params['contactTelTitle'];
                        $data->category_id = 100; //特殊的文章类别统一设置为100
                        try{
                           if($data->save())
                              Yii::app()->user->setFlash('success', '联系人更新成功！');
                           else
                           {
                              $errors="";
                              foreach($data->getErrors() as $k=>$a)
                                 $errors .= implode($a,';');
                              Yii::app()->user->setFlash('error', '不能更新联系人！错误:' . $errors);
                              Yii::log( '不能更新联系人！错误：' . $errors ,'warning','db' . $this->action->id);
                           }
                        }catch(CDbException $e){
                           throw new CHttpException(400,  implode($e->errorInfo,':'));
                        }
                }
                $this->render('setContactTel',array('data'=>$data));

        }

        public function actionUpdateSummary()
        {
                if(!isset($_GET['dictType']))
                        throw new CHttpException(404,'请求的页面不存在！');
                $dictType = $_GET['dictType'];
                $model = Article::model()->findByAttributes(array('publisher'=>$dictType));
                if(!isset($model))
                {
                        $model = new Article();
                        $model->publisher = $dictType;
                        $model->campus_id = 0;
                }
                if(isset($_POST['Article']))
                {
                        $model->attributes = $_POST['Article'];
                        $model->category_id = 100; //特殊的文章类别统一设置为100
                        try{
                           if($model->save())
                              Yii::app()->user->setFlash('success', '课室概况更新成功！');
                           else
                           {
                              $errors="";
                              foreach($model->getErrors() as $k=>$a)
                                 $errors .= implode($a,';');
                              Yii::app()->user->setFlash('error', '不能更新课室概况！错误:' . $errors);
                              Yii::log( '不能更新课室概况！错误：' . $errors ,'warning','db' . $this->action->id);
                           }
                        }catch(CDbException $e){
                           throw new CHttpException(400,  implode($e->errorInfo,':'));
                        }
                }
                $this->render('updateSummary',array('model'=>$model));
        }

        public function loadModel()
        {
           if($this->_model===null)
           {
              if(isset($_GET['id']))
                 $this->_model=Article::model()->findByPk($_GET['id']);
              if($this->_model===null)
              {
                        throw new CHttpException(404,'请求的页面不存在！');
                        Yii::log( '不能加载文章(ID=' . $_GET['id']. ')','warning','db' . $this->action->id);
              }
           }
           return $this->_model;
        }

        //优秀助理后台管理
        public function actionAssistantAdmin()
        {
                //根据columnBE中cate判定文章类别
                if(!isset($_GET['cate']))
                   throw new CHttpException(404,'非法请求');
                $cate = $_GET['cate'];
                //search是一个固定的方法，用于查询对应的model
                //title文章标题当作助理姓名
                $model = new Article('search');
                //增加类别筛选，search中做不了
                $model->dbCriteria->compare('category_id', $cate);
                //固有函数Sets the attributes to be null.
                //去除默认值
                $model->unsetAttributes(); 
                if(isset($_GET['Article']))
                        $model->attributes=$_GET['Article'];
                $this->render('assistantAdmin',array('model'=>$model,'cate'=>$cate));
        }

         //工作感想后台管理
         public function actionFeelingAdmin()
         {
             if(!isset($_GET['cate']))
                   throw new CHttpException(404,'非法请求');
                $cate = $_GET['cate'];
                $model = new Article('search');
                $model->dbCriteria->compare('category_id', $cate);
                $model->unsetAttributes(); //campus_id默认值为0,去除默认值，则GridView中会显示所有用户
                if(isset($_GET['Article']))
                        $model->attributes=$_GET['Article'];
                $this->render('feelingAdmin',array('model'=>$model,'cate'=>$cate));

         }
     
         //活动报道后台管理
         public function actionReportAdmin()
         {
             if(!isset($_GET['cate']))
                   throw new CHttpException(404,'非法请求');
                $cate = $_GET['cate'];
                $model = new Article('search');
                $model->dbCriteria->compare('category_id', $cate);
                $model->unsetAttributes(); //campus_id默认值为0,去除默认值，则GridView中会显示所有用户
                if(isset($_GET['Article']))
                        $model->attributes=$_GET['Article'];
                $this->render('reportAdmin',array('model'=>$model,'cate'=>$cate));
         }
}
