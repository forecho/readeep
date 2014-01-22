<?php

/**
 * This is the model class for table "card".
 *
 * The followings are the available columns in table 'card':
 * @property integer $id
 * @property string $title
 * @property string $thumb
 * @property string $image
 * @property integer $card_type_id
 * @property string $music
 * @property integer $admin_id
 */
class Card extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Card the static model class
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
		return 'card';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, thumb, image, card_type_id', 'required'),
			array('card_type_id, admin_id', 'numerical', 'integerOnly'=>true),
			array('thumb, image, music', 'length', 'max'=>100),
			array('title', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, thumb, image, card_type_id, music, admin_id', 'safe', 'on'=>'search'),
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
			'cardType' => array(self::BELONGS_TO, 'CardType', 'card_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'thumb' => 'Thumb',
			'image' => 'Image',
			'card_type_id' => 'Card Type Id',
			'music' => 'Music',
			'admin_id' => 'Admin',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('thumb',$this->thumb,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('card_type_id',$this->card_type_id);
		$criteria->compare('music',$this->music,true);
		$criteria->compare('admin_id',$this->admin_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		$this->admin_id = Yii::app()->user->id;
	    return parent::beforeSave();
	}
}