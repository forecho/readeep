
WDueditor is a widget extension for Yii framework. This extension is a wrapper UEditor ([https://github.com/campaign/ueditor][1]).

## Requirements ##

 - Yii 1.1 or above (tested on 1.1.10)

## Usage ##

 - Extract the downloaded file to your application extensions directory
 - Use it at your view

## Examples ##

完整示例
-----

$this->widget('ext.wdueditor.WDueditor',array(
        'model' => $model,
        'attribute' => 'content',
       
)); 

UEditor简单功能  自定义Toolbar
------------------

$this->widget('ext.wdueditor.WDueditor',array(
        'model' => $model,
        'attribute' => 'content',
        'toolbars' =>array(
            'FullScreen','Source','Undo', 'Redo','Bold'
        ),
)); 


## Resources ##

 -  UEditor URL:
 - [https://github.com/campaign/ueditor][1]
 - Demo [http://ueditor.baidu.com][2]
 - Yii extension URL:
 - [http://www.yiiframework.com/extension/wdueditor/][1]
