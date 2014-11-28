<?php

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property integer $id
 * @property integer $image_group_id
 * @property string $filename
 * @property integer $size
 * @property string $cdn_url
 * @property integer $admin_id
 * @property string $created
 * @property string $modified
 */
class Images extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_group_id, filename, admin_id', 'required'),
			array('image_group_id, size, admin_id', 'numerical', 'integerOnly'=>true),
			// array('filename', 'length', 'max'=>255),
			array('cdn_url', 'length', 'max'=>250),
			array('modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, image_group_id, filename, size, cdn_url, admin_id, created, modified', 'safe', 'on'=>'search'),
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
			'image_group_id' => 'Image Group',
			'filename' => 'Filename',
			'size' => 'Size',
			'cdn_url' => 'Cdn Url',
			'admin_id' => 'Admin',
			'created' => 'Created',
			'modified' => 'Modified',
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
		$criteria->compare('image_group_id',$this->image_group_id);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('cdn_url',$this->cdn_url,true);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Images the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * 时间更新
     * @return void
     */
    public function beforeSave()
    {
        if ($this->isNewRecord)
            $this->created = new CDbExpression('NOW()');

        $this->modified = new CDbExpression('NOW()');

        return parent::beforeSave();
    }
}
