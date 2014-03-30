<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailController
 *
 * @author Administrator
 */
class MailController extends Controller
{

    //put your code here
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'delete', 'update', 'send'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    function actionTemplate()
    {
        if (isset($_POST['MailTemplates']))
        {
            $templateModel = $this->loadModel($_POST['MailTemplates']['template_id']);
            if ($templateModel->template_subject !== $_POST['MailTemplates']['template_subject'])
            {
                $isFind = MailTemplates::model()->findAllByAttributes(array('template_subject' => $_POST['MailTemplates']['template_subject']));
                if ($isFind)
                {
                    $strError = "改标题已经存在";
                    $this->ajaxDwz(array('status' => 0, 'msg' => $strError));
                } else
                {
                    $templateModel->attributes = $_POST['MailTemplates'];
                    if ($templateModel->save())
                    {
                        $this->ajaxDwz(array('status' => 1));
                        //$this->redirect(array('view','id'=>$model->article_id));
                    } else
                    {
                        $arrErrors = $templateModel->errors;
                        $strError = "";
                        foreach ($arrErrors as $key => $value)
                        {
                            $strError.=$key . ':' . $value[0] . "/\n";
                        }
                    }
                    $this->ajaxDwz(array('status' => 0, 'msg' => $strError));
                }
            } else
            {
                $templateModel->attributes = $_POST['MailTemplates'];
                {
                    if ($templateModel->save())
                    {
                        $this->ajaxDwz(array('status' => 1));
                        //$this->redirect(array('view','id'=>$model->article_id));
                    } else
                    {
                        $arrErrors = $templateModel->errors;
                        $strError = "";
                        foreach ($arrErrors as $key => $value)
                        {
                            $strError.=$key . ':' . $value[0] . "/\n";
                        }
                    }
                    $this->ajaxDwz(array('status' => 0, 'msg' => $strError));
                }
            }
        }
        $templateModel = MailTemplates::model()->findAll();
        foreach ($templateModel as $key => $value)
        {
            $arrTemplate[$value->template_id] = $value->template_subject;
        }
        $defaultId = 1;
        $firstModel = $this->loadModel($defaultId);

        $this->render('template', array('arrTemplate' => $arrTemplate, 'firstModel' => $firstModel));
    }

    public function actionSettings()
    {

        $mailSettings = ShopConfig::get_settings(array(5));
        if ($_POST)
        {
            foreach ($_POST['mail'] as $key => $value)
            {

                $id = intval($key);
                $model = ShopConfig::model()->findByAttributes(array('id' => $id));
                $model->value = $value;
                if (!$model->save())
                {
                    $this->ajaxDwz(array('status' => 0));
                }
            }
            $this->ajaxDwz(array('status' => 1));
        }
        $this->renderPartial('settings', array('mailSettings' => $mailSettings[5]));
    }

    public function actionCreate()
    {
        $model = new MailTemplates();
        $this->render('create', array('model' => $model));
    }

    public function actionGroupSend()
    {

        $rel = UserGroup::model()->findAll();
        $model = new MailForm();
        if ($rel)
        {
            foreach ($rel as $key => $value)
            {
                $groupList[$value['user_group_id']] = $value['group_name'];
            }
        }
        $userrank = UserRank::model()->findAll();
        if (!empty($userrank))
        {
            $rank_list[] = '会员等级';
            foreach ($userrank as $key => $value)
            {
                $rank_list[$value->rank_id] = $value->rank_name;
            }
        }

        $groupList = UserGroup::model()->findAll();
        if ($groupList)
        {
            $arrGroup[] = '请选择用户分组';
            foreach ($groupList as $key => $value)
            {
                $arrGroup[$value['user_group_id']] = $value['group_name'];
            }
        }
        if ($_POST)
        {
            if (isset($_POST['user_list']))
            {
                $_POST['user_list'] = array_flip(array_flip($_POST['user_list']));

                $model->from = 'no-reply@enlife.com';
                $model->subject = $_POST['subject'];
                $model->body = $_POST['content'];
                print_r($_POST);
                $strUser = implode(',', $_POST['user_list']);
                $sql = 'select email,user_name from hdx_users where user_id in(' . $strUser . ')';
                $rel = Yii::app()->db->createCommand($sql)->queryAll();
                if ($rel)
                {
                    foreach ($rel as $key => $value)
                    {
                        $email[$value['user_name']] = $value['email'];
                    }
                }
                foreach ($email as $key => $value)
                {

                    if (Fun::is_email($value))
                    {
                        $model->to = $value;

                        if ($model->validate())
                        {
                            $message = new YiiMailMessage();
                            $message->setFrom(array($model->from => '送信人'));
                            $message->setTo(array($model->to => '收信人'));
                            $message->setSubject($model->subject);
                            $message->setBody($model->body);
                            $sendmail = Yii::app()->mail->send($message);
                            if ($sendmail)
                            {
                                
                            } else
                            {
                                if (!isset($strError))
                                {
                                    $strError = '';
                                }
                                $strError .= $key . '---';
                                echo 'bbb';
                            }
                        } else
                        {
                            if (!isset($strError))
                            {
                                $strError = '';
                            }
                            $strError .= $key . '---';
                        }
                    } else
                    {

                        if (!isset($strError))
                        {
                            $strError = '';
                        }
                        $strError .= $key . '---';
                    }
                }exit;
                if (!isset($strError))
                {
                    $this->ajaxDwz(array('status' => 1, 'msg' => '邮件全部发送成功'));
                } else
                {
                    $this->ajaxDwz(array('status' => 0, 'msg' => $strError . '的邮件发送失败'));
                }
            } else
            {
                $this->ajaxDwz(array('status' => 0, 'msg' => '请选择您要群发的用户'));
            }
        }

        $this->render('groupsend', array('groupList' => $groupList, 'rankList' => $rank_list, 'rank_model' => new UserRank(), 'arrGroup' => $arrGroup, 'model' => $model));
    }

