<?php

        class QiNiuController extends Controller
        {

                public function actions()
                {
                        return array(
                            // captcha action renders the CAPTCHA image displayed on the contact page
                            'captcha' => array(
                                'class'     => 'CCaptchaAction',
                                'backColor' => 0xFFFFFF,
                            ),
                            // page action renders "static" pages stored under 'protected/views/site/pages'
                            // They can be accessed via: index.php?r=site/page&view=FileName
                            'page'    => array(
                                'class' => 'CViewAction',
                            ),
                        );
                }

                public function actionIndex()
                {
                        $obj = new QiNiuClound();
                        $this->render('index', array('token' => $obj->getUpToken()));
                }

        }