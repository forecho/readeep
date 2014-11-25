<?php

/**
* 图片库
*/
class imageLoader extends CWidget
{
 	public $crumbs = array();
    public $delimiter = ' / ';

    public function run() {
        $this->render('imageLoader');
    }

}

