<?php 

class ServiceController extends Controller
{

        public $layout='columnBE';

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
                   'actions'=>array('create', 'admin', 'delete'),
                    'users'=>array('@'),
                   'expression'=>'(Yii::app()->user->auth & ModuleAuth::MMC_SERVICE_ADMIN)',
                    ),

                 array(
                    'deny',
                    'users'=>array('*'),
                   ),
                 );
        }

        public function actionCreate() {
            $model = new MisService;
            if(isset($_POST['MisService'])) {
                $model->attributes = $_POST['MisService'];
                $model->save();
                 Yii::app()->user->setFlash('success', '添加成功！');
                $this->redirect(array('admin', 'typeid' => $model->type));
            }
            $this->render('create', array('model' => $model));
        }
        
        public function actionAdmin() {
            $model = new MisService('search');
            $model->unsetAttributes();
            if(isset($_GET['MisService']))
                $model->attributes=$_GET['MisService'];
            if(!isset($_GET['typeid']))
            {
                throw new CHttpException(404, '请求的页面不存在!'); 
            }
            $this->render('admin', array(
            'model' => $model,
            'typeid' => intval($_GET['typeid']),
            ));
        }
        
        public function actionDelete($id)
        {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        
        public function loadModel($id)
        {
        $model = MisService::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, '请求的页面不存在!');
        return $model;
        }
       
}
