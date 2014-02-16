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




}
