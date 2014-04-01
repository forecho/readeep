<?php

/**
 * This is the model class for table "mail_account".
 *
 * The followings are the available columns in table 'mail_account':
 * @property integer $mai_account_id
 * @property string $mail_account
 * @property string $mail_password
 * @property string $host
 * @property integer $port
 */
class MailAccount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('port', 'numerical', 'integerOnly'=>true),
			array('mail_account, mail_password, host', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mai_account_id, mail_account, mail_password, host, port', 'safe', 'on'=>'search'),
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
			'mai_account_id' => '邮箱账号id',
			'mail_account' => '邮箱账号',
			'mail_password' => '邮箱密码',
			'host' => '邮箱服务器',
			'port' => '服务器端口',
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

		$criteria->compare('mai_account_id',$this->mai_account_id);
		$criteria->compare('mail_account',$this->mail_account,true);
		$criteria->compare('mail_password',$this->mail_password,true);
		$criteria->compare('host',$this->host,true);
		$criteria->compare('port',$this->port);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MailAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
