<?php

/**
 * This is the model class for table "building".
 *
 * The followings are the available columns in table 'building':
 * @property string $bid
 * @property string $bname
 * @property string $cid
 *
 * The followings are the available model relations:
 * @property Campus $c
 * @property Classroom[] $classrooms
 */
class Building extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Building the static model class
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
		return 'building';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bname, cid', 'required'),
			array('bname', 'length', 'max'=>50),
			array('cid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bid, bname, cid', 'safe', 'on'=>'search'),
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
			'c' => array(self::BELONGS_TO, 'Campus', 'cid'),
			'classrooms' => array(self::HAS_MANY, 'Classroom', 'bid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bid' => 'ID',
			'bname' => '教学楼',
			'cid' => '校区',
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

		$criteria->compare('bid',$this->bid,true);
		$criteria->compare('bname',$this->bname,true);
		$criteria->compare('cid',$this->cid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getBuildingList() {
		$data = CHtml::listData($this->findAll(), 'bid', 'bname');
		//$data['0'] = "请选择校区";
		ksort($data);
		return $data;
	}
	
	public function getBuildingOptions()
	{
		$data = CHtml::listData($this->findAll(), 'bid', 'bname');
		$data[''] = "全部";
		ksort($data);
		return $data;
	}
	
        public function getBuildingOptionsByCampus($cid)
	{
		$data = CHtml::listData($this->findAllByAttributes(array('cid'=>$cid)), 'bid', 'bname');
		return $data;
	}

	//根据教学楼名称获取教学楼model，用于Excel导入设备数据时
	public function getBuildingId ($bname)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('bname', $bname);
		return Building::model()->find($criteria);
	}
	
	public function getCampusId ($bid)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('bid', $bid);
		return Building::model()->find($criteria);
	}
}