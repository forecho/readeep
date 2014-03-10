<?php
/**
 * WDueditor for Yii extensions
 * @ueditorSite http://ueditor.baidu.com
 * @ueditor  https://github.com/campaign/ueditor   
 * @author WindsDeng <winds@dlf5.com> QQ:620088997 WindsDeng's Blog http://www.dlf5.com
 * @license BSD许可证
 */

class WDueditor extends CInputWidget {
    
    /**
	 * Editor language
	 * Supports: zh-cn  or en
	 */
	public $language = 'zh-cn';
    
    /**
	 * Editor toolbars
	 * Supports: 
	 */
	public $toolbars = '';
    
    /**
	 * Html options that will be assigned to the text area
	 */
	public $htmlOptions = array();
    
	/**
	 * Editor options that will be passed to the editor
	 */
	public $editorOptions = array();
    
	/**
	 * Debug mode
	 * Used to publish full js file instead of min version
	 */
    public $debug = false;
    
    /**
	 * Editor width
	 */
	public $width = '100%';
    
	/**
	 * Editor height
	 */
	public $height = '400px';
    
    /**
	 * Editor theme
     * Supports: default
	 */
	public $theme = 'default';
    
    
    /**
	 * Display editor
	 */
    public function run() {
	
		// Resolve name and id
		list($name, $id) = $this->resolveNameID();

		// Get assets dir
        $baseDir = dirname(__FILE__);
        $assets = Yii::app()->getAssetManager()->publish($baseDir.DIRECTORY_SEPARATOR.'ueditor1_2_5');

		// Publish required assets
		$cs = Yii::app()->getClientScript();
		
		$jsFile = $this->debug ? 'editor_all.js' : 'editor_all_min.js';
		$cs->registerScriptFile($assets.'/' . $jsFile);
		$cs->registerScriptFile($assets.'/editor_config.js');

        $this->htmlOptions['id'] = $id;

        if (!array_key_exists('style', $this->htmlOptions)) {
            $this->htmlOptions['style'] = "width:{$this->width};";
        }
        
        if($this->toolbars){
            $this->editorOptions['toolbars'][] = $this->toolbars;
        }

		$options = CJSON::encode(array_merge(array('theme'=>$this->theme, 'lang' => $this->language,'UEDITOR_HOME_URL'=>"$assets/",'initialFrameWidth'=>$this->width,'initialFrameHeight'=>$this->height),$this->editorOptions));

        $js =<<<EOP
UE.getEditor('$id',$options);
EOP;
		// Register js code
		$cs->registerScript('Yii.'.get_class($this).'#'.$id, $js, CClientScript::POS_READY);
	
		// Do we have a model
		if($this->hasModel()) {
            $html = CHtml::activeTextArea($this->model, $this->attribute, $this->htmlOptions);
        } else {
            $html = CHtml::textArea($name, $this->value, $this->htmlOptions);
        }

		echo $html;
    }
    
}


