<?php

/**
 * This is the model class for table "mis_dictionary".
 *
 * The followings are the available columns in table 'mis_dictionary':
 * @property string $dictionary_id
 * @property string $dictionary_type
 * @property string $item_key
 * @property string $item_value
 * @property string $display_order
 */
class Dictionary extends CActiveRecord
{

        private static $_items=array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dictionary the static model class
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
		return 'mis_dictionary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dictionary_type', 'length', 'max'=>128),
			array('item_key, display_order', 'length', 'max'=>10),
			array('item_value', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dictionary_type, item_key, item_value, display_order', 'safe', 'on'=>'search'),
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
			'dictionary_id' => '字典自增ID',
			'dictionary_type' => '字段类型',
			'item_key' => '条目键',
			'item_value' => '条目值',
			'display_order' => '显示顺序',
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

		$criteria->compare('dictionary_type',$this->dictionary_type,true);
		$criteria->compare('item_key',$this->item_key);
		$criteria->compare('item_value',$this->item_value,true);
		$criteria->compare('display_order',$this->display_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	*  NamedScope
	*/
	public function scopes()
	{
		return array(
			'specialClassroomItems'=>array(
				'select'=>'item_key, item_value, display_order',
				'condition'=>'dictionary_type="' . Yii::app()->params['dictTypeSpecialClassroom'] . '"',
			),
		
		);
	
        }

        public static function getTypeCount($type)
        {   
           if(isset(self::$_items[$type]))
                return count(self::$_items[$type]);
           return Dictionary::model()->count('dictionary_type="'.$type . '"');
        }   


        /** 
         * Returns the items for the specified type.
         * @param string item type (e.g. 'PostStatus').
         * @return array item names indexed by item code. The items are order by their position values.
         * An empty array is returned if the item type does not exist.
         */
        public static function items($type)
        {   
           if(!isset(self::$_items[$type]))
              self::loadItems($type);
           return self::$_items[$type];
        }   


        /** 
         * Returns the item name for the specified type and code.
         * @param string the item type (e.g. 'ArticleStatus').
         * @param integer the item key (corresponding to the 'key' column value)
         * @return string the item value for the specified the key. False is returned if the item type or key does not exist.
         */
        public static function item($type,$key)
        {   
           if(!isset(self::$_items[$type]))
              self::loadItems($type);
           return isset(self::$_items[$type][$key]) ? self::$_items[$type][$key] : false;
        }   


        /** 
         * Loads the lookup items for the specified type from the database.
         * @param string the item type
         */
        private static function loadItems($type)
        {   
           self::$_items[$type]=array();
           $models=self::model()->findAll(array(
                    'condition'=>'dictionary_type=:type',
                    'params'=>array(':type'=>$type),
                    'order'=>'display_order',
                    )); 
           foreach($models as $model)
              self::$_items[$type][$model->item_key]=$model->item_value;
        }

}
