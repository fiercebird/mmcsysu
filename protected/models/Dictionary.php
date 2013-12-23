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
			array('dictionary_id, dictionary_type, item_key, item_value, display_order', 'safe', 'on'=>'search'),
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
			'dictionary_id' => 'Dictionary',
			'dictionary_type' => 'Dictionary Type',
			'item_key' => 'Item Key',
			'item_value' => 'Item Value',
			'display_order' => 'Display Order',
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

		$criteria->compare('dictionary_id',$this->dictionary_id,true);
		$criteria->compare('dictionary_type',$this->dictionary_type,true);
		$criteria->compare('item_key',$this->item_key,true);
		$criteria->compare('item_value',$this->item_value,true);
		$criteria->compare('display_order',$this->display_order,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}