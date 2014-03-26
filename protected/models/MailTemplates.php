<?php

/**
 * This is the model class for table "{{mail_templates}}".
 *
 * The followings are the available columns in table '{{mail_templates}}':
 * @property integer $template_id
 * @property string $template_code
 * @property integer $is_html
 * @property string $template_subject
 * @property string $template_content
 * @property string $last_modify
 */
class MailTemplates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_templates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('template_content', 'required'),
			array('is_html', 'numerical', 'integerOnly'=>true),
			array('template_code', 'length', 'max'=>30),
			array('template_subject', 'length', 'max'=>200),
			array('last_modify', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('template_id, template_code, is_html, template_subject, template_content, last_modify', 'safe', 'on'=>'search'),
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
			'template_id' => '邮件模板',
			'template_code' => 'Template Code',
			'is_html' => '是否html显示',
			'template_subject' => '邮件主题',
			'template_content' => '邮件内容',
			'last_modify' => '最后修改时间',
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

		$criteria->compare('template_id',$this->template_id);
		$criteria->compare('template_code',$this->template_code,true);
		$criteria->compare('is_html',$this->is_html);
		$criteria->compare('template_subject',$this->template_subject,true);
		$criteria->compare('template_content',$this->template_content,true);
		$criteria->compare('last_modify',$this->last_modify,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MailTemplates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
