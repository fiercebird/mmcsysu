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
                if(isset($_POST['Article']))
                {
                        $model->attributes = $_POST['Article'];
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
                        try{
                           if($model->save())
                              $this->redirect(array('view','id'=>$model->article_id));
                           else
                           {
                              $errors="";
                              foreach($model->getErrors() as $k=>$a)
                                 $errors .= implode($a,';');
                              $data= serialize($model->attributes);
                              Yii::app()->user->setFlash('error', '不能更新文章！错误:' . $errors);
                              Yii::log( '不能更新文章！错误：' . $errors. '数据：' . $data ,'warning','db' . $this->action->id);
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
                   }
                   else{ 
                        $article->status = Article::$STATUS_DELETED;
                        $article->save();
                        echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                   }
                }else
                   throw new CHttpException(404, "请求页面不存在！禁止删除文章!");
               
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


}
