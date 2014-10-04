<?php

/**
 * This is the model class for table "computer".
 *
 * The followings are the available columns in table 'computer':
 * @property string $comid
 * @property string $classId
 * @property string $deviceNum
 * @property string $type
 * @property string $buyTime
 * @property string $guarentee
 * @property string $supplyCompany
 * @property string $price
 * @property string $displayer
 * @property string $cpu
 * @property string $brand
 * @property string $memory
 * @property string $hardDisk
 * @property string $isUsing
 * @property string $mac
 * @property string $ip
 *
 * The followings are the available model relations:
 * @property ComRepair[] $comRepairs
 * @property Classroom $class
 */
class Computer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Computer the static model class
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
		return 'computer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('classId', 'required'),
			array('classId, isUsing', 'length', 'max'=>10),
			array('deviceNum, type, guarentee, supplyCompany, price, displayer, cpu, brand, memory, hardDisk, mac, ip', 'length', 'max'=>50),
			array('buyTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comid, classId, deviceNum, type, buyTime, guarentee, supplyCompany, price, displayer, cpu, brand, memory, hardDisk, isUsing, mac, ip', 'safe', 'on'=>'search'),
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
			'comRepairs' => array(self::HAS_MANY, 'ComRepair', 'comid'),
			'class' => array(self::BELONGS_TO, 'Classroom', 'classId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'comid' => 'ID',
                        'cid' => '校区',
			'bid' => '教学楼',
			'classId' => '教室',
			'deviceNum' => '设备号',
			'type' => '类型',
			'buyTime' => '购买时间',
			'guarentee' => '保修情况',
			'supplyCompany' => '供应商',
			'price' => '价格',
			'displayer' => '显示器类型',
			'cpu' => 'CPU',
			'brand' => '品牌',
			'memory' => '内存',
			'hardDisk' => '硬盘',
			'isUsing' => '在用/报废',
			'mac' => '物理地址',
			'ip' => 'IP',
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
                //自然连接：课室+教学楼+校区
                $criteria->with = array('class'=>array('with'=>array('b'=>array('with'=>'c'))));
                
                //检索时如果提交了校区ID且不为0,则过滤校区
                if (isset($_GET['Campus']['cname']) && $_GET['Campus']['cname'] != 0)
                    $criteria->compare('c.cid',  $_GET['Campus']['cname'], true);
                //如果提交了教学楼ID且不为0，则过滤教学楼
                if (isset($_GET['Building']['bid']) && $_GET['Building']['bid'] != 0)
                    $criteria->compare('class.bid',  $_GET['Building']['bid'], true);
                
		$criteria->compare('comid',$this->comid,true);
		$criteria->compare('class.classId',$this->classId,true);
		$criteria->compare('deviceNum',$this->deviceNum,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('buyTime',$this->buyTime,true);
		$criteria->compare('guarentee',$this->guarentee,true);
		$criteria->compare('supplyCompany',$this->supplyCompany,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('displayer',$this->displayer,true);
		$criteria->compare('cpu',$this->cpu,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('memory',$this->memory,true);
		$criteria->compare('hardDisk',$this->hardDisk,true);
		//$criteria->compare('isUsing',$this->isUsing,true);
		$criteria->compare('mac',$this->mac,true);
		$criteria->compare('ip',$this->ip,true);
                
                //if(isset($_SESSION['cc']))
                    //$criteria = $_SESSION['cc'];
                //把查询条件保存在session中，导出excel用
                $page_key = get_class($this).'_page';
                if(isset($_GET['back']) && !Yii::app()->request->isAjaxRequest) {
                    $_GET[$page_key] = $_SESSION['cp'];
                    $criteria = $_SESSION['cc'];
                }           
                
                $_SESSION['cc'] = $criteria;     
                if(isset($_GET[$page_key]))
                    $_SESSION['cp'] = $_GET[$page_key];
                else 
                    $_SESSION['cp'] = null;
                                                            
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'attributes'=>array(
                                'class.b.c.cname'=>array(
                                    'asc'=>'cname',
                                    'desc'=>'cname desc',
                                ),
                                'class.b.bname'=>array(
                                    'asc'=>'bname',
                                    'desc'=>'bname desc'
                                ),
                                'class.className'=>array(
                                    'asc'=>'className',
                                    'desc'=>'className desc'
                                ),
                                '*'
                            )
                        ),
                        'pagination'=>array(
                            'pageSize'=>20,                            
                        ),
		));
	}
}