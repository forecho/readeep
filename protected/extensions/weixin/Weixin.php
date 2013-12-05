<?php
 
/**
 * WeixinCallback 
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author davidhhuan@126.com
 * {@link <a href="http://www.sharefamily.net" target="_blank">http://www.sharefamily.net</a>}
 */
class Weixin
{
    //$_GET参数
    public $signature;
    public $timestamp;
    public $nonce;
    public $echostr;
    //
    public $token;
    public $debug = false;
    public $msg = array();
    public $setFlag = false;
 
    /**
     * __construct 
     * 
     * @param mixed $params 
     * @access public
     * @return void
     */
    public function __construct($params = array())
    {
        foreach ($params as $k1 => $v1)
        {
            if (property_exists($this, $k1))
            {
                $this->$k1 = $v1;
            }
        }
    }
     
    /**
     * valid 
     * 
     * @access public
     * @return void
     */
    public function valid()
    {
        //valid signature , option
        if($this->checkSignature()){
            echo $this->echostr;
            Yii::app()->end();
        }
    }
 
    /**
     * 获得用户发过来的消息（消息内容和消息类型  ） 
     * 
     * @access public
     * @return void
     */
    public function init()
    {
        $postStr = empty($GLOBALS["HTTP_RAW_POST_DATA"]) ? '' : $GLOBALS["HTTP_RAW_POST_DATA"];
        if ($this->debug) 
        {
            $this->log($postStr);
        }
        if (!empty($postStr)) {
            $this->msg = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        }
    }
 
    /**
     * makeEvent 
     * 
     * @access public
     * @return void
     */
    public function makeEvent()
    {
         
    }
 
    /**
     * 回复文本消息 
     * 
     * @param string $text 
     * @access public
     * @return void
     */
    public function makeText($text='')
    {
        $createTime = time();
        $funcFlag = $this->setFlag ? 1 : 0;
        $textTpl = "<xml>
            <ToUserName><![CDATA[{$this->msg->FromUserName}]]></ToUserName>
            <FromUserName><![CDATA[{$this->msg->ToUserName}]]></FromUserName>
            <CreateTime>{$createTime}</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>%s</FuncFlag>
            </xml>";
        return sprintf($textTpl,$text,$funcFlag);
    }
     
    /**
     * 根据数组参数回复图文消息 
     * 
     * @param array $newsData 
     * @access public
     * @return void
     */
    public function makeNews($newsData=array())
    {
        $createTime = time();
        $funcFlag = $this->setFlag ? 1 : 0;
        $newTplHeader = "<xml>
            <ToUserName><![CDATA[{$this->msg->FromUserName}]]></ToUserName>
            <FromUserName><![CDATA[{$this->msg->ToUserName}]]></FromUserName>
            <CreateTime>{$createTime}</CreateTime>
            <MsgType><![CDATA[news]]></MsgType>
            <ArticleCount>%s</ArticleCount><Articles>";
        $newTplItem = "<item>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s]]></Url>
            </item>";
        $newTplFoot = "</Articles>
            <FuncFlag>%s</FuncFlag>
            </xml>";
        $content = '';
        $itemsCount = count($newsData['items']);
        //微信公众平台图文回复的消息一次最多10条
        $itemsCount = $itemsCount < 10 ? $itemsCount : 10;
        if ($itemsCount) {
            foreach ($newsData['items'] as $key => $item) {
                if ($key<=9) {
                    $content .= sprintf($newTplItem,$item['title'],$item['description'],$item['picurl'],$item['url']);
                }
            }
        }
        $header = sprintf($newTplHeader,$itemsCount);
        $footer = sprintf($newTplFoot,$funcFlag);
        return $header . $content . $footer;
    }
 
    /**
     * reply 
     * 
     * @param mixed $data 
     * @access public
     * @return void
     */
    public function reply($data)
    {
        if ($this->debug) 
        {
            $this->log($data);
        }
        echo $data;
    }
 
    /**
     * checkSignature 
     * 
     * @access private
     * @return void
     */
    private function checkSignature()
    {
        $tmpArr = array($this->token, $this->timestamp, $this->nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
         
        if( $tmpStr == $this->signature ){
            return true;
        }else{
            return false;
        }
    }
 
    /**
     * log 
     * 
     * @access private
     * @return void
     */
    private function log($log)
    {
        if ($this->debug)
        {
            file_put_contents(Yii::getPathOfAlias('application').'/runtime/weixin_log.txt', var_export($log, true)."\n\r", FILE_APPEND);
        }
    }
}