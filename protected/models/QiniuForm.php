<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class QiniuForm extends CFormModel
{
	public $bucket;
	public $accessKey;
	public $secretKey;
	public $url;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('bucket, accessKey, secretKey, url', 'required'),
			array('url', 'url', 'defaultScheme' => 'http'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'bucket'=>'Bucket',
			'accessKey'=>'AccessKey',
			'secretKey'=>'SecretKey',
			'url'=>'Url',
		);
	}

}
