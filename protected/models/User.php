<?php

/**
 * This is the model class for table "mis_users".
 *
 * The followings are the available columns in table 'mis_users':
 * @property string $user_id
 * @property string $username
 * @property string $password
 * @property integer $campus_id
 * @property string $authority
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mis_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password,  campus_id', 'required'),
                        array('campus_id', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>128),
			array('authority', 'normalizeAuth'),
			array('username', 'existInTable', 'on'=>'createUser'),
			array('username', 'uniqueInTable', 'on'=>'updateUser'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username,campus_id', 'safe', 'on'=>'search'),
		);
	}
        
        public function existInTable($attribute, $params)
        {
                $user=User::Model()->findbyAttributes(array('username'=>$this->username));
                if(isset($user))
                      $this->addError('username','用户名已存在');
        }
        
        public function uniqueInTable($attribute, $params)
        {
                $user=User::Model()->findbyAttributes(array('username'=>$this->username));
                if(isset($user) &&  $user->user_id != $this->user_id && $user->username == $this->username)
                      $this->addError('username','用户名已存在');
        }

        public function normalizeAuth($attribute, $params)
        {
                $auth= 0;
                if(isset($this->authority) && !empty($this->authority)){
                   foreach ( $this->authority as $k=>$v)
                       $auth = $auth | $v; 
                }
                $this->authority = $auth;
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => '用户ID',
			'username' => '用户名',
			'password' => '密码',
			'campus_id' => '校区',
			'authority' => '权限',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('username',$this->username,true);
	        $criteria->compare('campus_id',$this->campus_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


        /**
         * @return string the URL that shows the detail of the user
         */
        public function getUrl()
        {
           return Yii::app()->createUrl('user/view', array(
                    'id'=>$this->user_id,
                    ));
        }

        /**
         * This is invoked after the record is deleted.
         * 把该用户的文章转改为author_id=0
         */
        protected function afterDelete()
        {                
           parent::afterDelete();    
//           Article::model()->updateAll(array('author_id'=>0), array('author_id'=>$this->user_id));
        }

        //如果当前用户更新了自己的用户信息，则更新sess中的用户信息
        protected function afterSave()
        {                
           parent::afterSave();    
           if(!$this->isNewRecord && Yii::app()->user->id == $this->user_id)
           {
              Yii::app()->user->name = $this->username;
              Yii::app()->user->auth = $this->authority;
              Yii::app()->user->campusId = $this->campus_id;
           }
        }

}
