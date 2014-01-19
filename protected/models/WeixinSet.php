<?php

/**
 * This is the model class for table "weixin_set".
 *
 * The followings are the available columns in table 'weixin_set':
 * @property integer $id
 * @property string $token
 * @property string $name
 * @property string $wx_id
 * @property string $rawid
 * @property string $avatar
 * @property string $qr_code
 * @property integer $admin_id
 */
class WeixinSet extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'weixin_set';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('token, name, wx_id, rawid, admin_id', 'required'),
			array('admin_id', 'numerical', 'integerOnly'=>true),
			array('token, rawid', 'length', 'max'=>10),
			array('name, wx_id', 'length', 'max'=>20),
			array('avatar, qr_code', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, token, name, wx_id, rawid, avatar, qr_code, admin_id', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'token' => 'Token',
			'name' => 'Name',
			'wx_id' => 'Wx',
			'rawid' => 'Rawid',
			'avatar' => 'Avatar',
			'qr_code' => 'Qr Code',
			'admin_id' => 'Admin',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('wx_id',$this->wx_id,true);
		$criteria->compare('rawid',$this->rawid,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('qr_code',$this->qr_code,true);
		$criteria->compare('admin_id',$this->admin_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WeixinSet the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
