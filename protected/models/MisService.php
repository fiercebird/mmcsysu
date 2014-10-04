<?php

/**
 * This is the model class for table "mis_service".
 *
 * The followings are the available columns in table 'mis_service':
 * @property string $id
 * @property integer $type
 * @property string $content
 * @property string $date
 */
class MisService extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MisService the static model class
	 */
        const WEEK_SERVICE = 1;   //周
        const MONTH_SERVICE = 2;  //月
        const SURVEY_SERVICE = 3; //調查
        const STAT_SERVICE = 4;   //統計
        const TABLE_SERVICE = 5;  //表格
        
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mis_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, date', 'required'),
                        array('content', 'required', 'message' => '请选择上传的文件'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('content', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, content, date', 'safe', 'on'=>'search'),
		);
	}
        
        protected function beforeValidate() {
            $this->date = new CDbExpression('NOW()');
            return parent::beforeValidate();
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
			'id' => 'ID',
			'type' => '类別',
			'content' => '报表链接',
			'date' => '创建日期',
		);
	}
        
        public static function getTypeList() {
            return array(
                self::WEEK_SERVICE => '周报表',
                self::MONTH_SERVICE => '月报表',  
                self::SURVEY_SERVICE => '服务调查表',
                self::STAT_SERVICE => '服务统计表', 
                self::TABLE_SERVICE => '表格',  
            );
        }
        
        public static function getLink($str) {
            return "<a href='$str'>$str</a>";
        }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($typeid)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('type', $typeid);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
				'pageSize'=>20,
				),
                        'sort' => array('defaultOrder' => 'date DESC'),
		));
	}
}