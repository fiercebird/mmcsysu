<?php

/**
 * This is the model class for table "mis_comment".
 *
 * The followings are the available columns in table 'mis_comment':
 * @property string $comment_id
 * @property string $create_time
 * @property string $author
 * @property string $email
 * @property string $content
 * @property integer $status
 * @property string $reply
 */
class Comment extends CActiveRecord
{
        static $STATUS_PENDING=0;
	static $STATUS_SET_TOP=1;
	static $STATUS_PASS=2;
	static $STATUS_DELETED=3;

        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'mis_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('author', 'length', 'max'=>128),
			array('email', 'length', 'max'=>256),
			array('content, reply', 'length', 'max'=>1024),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('create_time, author, email, content, status', 'safe', 'on'=>'search'),
			array('author, email, content,', 'safe', 'safe'=>false, 'on'=>'update'),
		);
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
			'comment_id' => '评论ID',
			'create_time' => '创建时间',
			'author' => '评论人',
			'email' => '邮箱',
			'content' => '评论内容',
			'status' => '评论状态',
			'reply' => '回复内容',
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
                $criteria->select = 'comment_id, create_time, author, email, content, status';
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->addCondition('status!=' . Comment::$STATUS_DELETED);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                           'defaultOrder'=>'status, create_time DESC',
                           ),
		));
	}

        public function searchTrash()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select = 'comment_id, create_time, author, email, content, status';
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->addCondition('status=' . Comment::$STATUS_DELETED);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                           'defaultOrder'=>'create_time DESC',
                           ),
		));
	}
        	
	/**
	 * Namedscope
	 */
	public function scopes()
	{
		return array(
		     	'pending'=>array('condition'=>'status=' . self::$STATUS_PENDING),
			'setTop'=>array('condition'=>'status='. self::$STATUS_SET_TOP),      
			'pass'=>array('condition'=>'status=' . self::$STATUS_PASS),      
			'deleted'=>array('condition'=>'status='. self::$STATUS_DELETED),
			'passAndSetTop'=>array(
                           'condition'=>'status=' . self::$STATUS_PASS . ' or status=' . self::$STATUS_SET_TOP,
                           'order'=>'status, create_time DESC',
                           ),      
			'recently'=>array(
			   	'select'=>'comment_id, author, email, create_time, content, status, reply',
				'order'=>'status, create_time DESC',
				'limit'=>12,
			),
		);
	}

        public static function getNum()
        {                                                                      
              static $i=1;                                                                         
                 echo $i;                                                                             
                    $i++;
        }

        protected function beforeSave()
        {                
           if(parent::beforeSave())
           {
              if($this->isNewRecord)
              {
                 $this->create_time = date( 'Y-m-d H:i:s', time() );
              }
              return true;
           }
           else
              return false;
        }

}
