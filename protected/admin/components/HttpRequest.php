<?php
/*
* @Author: caicai
* @Date:   2014-01-19 21:03:58
* @Email:  email@example.com
* @Last modified by:   forecho
* @Last modified time: 2014-01-19 22:40:38
*/

class HttpRequest extends CHttpRequest
{

   public $dont_validate_csrf_routes = array();

   public function validateCsrfToken($event) {
        if( !in_array(Yii::app()->request->url, $this->dont_validate_csrf_routes) ) {
            parent::validateCsrfToken($event);
        }
    }
}