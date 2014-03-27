<?php

/**
 * QiniuForm class.
 * QiniuForm is the data structure for keeping
 * qiniu form data. It is used by the 'qiniu' action of 'OptionsController'.
 */
class QiniuForm extends CFormModel
{
	public $bucket;
	public $accessKey;
	public $secretKey;
	public $url;

	/**
	 * Declares the validation rules.
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
