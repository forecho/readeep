<?php

/**
 * This is the model class for table "post_posts".
 *
 * The followings are the available columns in table 'post_posts':
 * @property integer $id
 * @property string $title
 * @property string $excerpt
 * @property string $image
 * @property string $content
 * @property integer $create_time
 * @property integer $status
 * @property integer $order
 * @property string $tags
 * @property integer $view_count
 * @property integer $thanks_count
 * @property integer $like_count
 * @property integer $comment_count
 * @property integer $admin_id
 */
class PostPosts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PostPosts the static model class
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
		return 'post_posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, image, content, create_time, tags', 'required'),
			array('status, order, view_count, thanks_count, like_count, comment_count, admin_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('excerpt', 'length', 'max'=>255),
			array('image', 'length', 'max'=>100),
			array('tags', 'length', 'max'=>200),
			array('create_time', 'date', 'format'=>'yyyy-MM-dd hh:mm', 'message'=>'{attribute} have wrong format'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, excerpt, image, content, create_time, status, order, tags, view_count, thanks_count, like_count, comment_count, admin_id', 'safe', 'on'=>'search'),
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
			'admin'=>array(self::BELONGS_TO, 'Admin', 'admin_id'),
			'weixin_set'=>array(self::HAS_ONE, 'WeixinSet', '', 'on' => 'admin_id=weixin_set.admin_id'),
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
			'excerpt' => 'Excerpt',
			'image' => 'Image',
			'content' => 'Content',
			'create_time' => 'Create Time',
			'status' => 'Status',
			'order' => 'Order',
			'tags' => 'Tags',
			'view_count' => 'View Count',
			'thanks_count' => 'Thanks Count',
			'like_count' => 'Like Count',
			'comment_count' => 'Comment Count',
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
		$criteria->compare('excerpt',$this->excerpt,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('status',$this->status);
		$criteria->compare('order',$this->order);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('view_count',$this->view_count);
		$criteria->compare('thanks_count',$this->thanks_count);
		$criteria->compare('like_count',$this->like_count);
		$criteria->compare('comment_count',$this->comment_count);
		$criteria->compare('admin_id',$this->admin_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		$this->admin_id = Yii::app()->user->id;
	    // $this->create_time = date('Y-m-d', CDateTimeParser::parse($this->create_time, 'yyyy-MM-dd hh:mm'));
	    $this->create_time = strtotime($this->create_time);
	    return parent::beforeSave();
	}

	protected function afterFind()
	{
	    $this->create_time = Yii::app()->dateFormatter->format('yyyy-MM-dd hh:mm', $this->create_time);
	    return parent::afterFind();
	}
}