<?php

/**
 * This is the model class for table "classroom".
 *
 * The followings are the available columns in table 'classroom':
 * @property string $classId
 * @property string $className
 * @property string $seatNum
 * @property string $examNum
 * @property string $bid
 * @property string $more
 *
 * The followings are the available model relations:
 * @property Amplifier[] $amplifiers
 * @property Building $b
 * @property Computer[] $computers
 * @property Lamp[] $lamps
 * @property MaiHasLine[] $maiHasLines
 * @property MaiNoLine[] $maiNoLines
 * @property MidControl[] $midControls
 * @property Mixer[] $mixers
 * @property ProScreen[] $proScreens
 * @property Projector[] $projectors
 * @property SoundControl[] $soundControls
 * @property VoiceBox[] $voiceBoxes
 */
class Classroom extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Classroom the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'classroom';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('className, seatNum, examNum, bid', 'required'),
            array('className', 'length', 'max' => 50),
            array('seatNum, examNum, bid', 'length', 'max' => 10),
            array('more', 'length', 'max' => 200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('classId, className, seatNum, examNum, bid, more', 'safe', 'on' => 'search'),
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
            'amplifiers' => array(self::HAS_MANY, 'Amplifier', 'classId'),
            'b' => array(self::BELONGS_TO, 'Building', 'bid'),
            'computers' => array(self::HAS_MANY, 'Computer', 'classId'),
            'lamps' => array(self::HAS_MANY, 'Lamp', 'classId'),
            'maiHasLines' => array(self::HAS_MANY, 'MaiHasLine', 'classId'),
            'maiNoLines' => array(self::HAS_MANY, 'MaiNoLine', 'classId'),
            'midControls' => array(self::HAS_MANY, 'MidControl', 'classId'),
            'mixers' => array(self::HAS_MANY, 'Mixer', 'classId'),
            'proScreens' => array(self::HAS_MANY, 'ProScreen', 'classId'),
            'projectors' => array(self::HAS_MANY, 'Projector', 'classId'),
            'soundControls' => array(self::HAS_MANY, 'SoundControl', 'classId'),
            'voiceBoxes' => array(self::HAS_MANY, 'VoiceBox', 'classId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'classId' => 'ID',
            'className' => '课室名',
            'seatNum' => '座位数',
            'examNum' => '考位数',
            'bid' => '教学楼',
            'more' => '备注',
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

        $criteria = new CDbCriteria;
        //自然连接：教学楼+校区
        $criteria->with = array('b'=>array('with'=>'c'));
        //检索时如果提交了校区ID且不为0,则过滤校区
        if (isset($_GET['Campus']['cname']) && $_GET['Campus']['cname'] != 0)
            $criteria->compare('c.cid',  $_GET['Campus']['cname'], true);
        
        //其他一些过滤
        $criteria->compare('classId', $this->classId, true);
        $criteria->compare('className', $this->className, true);
        $criteria->compare('seatNum', $this->seatNum, true);
        $criteria->compare('examNum', $this->examNum, true);
        $criteria->compare('b.bid', $this->bid, true);
        $criteria->compare('more', $this->more, true);
        
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
                    'criteria' => $criteria,
                    //下面是对“校区”和“教学楼”的排序
                    'sort'=>array(
                        'attributes'=>array(
                            'b.cid'=>array(
                                'asc'=>'cname',
                                'desc'=>'cname desc'
                            ),
                            'bid'=>array(
                                'asc'=>'bname',
                                'desc'=>'bname desc'
                            ),
                            '*'
                        )
                    ),
                    'pagination'=>array(
                        'pageSize'=>20,
                    ),
                ));
    }
    
    //按照教学楼ID获取课室列表
    public function getClassOptionsByBid($bid)
    {
        $data = CHtml::listData($this->findAllByAttributes(array('bid'=>$bid)), 'classId', 'className');
        return $data;
    }
    
    //根据校区、教学楼、课室获取课室model，用于Excel导入设备数据时
    public function getClassId($cname,$bname,$className)
    {
        $criteria=new CDbCriteria;
        $criteria->with = array('b'=>array('with'=>'c'));
        $criteria->compare('cname', $cname);
        $criteria->compare('bname', $bname);
        $criteria->compare('className', $className);
        return Classroom::model()->find($criteria);
    }
}