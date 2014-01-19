<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.



$backend=dirname(dirname(__FILE__));
$frontend=dirname($backend);
Yii::setPathOfAlias('backend', $backend);

$frontendArray=require($frontend.'/config/main.php');
require($frontend.'/config/define.php');

unset($frontendArray['components']['urlManager']);//不隐藏后台URL中的admin.php
//unset($frontendArray['modules']);
//unset($frontendArray['components']['clientScript']);

$backendArray=array(
    'name'=>'网站后台管理系统',
    'basePath' => $frontend,
    'controllerPath' => $backend.'/controllers',
    'viewPath' => $backend.'/views',
    'theme' => 'classic',
    'runtimePath' => $backend.'/runtime',
	// 'defaultController'=>'options/welcome',
    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.extensions.nestedset.*',
        'backend.models.*',
        'backend.components.*', //这里的先后顺序一定要搞清
    ),
    'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'request' => array(
            'class' => 'application.admin.components.HttpRequest',
            'enableCsrfValidation' => true,
        ),

		// 'log'=>array(
		// 	'class'=>'CLogRouter',
		// 	'routes'=>array(
		// 		array(
		// 			'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
		// 			'ipFilters'=>array('*'),
		// 		),
		// 	),
		// ),
    ),

    // main is the default layout
    //'layout'=>'main',
    // alternate layoutPath
    'layoutPath'=>dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR,
);
if(!function_exists('w3_array_union_recursive'))
{
    /**
     * This function does similar work to $array1+$array2,
     * except that this union is applied recursively.
     * @param array $array1 - more important array
     * @param array $array2 - values of this array get overwritten
     * @return array
     */
    function w3_array_union_recursive($array1,$array2)
    {
        $retval=$array1+$array2;
        foreach($array1 as $key=>$value)
        {
            if(is_array($array1[$key]) && is_array($array2[$key]))
                $retval[$key]=w3_array_union_recursive($array1[$key],$array2[$key]);
        }
        return $retval;
    }
}

return w3_array_union_recursive($backendArray,$frontendArray);