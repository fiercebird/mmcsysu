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
                    ),
                 array(
                    'deny',
                    'users'=>array('*'),
                   ),
                 );
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
                        $resMEs = "用户名不存在";
                        Yii::log('username' . $username .' is not exist','info','db.actionGetLoginSalt');
                }else{
                        $salt = substr($user->password, 0, 8);
                }
                echo CJSON::encode(array('salt'=>$salt, 'resCode'=>$resCode, 'resMes'=>$resMes));
           }else
              throw new CHttpException(404, "非法请求！");
        }
        
        public function actionCreateUser()
        {
                
        
                $this->render('createUser',array());
        }


        public function actionManageUser()
        {
                $model = new User('search');
                if(isset($_GET['User']))
                        $model->attributes=$_GET['User'];
                $this->render('manageUser',array('model'=>$model));
        }

}
