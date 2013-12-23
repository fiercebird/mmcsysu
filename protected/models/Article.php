<?php

/**
 * This is the model class for table "mis_article".
 *
 * The followings are the available columns in table 'mis_article':
 * @property string $article_id
 * @property integer $category_id
 * @property string $author_id
 * @property integer $campus_id
 * @property string $publisher
 * @property string $create_time
 * @property string $update_time
 * @property string $title
 * @property string $content
 * @property string $tag
 * @property integer $status
 */
class Article extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
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
		return 'mis_article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, tag', 'required'),
			array('category_id, campus_id, status', 'numerical', 'integerOnly'=>true),
			array('author_id', 'length', 'max'=>10),
			array('publisher', 'length', 'max'=>128),
			array('title', 'length', 'max'=>256),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('article_id, category_id, author_id, campus_id, publisher, create_time, update_time, title, content, tag, status', 'safe', 'on'=>'search'),
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
			'article_id' => 'Article',
			'category_id' => 'Category',
			'author_id' => 'Author',
			'campus_id' => 'Campus',
			'publisher' => 'Publisher',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'title' => 'Title',
			'content' => 'Content',
			'tag' => 'Tag',
			'status' => 'Status',
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

		$criteria->compare('article_id',$this->article_id,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('author_id',$this->author_id,true);
		$criteria->compare('campus_id',$this->campus_id);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}