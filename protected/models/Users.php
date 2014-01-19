<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $open_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $login_ip
 * @property integer $login_time
 * @property integer $login_count
 * @property string $create_ip
 * @property integer $create_time
 * @property integer $admin_id
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login_ip, login_time, create_ip, create_time, admin_id', 'required'),
			array('login_time, login_count, create_time, admin_id', 'numerical', 'integerOnly'=>true),
			array('open_id', 'length', 'max'=>80),
			array('username, password, login_ip, create_ip', 'length', 'max'=>20),
			array('email', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, open_id, username, email, password, login_ip, login_time, login_count, create_ip, create_time, admin_id', 'safe', 'on'=>'search'),
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
			'open_id' => 'Open',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'login_ip' => 'Login Ip',
			'login_time' => 'Login Time',
			'login_count' => 'Login Count',
			'create_ip' => 'Create Ip',
			'create_time' => 'Create Time',
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
		$criteria->compare('open_id',$this->open_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('login_ip',$this->login_ip,true);
		$criteria->compare('login_time',$this->login_time);
		$criteria->compare('login_count',$this->login_count);
		$criteria->compare('create_ip',$this->create_ip,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('admin_id',$this->admin_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
