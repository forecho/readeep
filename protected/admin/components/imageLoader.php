<?php

/**
* 图片库
*/
class imageLoader extends CWidget
{
 	public $crumbs = array();
    public $delimiter = ' / ';

    public function run() {
    	$array = array(
    			'base_resp' => array('ret' => 0, 'err_msg' => 'ok'),
    			'page_info' => array(
    				'type' => 2,
    				'file_cnt' => array('img_cnt' => '138'),
    				'file_item' => array(
    				    array(
                            'file_id' => '',
                            'name' => '',
                            'type' => '',
                            'size' => '',
                            'update_time' => '',
                            'cdn_url' => '',
                        ),
                    )
    			),
                'file_group_list' => array(
                    'file_group' => array(
                        'id' =>  1,
                        'name' => "未分组",
                        'files' => '',
                        'count' => 138
                    )
                )
    		);
        $this->render('imageLoader');
    }

}