    public function actionSend()
    {
        // phpinfo();exit;
        $sendMail = new YiiMail();
        $model = new MailForm();
        if (isset($_POST["MailForm"]))
        {
            $model->attributes = $_POST['MailForm'];

            if ($model->validate())
            {
                $message = new YiiMailMessage();

                $message->setFrom(array($model->from => '送信人'));
                $message->setTo(array($model->to => '收信人'));
                $message->setSubject($model->subject);
                $message->setBody($model->body);
                $sendmail = Yii::app()->mail->send($message);

                if ($sendmail)
                {
                    Yii::app()->user->setFlash("success", "Emails sent: OK \n");
                    $this->refresh();
                } else
                {
                    Yii::app()->user->setFlash("failed", "Emails sent: NG \n");
                }
            }
        }
        $this->render('send', array('model' => $model));
    }

    public function actionAjaxTemplate()
    {
        $templateId = $_POST['template_id'];
        $templateModel = MailTemplates::model()->findByPk($templateId);
        if ($templateModel === null)
            $arrTemplateInfo = array();
        else
        {
            $arrTemplateInfo['is_html'] = $templateModel->is_html;
            $arrTemplateInfo['template_content'] = $templateModel->template_content;
            $arrTemplateInfo['template_subject'] = $templateModel->template_subject;
        }
        echo json_encode($arrTemplateInfo);


//                    return $model;
    }

    public function actionAjaxSearchUsr()
    {
        $groupId = !empty($_GET['group_id']) ? ($_GET['group_id']) : '';
        $rank = !empty($_GET['rank_id']) ? $_GET['rank_id'] : '';
        $user_name = !empty($_GET['user_name']) ? $_GET['user_name'] : '';
        $condtion = 1;
        $groupId && $condtion.=" and hurg.user_group_id={$groupId}";
        $rank && $condtion.=" and hu.user_rank={$rank}";
        $user_name & $condtion.=" and hu.user_name  LIKE '%{$user_name}%'";
        $sql = "select hu.user_id,hu.user_name from hdx_users as hu
                              left join hdx_user_relation_group as hurg on hu.user_id=hurg.user_id
                              left join hdx_user_group as hug on hurg.user_group_id=hug.user_group_id
                              where $condtion";
        $userList = Yii::app()->db->createCommand($sql)->queryAll();
        $option = '';
        foreach ($userList as $value)
        {
            $option .= "<option value='{$value['user_id']}'>{$value['user_name']}</option>";
        }
        echo $option;
        exit;
    }

    public function actionAjaxChangeTemplate()
    {
        $templateId = $_POST['template_id'];
        $templateModel = MailTemplates::model()->findByPk($templateId);
        if ($templateModel === null)
            $templateContent = array();
        else
        {

            if ($_POST['is_html'])
            {

                $templateContent = htmlspecialchars($templateModel->template_content);
            } else
            {
                $templateContent = stripslashes($templateModel->template_content);
                $templateContent = html_entity_decode($templateContent);
            }
        }
        echo json_encode($templateContent);
    }

    public function loadModel($id)
    {
        $model = MailTemplates::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}

?>
