<?php

/**
 * This is the model class for table "contact_group".
 *
 * The followings are the available columns in table 'contact_group':
 * @property integer $contact_group_id
 * @property integer $mail_template_id
 * @property string $contact_group_name
 * @property integer $contact_group_parent_id
 */
class ContactGroup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_group_id, mail_template_id, contact_group_parent_id', 'numerical', 'integerOnly'=>true),
			array('contact_group_name', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('contact_group_id, mail_template_id, contact_group_name, contact_group_parent_id', 'safe', 'on'=>'search'),
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
			'contact_group_id' => '联系人分组id',
			'mail_template_id' => '模板id',
			'contact_group_name' => '分组名',
			'contact_group_parent_id' => '上级分组id',
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

		$criteria->compare('contact_group_id',$this->contact_group_id);
		$criteria->compare('mail_template_id',$this->mail_template_id);
		$criteria->compare('contact_group_name',$this->contact_group_name,true);
		$criteria->compare('contact_group_parent_id',$this->contact_group_parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContactGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
