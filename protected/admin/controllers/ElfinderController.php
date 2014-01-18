<?php
// controller to host connector action
class ElfinderController extends CController
{
    public function actions()
    {
        return array(
            'connector' => array(
                'class' => 'ext.yii-elfinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot') . '/uploads/'.Yii::app()->user->id.'/',
                    'URL' => Yii::app()->baseUrl . '/uploads/'.Yii::app()->user->id.'/',
                    'rootAlias' => 'Home',
                    // 'mimeDetect' => 'none'
                )
            ),
        );
    }
}