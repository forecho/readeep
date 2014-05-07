<?php
class CloudWidget extends CWidget{

    public function init(){}

    public function run(){
        $model=Tagcloud::model()->findAll(array("order"=>"counter desc","limit"=>"20"));
        $this->render("tagcloud",array("model"=>$model));
    }
}