<?php

/**
 * This is the model class for table "admins".
 *
 * The followings are the available columns in table 'admins':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $login_ip
 * @property integer $login_time
 * @property integer $login_count
 * @property string $create_ip
 * @property integer $create_time
 * @property integer $status
 * @property string $invite_code
 */
class Admin extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Admin the static model class
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
        return 'admins';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, email, password, login_ip, login_time, create_ip, create_time, invite_code', 'required'),
            array('mail_account_id,login_time, login_count, create_time, status', 'numerical', 'integerOnly' => true),
            array('username, password, login_ip, create_ip', 'length', 'max' => 20),
            array('email', 'length', 'max' => 50),
            array('invite_code', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, email, password,mail_account_id, login_ip, login_time, login_count, create_ip, create_time, status, invite_code', 'safe', 'on' => 'search'),
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
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'login_ip' => 'Login Ip',
            'login_time' => 'Login Time',
            'login_count' => 'Login Count',
            'create_ip' => 'Create Ip',
            'create_time' => 'Create Time',
            'status' => 'Status',
            'invite_code' => 'Invite Code',
            'mail_account_id' => 'Mail account id'
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

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('login_ip', $this->login_ip, true);
        $criteria->compare('login_time', $this->login_time);
        $criteria->compare('login_count', $this->login_count);
        $criteria->compare('create_ip', $this->create_ip, true);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('status', $this->status);
        $criteria->compare('mail_account_id', $this->mail_account_id);
        $criteria->compare('invite_code', $this->invite_code, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    //查询密码是否匹配
    public function validatePassword($password)
    {
        return $this->encrypt($password) === $this->password;
    }

    public function encrypt($pass)
    {
        return md5($pass);
    }

    // 添加的密码进行MD5加密
    protected function beforeSave()
    {
        if (parent::beforeSave())
        {
            //判断是否是新的密码
            if ($this->isNewRecord)
            {
                $this->password = $this->encrypt($this->password);
            }
            return true;
        } else
        {
            return false;
        }
    }

}
