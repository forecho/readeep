<?php

/**
 * This is the model class for mail Form.
 *
 * The followings are the available columns in MailForm':
 * @property integer $from      mail sender
 * @property string $to         mail Recipient
 * @property string $subject    mail subject
 * @property integer $body      mail content

 */
class MailForm extends CFormModel
{

    public $from;
    public $to;
    public $subject;
    public $body;

    public function rules()
    {
        return array(
            array('from, to, subject, body', 'required'),
            array('from, to, subject, body ', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'from' => '送信人',
            'to' => '收信人',
            'subject' => '标题',
            'body' => '邮件内容',
        );
    }

    /*
     * @param string $objMail MailForm
     * @param boolen if send mail is ok and then return ture,if not,return false
     * @author 331942828@qq.com
     * @date:2013-12-12 10:00
     */

    public static function sendMail(MailForm $objMail, $arrKey, $fromNickName='no-reply',$toNickName='no-reply',$type = '')
    {
        if (is_array($arrKey))
        {
            foreach ($arrKey as $key => $value)
            {
                $find = '{$' . $key . '}';
                $body = str_replace($find, $value, $body);
            }
        }
        $message = new YiiMailMessage();
        $message->setFrom(array($objMail->from => $fromNickName));
        $message->setTo(array($objMail->to => $toNickName));
        $message->setSubject($objMail->subject);
        $message->setBody($objMail->body, $type);
        $sendmail = Yii::app()->mail->send($message);
        if ($sendmail)
        {
            return TRUE;
        } else
        {
            return FALSE;
        }
    }

}

?>  