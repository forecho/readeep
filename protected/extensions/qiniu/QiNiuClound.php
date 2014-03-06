<?php

        require_once("qiniu/io.php");
        require_once("qiniu/rs.php");
        require_once("qiniu/fop.php");

        class QiNiuClound extends CApplicationComponent
        {

                public $bucket;
                public $key;
                public $accessKey;
                public $secretKey;

                public function __construct($bucket = 'phpers', $accessKey = 'Nvn2WQOsP8jUF8b7rXCaj9Td1V8yUrAZxZoL2X6c', $secretKey = 'WI6vG6ATtmvrMBVM9lkpAML9ulTyLGJEWIetzuz4')
                {
                        $this->bucket    = $bucket;
                        $this->accessKey = $accessKey;
                        $this->secretKey = $secretKey;
                }

                //查看文件信息 require_once("qiniu/rs.php");
                public function showfileInfomation()
                {
                        Qiniu_SetKeys($this->accessKey, $this->secretKey);
                        $client = new Qiniu_MacHttpClient(null);
                        list($ret, $err) = Qiniu_RS_Stat($client, $this->bucket, $this->key);
                        echo "Qiniu_RS_Stat result: \n";
                        if ($err !== null)
                        {  
                                var_dump($err);
                        }
                        else
                        {
                                var_dump($ret);
                        }
                }

                //复制单个文件 require_once("qiniu/rs.php");
                public function copySingleFile($key1)
                {
                        Qiniu_SetKeys($this->accessKey, $this->secretKey);
                        $client = new Qiniu_MacHttpClient(null);
                        $err    = Qiniu_RS_Copy($client, $this->bucket, $this->key, $this->bucket, $key1);
                        echo "====> Qiniu_RS_Copy result: \n";
                        if ($err !== null)
                        {
                                var_dump($err);
                        }
                        else
                        {
//                                echo "Success!";
                                return TRUE;
                        }
                }

                //移动单个文件  require_once("qiniu/rs.php");
                public function moveSingeFile($key1)
                {
                        Qiniu_SetKeys($this->accessKey, $this->secretKey);
                        $client = new Qiniu_MacHttpClient(null);
                        $err    = Qiniu_RS_Move($client, $this->bucket, $this->key, $this->bucket, $key1);
                        echo "====> Qiniu_RS_Move result: \n";
                        if ($err !== null)
                        {
                                var_dump($err);
                        }
                        else
                        {
//                                echo "Success!";
                                return TRUE;
                        }
                }

                //删除单个文件 require_once("qiniu/rs.php");
                public function deleteSingeFile($key)
                {
                        Qiniu_SetKeys($this->accessKey, $this->secretKey);
                        $client = new Qiniu_MacHttpClient(null);
                        $err    = Qiniu_RS_Delete($client, $this->bucket, $key);
                        echo "====> Qiniu_RS_Delete result: \n";
                        if ($err !== null)
                        {
                                var_dump($err);
                        }
                        else
                        {
                                return TRUE;
//                                echo "Success!";
                        }
                }

                //得到上传凭证  require_once("qiniu/rs.php");
                public function getUpToken()
                {
                        Qiniu_SetKeys($this->accessKey, $this->secretKey);
                        $putPolicy = new Qiniu_RS_PutPolicy($this->bucket);
                        $upToken   = $putPolicy->Token(null);
                        return $upToken;
                }

                //上传字符串 //require_once("qiniu/io.php");require_once("qiniu/rs.php");
                public function upSting($str)
                {
                        $upToken = $this->getUpToken();
                        list($ret, $err) = Qiniu_Put($upToken, $this->key, $str, null);
                        echo "====> Qiniu_Put result: \n";
                        if ($err !== null)
                        {
                                var_dump($err);
                        }
                        else
                        {
//                                var_dump($ret);
                                return true;
                        }
                }

//上传本地文件 require_once("qiniu/io.php"); require_once("qiniu/rs.php");
                public function upLocalFile()
                {
                        $upToken         = $this->getUpToken();
                        $putExtra        = new Qiniu_PutExtra();
                        $putExtra->Crc32 = 1;
                        list($ret, $err) = Qiniu_PutFile($upToken, $this->key, __file__, $putExtra);
                        echo "====> Qiniu_PutFile result: \n";
                        if ($err !== null)
                        {
                                var_dump($err);
                        }
                        else
                        {
                                var_dump($ret);
                               // return true;
                        }
                }

                //得到资源的下载地址
                public function getLoadUrl($domain, $key)
                {
                        return Qiniu_RS_MakeBaseUrl($domain, $key);
                }

                //查看图像属性require_once("qiniu/rs.php");  require_once("qiniu/fop.php");
                public function getImgAttr($domain)
                {
                        Qiniu_SetKeys($this->accessKey, $this->secretKey);
                        //生成baseUrl
                        $baseUrl = Qiniu_RS_MakeBaseUrl($domain, $this->key);

                        //生成fopUrl
                        $imgInfo           = new Qiniu_ImageInfo;
                        $imgInfoUrl        = $imgInfo->MakeRequest($baseUrl);
                        echo $imgInfoUrl;
//                        对fopUrl 进行签名，生成privateUrl。 公有bucket 此步可以省去。
                        $getPolicy         = new Qiniu_RS_GetPolicy();
                        $imgInfoPrivateUrl = $getPolicy->MakeRequest($imgInfoUrl, null);
                        echo "====> imageInfo privateUrl: \n";
                        echo $imgInfoPrivateUrl . "\n";
                }

                //查看图片EXIF信息require_once("qiniu/rs.php"); require_once("qiniu/fop.php");
                public function getImgExif($domain)
                {
                        Qiniu_SetKeys($accessKey, $secretKey);
//生成baseUrl
                        $baseUrl = Qiniu_RS_MakeBaseUrl($domain, $key);

//生成fopUrl
                        $imgExif    = new Qiniu_Exif;
                        $imgExifUrl = $imgExif->MakeRequest($baseUrl);

//对fopUrl 进行签名，生成privateUrl。 公有bucket 此步可以省去。
                        $getPolicy         = new Qiniu_RS_GetPolicy();
                        $imgExifPrivateUrl = $getPolicy->MakeRequest($imgExifUrl, null);
                        echo "====> imageView privateUrl: \n";
                        echo $imgExifPrivateUrl . "\n";
                }

        }

?>