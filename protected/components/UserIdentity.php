<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	 
	public function authenticate()
	{
	 
	    //用户名转换为小写
	    $username=strtolower($this->username);
	 
	    //$username作为条件进入数据库查询匹配
	    $user=User::model()->find('LOWER(username)=?',array($username));
	 
	    //用户名不存在，报错
	    if ($user===null) {
	        $this-> errorCode=self::ERROR_USERNAME_INVALID;
	    }else{
	 
	        //调用一个函数，匹配相应的密码
	        if (!$user->validatePassword($this->password)) {
	            $this->errorCode=self::ERROR_PASSWORD_INVALID;
	        }else {
	 
	            //匹配成功，赋值
	            $this->_id = $user->id;
	            $this->username = $user->username;
	            $this->errorCode=self::ERROR_NONE;
	        }
	    }
	        return $this->errorCode === self::ERROR_NONE;
	}
	 
	public function getId() {
	    return $this->_id;
	}
}