<?php

/**
 * This is the model class for table "mis_note".
 *
 * The followings are the available columns in table 'mis_note':
 * @property string $note_id
 * @property string $create_time
 * @property string $author
 * @property string $email
 * @property string $content
 * @property integer $status
 * @property string $reply
 */
class Note extends CActiveRecord
{

	static $STATUS_NOT_PASS=0;
	static $STATUS_PASS=1;
	static $STATUS_PASS_TOP=2;
	static $STATUS_GARBAGE=3;    
       
        
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Note the static model class
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
		return 'mis_note';
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
			array('note_id, create_time, author, email, content, status, reply', 'safe', 'on'=>'search'),
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
			'note_id' => 'Note',
			'create_time' => 'Create Time',
			'author' => 'Author',
			'email' => 'Email',
			'content' => 'Content',
			'status' => 'Status',
			'reply' => 'Reply',
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

		$criteria->compare('note_id',$this->note_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('reply',$this->reply,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
