<?php
/*
* @Author: caicai
* @Date:   2014-01-19 21:03:58
* @Email:  email@example.com
* @Last modified by:   forecho
* @Last modified time: 2014-01-19 22:43:26
*/

class HttpRequest extends CHttpRequest
{
    public function validateCsrfToken($event)
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? $_SERVER["CONTENT_TYPE"] : null;
        if ($contentType !== 'application/json')
            parent::validateCsrfToken($event);
    }
}