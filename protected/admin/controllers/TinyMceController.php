<?php
/*
* @Author: caicai
* @Date:   2014-01-11 15:31:01
* @Email:  email@example.com
* @Last modified by:   caicai
* @Last modified time: 2014-01-11 17:13:50
*/
class TinyMceController extends CController
{
     public function actions()
     {
          return array(
              'compressor' => array(
                    'class' => 'ext.yii-tinymce.TinyMceCompressorAction',
                    'settings' => array(
	                       	'compress' => true,
	                        'disk_cache' => true,
	                        "languages" => "zh_CN",
                        ),
                    ),
                    'spellchecker' => array(
                        'class' => 'ext.yii-tinymce.TinyMceSpellcheckerAction',
               ),
          );
      }
}