<?php 
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-16
 *Note:
 *  
 */





class UserController extends Controller
{

        public $layout='columnBE';
        private $_model;

        public function filters(){
           return array(
                 'accessControl - getLoginSalt',             
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
                    'expression'=>'Yii::app()->user->auth & ModuleAuth::MMC_USER_ADMIN',
                    ),
                 array(
                    'deny',
                    'users'=>array('*'),
                   ),
                 );
        }

        public function actionCreateNewSalt()
        {
           if(Yii::app()->request->isAjaxRequest)
           {
                $resCode = 0;
                $resMes = 'OK';
                $salt = substr( str_pad( dechex( mt_rand() ), 8, '0', STR_PAD_LEFT ), -8 );
                echo CJSON::encode(array('salt'=>$salt, 'resCode'=>$resCode, 'resMes'=>$resMes));
           }else
              throw new CHttpException(404, "非法请求！");
        }

        public function actionGetLoginSalt()
        {
           if(Yii::app()->request->isAjaxRequest)
           {
                $username = Yii::app()->request->getParam('username'); 
                $resCode = 0;
                $resMes = 'OK';
                $salt = 0;
                $user = User::model()->findByAttributes(array('username' => $username)); 
                if(!isset($user))
                {
                        $resCode = 1;
                        $resMes = '用户名' . $username .' 不存在！';
                        Yii::log( $resMes,'info','db.actionGetLoginSalt');
                }else{
                        $salt = substr($user->password, 0, 8);
                }
                echo CJSON::encode(array('salt'=>$salt, 'resCode'=>$resCode, 'resMes'=>$resMes));
           }else
              throw new CHttpException(404, "非法请求！");
        }
 
        public function actionManageUser()
        {
                $model = new User('search');
                $model->unsetAttributes(); //campus_id默认值为0,去除默认值，则GridView中会显示所有用户
                if(isset($_GET['User']))
                        $model->attributes=$_GET['User'];
                $this->render('manageUser',array('model'=>$model));
        }


        public function actionCreateUser()
        {
                $model = new User('createUser');    
                if(isset($_POST['ajax']) && $_POST['ajax']==='userForm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
                
                if(isset($_POST['User']))
                {
                        $model->attributes = $_POST['User'];
                        try{
                                if($model->save())
                                        $this->redirect(array('view', 'id'=>$model->user_id));
                                else
                                {
                                   $errors="";
                                   foreach($model->getErrors() as $k=>$a)
                                      $errors .= implode($a,';');
                                   $data= serialize($model->attributes);
                                   Yii::app()->user->setFlash('error', '不能创建用户！错误:' . $errors);
                                   Yii::log( '不能创建用户！错误：' . $errors. '数据：' . $data ,'warning','db' . $this->action->id);
                                }
                        }catch(CDbException $e){
                           throw new CHttpException(400,  implode($e->errorInfo,':'));
                        }
                }
                $this->render('createUser',array('model'=>$model));
        }


        public function actionView()
        {
                $model=$this->loadModel();
                $this->render('view',array('model'=>$model));
        }

        public function actionUpdate()
        {
                $model=$this->loadModel();
                $model->scenario = 'updateUser';
                if(isset($_POST['ajax']) && $_POST['ajax']==='userForm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
                
                if(isset($_POST['User']))
                {
                        $model->attributes=$_POST['User'];
                        try{
                           if($model->save())
                              $this->redirect(array('view','id'=>$model->user_id));
                           else
                           {
                              $errors="";
                              foreach($model->getErrors() as $k=>$a)
                                 $errors .= implode($a,';');
                              $data= serialize($model->attributes);
                              Yii::app()->user->setFlash('error', '不能更新用户！错误:' . $errors);
                              Yii::log( '不能更新用户！错误：' . $errors. '数据：' . $data ,'warning','db' . $this->action->id);
                           }
                        }catch(CDbException $e){
                           throw new CHttpException(400,  implode($e->errorInfo,':'));

                        }
                }
                $this->render('updateUser',array('model'=>$model));
        }

        public function actionDelete($id)
        {
                if(Yii::app()->request->isAjaxRequest)
                {
                   $resCode = 0;
                   $resMes = 'OK';
                   $username = Yii::app()->request->getParam('username'); 
                   $user = User::model()->findByPk($id);
                   if(!isset($user))
                   {
                        $resCode = 1;
                        $resMes = '用户ID: '. $id .' 不存在!';
                        Yii::log($resMes,'error','db.actionDeleteUser');
                   }
                   else   
                        $user->delete();
                   echo CJSON::encode(array('resCode'=>$resCode, 'resMes'=>$resMes));
                }else
                   throw new CHttpException(404, "请求页面不存在！禁止删除用户!");
        }


        public function loadModel()
        {
           if($this->_model===null)
           {
              if(isset($_GET['id']))
                 $this->_model=User::model()->findByPk($_GET['id']);
              if($this->_model===null)
              {
                        throw new CHttpException(404,'请求的页面不存在！');
                        Yii::log( '不能加载用户(ID=' . $_GET['id']. ')','warning','db' . $this->action->id);
              }
           }
           return $this->_model;
        }

        /*       [@params]
         *   $data ... the current row data
         *   $row ... the row index
         *   [@return]   generate the output for the column
         */

        protected function authorityColumnLayout($data, $row)
        {
                $htmlStyle="";
                if($data->authority & ModuleAuth::MMC_HOMEPAGE_ADMIN)
                   $htmlStyle.="<span class='label label-important'>首页管理</span>";
                if($data->authority & ModuleAuth::MMC_CLASSROOM_ADMIN)
                   $htmlStyle.="<span class='label label-warning'>课室管理</span>";
                if($data->authority & ModuleAuth::MMC_SERVICE_ADMIN) 
                   $htmlStyle.="<span class='label label-success'>服务列表</span>";
                if($data->authority & ModuleAuth::MMC_RULE_ADMIN) 
                   $htmlStyle.="<span class='label label-info'>规章制度</span>";
                if($data->authority & ModuleAuth::MMC_TECH_EXPLORE)
                   $htmlStyle.="<span class='label label-inverse'>技术探索</span>";
                if($data->authority & ModuleAuth::MMC_TEAMSTYLE) 
                   $htmlStyle.="<span class='label label-important'>多媒体风采</span>";
                if($data->authority & ModuleAuth::MMC_COMMENT_ADMIN)
                   $htmlStyle.="<span class='label label-warning'>评论管理</span>";
                if($data->authority & ModuleAuth::MMC_USER_ADMIN) 
                   $htmlStyle.="<span class='label label-success'>用户管理</span>";
                if($data->authority & ModuleAuth::MMC_TRASH_ADMIN) 
                   $htmlStyle.="<span class='label label-info'>回收站管理</span>";
                if($data->authority & ModuleAuth::MMD_DEVICE_CHECK)
                   $htmlStyle.="<span class='label label-inverse'>设备检查登记</span>";
                if($data->authority & ModuleAuth::MMD_DEVICE_INFO) 
                   $htmlStyle.="<span class='label label-important'>设备信息查询</span>";
                if($data->authority & ModuleAuth::MMD_ACTION_MANAGE) 
                   $htmlStyle.="<span class='label label-warning'>设备操作管理</span>";
                if($data->authority & ModuleAuth::MMD_SERVICE_SURVEY)    
                   $htmlStyle.="<span class='label label-success'>服务调查统计</span>";
                return $htmlStyle;
        }

  }
