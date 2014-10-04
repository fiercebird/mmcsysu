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

	static $STATUS_DRAFT=0;
	static $STATUS_SET_TOP=1;
	static $STATUS_PUBLISHED=2;
	static $STATUS_DELETED=3;

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
			array('campus_id, publisher, title, content', 'required'),
			array('content', 'required', 'on'=>'contactTel'),
			array('publisher', 'length', 'max'=>128),
			array('title', 'length', 'max'=>256),
			array('author_id, category_id, status, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('campus_id, publisher, create_time, update_time, title, status', 'safe', 'on'=>'search'),
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
			'article_id' => '文章ID',
			'category_id' => '类别',
			'author_id' => '作者',
			'campus_id' => '校区',
			'publisher' => '发布方',
			'create_time' => '创建时间',
			'update_time' => '更新时间',
			'title' => '文章标题',
			'content' => '文章内容',
			'tag' => '文章标签',
			'status' => '文章状态',
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
                $criteria->select = 'article_id, category_id, campus_id, publisher, create_time, update_time, title, status';
		$criteria->compare('campus_id',$this->campus_id);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status);
		$criteria->addCondition('status!=' . Article::$STATUS_DELETED);
		return new CActiveDataProvider($this, array(
                         'criteria'=>$criteria,
                         'sort'=>array(
                            'defaultOrder'=>'status, update_time DESC',
                            ),
		));
	}

	public function searchTrash()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select = 'article_id, category_id, campus_id, publisher, create_time, update_time, title, status';
		$criteria->compare('campus_id',$this->campus_id);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status);
		$criteria->addCondition('status=' . Article::$STATUS_DELETED);
		return new CActiveDataProvider($this, array(
                         'criteria'=>$criteria,
                         'sort'=>array(
                            'defaultOrder'=>'update_time DESC',
                            ),
		));
	}

	/**
	 * Namedscope
	 */
	public function scopes()
	{
		return array(
		     	'draft'=>array('condition'=>'status=' . self::$STATUS_DRAFT),
			'setTop'=>array('condition'=>'status='. self::$STATUS_SET_TOP),      
			'published'=>array('condition'=>'status=' . self::$STATUS_PUBLISHED),      
			'deleted'=>array('condition'=>'status='. self::$STATUS_DELETED),
			'serviceInfo'=>array('condition'=>'category_id='. Category::$CATE_SERVICE_INFO),
			'publishedandSetTop'=>array(
                           'condition'=>'status=' . self::$STATUS_PUBLISHED . ' or status=' . self::$STATUS_SET_TOP,
                           'order'=>'status, update_time DESC',
                           ),      
			'recently'=>array(
			   	'select'=>'article_id, campus_id, publisher, title, create_time, update_time, status',
				'order'=>'status, update_time DESC',
				'limit'=>Yii::app()->params['recentlyNewsPerPage'],
			),
                        //特色课室
			'specialClassroom'=>array(
			   'condition'=>'category_id=' . Category::$CATE_SPECIAL_CLASSROOM . ' and (status=' . self::$STATUS_PUBLISHED . ' or status=' . self::$STATUS_SET_TOP . ')'
			),
                        //规章制度
			'regulationRules'=>array(
			   'select'=>"article_id, title,left(content,600) as content",
			   'condition'=>'category_id='. Category::$CATE_REGULATION_RULE . ' and (status=' . self::$STATUS_PUBLISHED . ' or status=' . self::$STATUS_SET_TOP . ')'
			),
                        //技术探索
                        'techExplode'=>array(
			   'select'=>"article_id, title,left(content,600) as content",
			   'condition'=>'category_id='. Category::$CATE_TECH_EXPLORE . ' and (status=' . self::$STATUS_PUBLISHED . ' or status=' . self::$STATUS_SET_TOP . ')'
			),
                        //优秀助理
                        'perfectAssistants'=>array(
                           'select'=>"article_id, title,left(content,600) as content",
                           'condition'=>'category_id='. Category::$CATE_PERFECT_ASSISTANT . ' and (status=' . self::$STATUS_PUBLISHED . ' or status=' . self::$STATUS_SET_TOP . ')'
                        ),
                     
                        //工作感想
                        'workFeelings'=>array(
                           'select'=>"article_id, title,left(content,600) as content",
                           'condition'=>'category_id='. Category::$CATE_WORK_FEELING . ' and (status=' . self::$STATUS_PUBLISHED . ' or status=' . self::$STATUS_SET_TOP . ')'
                        ),

                        //活动报道
                        'activityReports'=>array(
                           'select'=>"article_id, title,left(content,600) as content",
                           'condition'=>'category_id='. Category::$CATE_ACTIVITY_REPORT . ' and (status=' . self::$STATUS_PUBLISHED . ' or status=' . self::$STATUS_SET_TOP . ')'
                        ),

		);
	}


        /**
         * @return string the URL that shows the detail of the user
         */
        public function getUrl()
        {
           return Yii::app()->createUrl('site/article', array(
                    'id'=>$this->article_id,
                    'cate'=>$this->category_id,
                    ));
        }

        /**
         * This is invoked after the record is deleted.
         */

        protected function afterDelete()
        {                
           parent::afterDelete();    

           if($this->category_id == Category::$CATE_SPECIAL_CLASSROOM) //物理删除文章时吧字典表也删掉
	   {
                  $specialRoomItem = Dictionary::model()->findByAttributes(array('item_key'=>$this->article_id, 'dictionary_type'=> Yii::app()->params['dictTypeSpecialClassroom'])); 
                  $specialRoomItem->delete();

           }
        }

        /**
         * This is invoked after the record is deleted.
         * 如果是特色课室，还需要往dictionary表中插入自增主键
         */

        protected function afterSave()
        {                
           parent::afterSave();    
           if($this->category_id == Category::$CATE_SPECIAL_CLASSROOM)
           {
              if($this->isNewRecord){   //新建记录
                $model = new Dictionary();
                $model->dictionary_type = Yii::app()->params['dictTypeSpecialClassroom'];
                $model->item_key = $this->article_id;
                $model->item_value = $this->title;
                $n = Dictionary::getTypeCount(Yii::app()->params['dictTypeSpecialClassroom']);
                $model->display_order = $n+1;
                $model->save();
              }else{        
              if ($this->status == self::$STATUS_DELETED)  //把文章放入回收站
              {
                  $specialRoomItem = Dictionary::model()->findByAttributes(array('item_key'=>$this->article_id, 'dictionary_type'=> Yii::app()->params['dictTypeSpecialClassroom'])); 
                  $specialRoomItem->display_order = -$specialRoomItem->display_order;
                  $specialRoomItem->save();
              }else{   //更新文章或者从回收站撤销文章
                  $specialRoomItem = Dictionary::model()->findByAttributes(array('item_key'=>$this->article_id, 'dictionary_type'=> Yii::app()->params['dictTypeSpecialClassroom'])); 
                  $specialRoomItem->item_value = $this->title;
                  if( $specialRoomItem->display_order < 0 ) //从回收站回收文章时让序号为正
                      $specialRoomItem->display_order = -$specialRoomItem->display_order;
                  $specialRoomItem->save();
                   
	      }
              }
           }
           return true;
        }
        //更新update_time,设置create_time
        protected function beforeSave()
        {                
           if(parent::beforeSave())
           {
              if($this->isNewRecord)
              {
                 $this->create_time = date( 'Y-m-d H:i:s', time() );
                 $this->update_time = date( 'Y-m-d H:i:s', time() );
                 $this->author_id=Yii::app()->user->id;
              }
              else
                 $this->update_time = date( 'Y-m-d H:i:s', time() );
              return true;
           }
           else
              return false;
        }

}
