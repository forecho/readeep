<?php

/**
 * This is the model class for table "contact_person".
 *
 * The followings are the available columns in table 'contact_person':
 * @property integer $contact_person_id
 * @property integer $admin_id
 * @property string $contact_group_id
 * @property string $mobile
 * @property integer $gender
 * @property string $email
 * @property string $birthday
 * @property string $address
 * @property string $nickname
 */
class ContactPerson extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact_person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_id, gender', 'numerical', 'integerOnly'=>true),
			array('contact_group_id, email, address', 'length', 'max'=>60),
			array('mobile, nickname', 'length', 'max'=>20),
			array('birthday', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('contact_person_id, admin_id, contact_group_id, mobile, gender, email, birthday, address, nickname', 'safe', 'on'=>'search'),
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
			'contact_person_id' => '联系人id',
			'admin_id' => '管理员id',
			'contact_group_id' => '联系人所在分组id',
			'mobile' => '手机号',
			'gender' => '性别',
			'email' => 'email邮箱',
			'birthday' => '生日',
			'address' => '地址',
			'nickname' => '昵称',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('contact_person_id',$this->contact_person_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('contact_group_id',$this->contact_group_id,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('nickname',$this->nickname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContactPerson the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
