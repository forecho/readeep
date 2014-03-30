# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.11)
# Database: readeep
# Generation Time: 2014-03-30 09:22:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名-微信名',
  `email` varchar(50) NOT NULL COMMENT '登录邮箱',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `login_ip` varchar(20) NOT NULL COMMENT '登录IP',
  `login_time` int(10) NOT NULL COMMENT '登录时间',
  `login_count` int(10) DEFAULT '0' COMMENT '登录次数',
  `create_ip` varchar(20) NOT NULL COMMENT '创建IP',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '1为正常 0为禁用',
  `invite_code` varchar(10) NOT NULL COMMENT '邀请码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表';

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `login_ip`, `login_time`, `login_count`, `create_ip`, `create_time`, `status`, `invite_code`)
VALUES
	(1,'admin','caizhenghai@gmail.com','21232f297a57a5a743894a0e4a801fc3','',0,NULL,'',0,1,'');

/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Config
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Config`;

CREATE TABLE `Config` (
  `key` varchar(100) COLLATE utf8_bin NOT NULL,
  `value` text COLLATE utf8_bin,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

LOCK TABLES `Config` WRITE;
/*!40000 ALTER TABLE `Config` DISABLE KEYS */;

INSERT INTO `Config` (`key`, `value`)
VALUES
	(X'71696E6975',X'613A343A7B733A363A226275636B6574223B733A373A2272656164656570223B733A393A226163636573734B6579223B733A34303A226E66724D4C574A6E4E754743645651624A4845655254494F68324257453467454A424D37574F4867223B733A393A227365637265744B6579223B733A34303A2251746158536C79584D4C51326E4638324E7A6862396E516946556F734F487533694F6C564575386D223B733A333A2275726C223B733A32363A22687474703A2F2F726561646565702E71696E6975646E2E636F6D223B7D');

/*!40000 ALTER TABLE `Config` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table invite_code
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invite_code`;

CREATE TABLE `invite_code` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0为已经被用过 1为可以',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邀请码表';



# Dump of table mail_templates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mail_templates`;

CREATE TABLE `mail_templates` (
  `template_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `template_code` varchar(30) NOT NULL DEFAULT '',
  `is_html` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `template_subject` varchar(200) NOT NULL DEFAULT '',
  `template_content` text NOT NULL,
  `last_modify` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`template_id`),
  UNIQUE KEY `template_code` (`template_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `mail_templates` WRITE;
/*!40000 ALTER TABLE `mail_templates` DISABLE KEYS */;

INSERT INTO `mail_templates` (`template_id`, `template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`)
VALUES
	(1,'send_password',1,'密码找回','<div style=\"width:662px;margin:auto; font-size:13px; color:#AEAEAE; line-height:30px; padding-left:16px; padding-top:50px;\">为了您能正常收到来自好东西的信息和会员邮件，请将<span style=\"color:#000; font-family:Arial, Helvetica, sans-serif;\"><a style=\"text-decoration: none;color:#000; cursor: default;\">no-reply@enlife.com</a></span>填加进您的通讯录</div><div style=\"width:618px; border: solid 1px #80BB2B; padding:8px 30px 20px 30px; margin:auto;\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">  <tbody><tr>    <td align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo.jpg\" width=\"150\" height=\"76\" alt=\"\" /></a></td>    <td align=\"right\" valign=\"middle\"><a href=\"http://weibo.com/u/3424175994\"><img src=\"http://hdx.lanyes.com/mailimg/mail_concerns.jpg\" width=\"235\" height=\"76\" alt=\"\" /></a></td>  </tr>  <tr>    <td colspan=\"2\" align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_ban.jpg\" width=\"618\" height=\"68\" alt=\"\" /></a></td>    </tr></tbody></table><div style=\" font-size:15px; font-weight:bold; color:#666; line-height:30px; margin-top:40px; margin-bottom:16px;\">亲爱的{$user_name}:您好！</div><div style=\"line-height:24px; font-size:13px; color:#949494;\">您正在通过邮箱找回密码，密码为{$password},请及时登录修改密码。<br />注意：此操作可能会修改您的密码、登录邮箱或绑定手机。如非本人操作，请及时登录并修改密码以保证账户安全。（工作人员不会向您索取此密码，请勿泄漏！）<br /></div><div style=\"line-height:24px; font-size:13px; color:#707070; margin-top:20px;\">本邮件由好东西系统自动发出，请勿直接回复！<br />如果您有任何疑问或建议，请联系我们。<br />“好东西”电子商城，集第三方监管体系与移动购物为一体，开启了全新的购物体验。您只需要免费下载，安全食品、餐饮酒店、放心商品马上一网打尽！<br />客服QQ：2900600475 /2902020658 /2900385974 /2898720036<br />客服热线：400 066 3325</div><div style=\"height:30px; text-align:center;\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo_b.jpg\" width=\"106\" height=\"30\" alt=\"\" /></a></div><div style=\"font-size:13px; color:#000;text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:22px;\">Copyright @ 2013 enlife.com 版权所有</div></div>',1194824789),
	(2,'order_confirm',0,'订单确认通知','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<title>好东西电子商城</title>\n</head>\n\n<body>\n<div style=\"width:662px;margin:auto; font-size:13px; color:#AEAEAE; line-height:30px; padding-left:16px; padding-top:50px;\">为了您能正常收到来自好东西的信息和会员邮件，请将<span style=\"color:#000; font-family:Arial, Helvetica, sans-serif;\"><a style=\"text-decoration: none;color:#000; cursor: default;\">no-reply@enlife.com</a></span>填加进您的通讯录</div>\n<div style=\"width:618px; border: solid 1px #80BB2B; padding:8px 30px 20px 30px; margin:auto;\">\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr>\n    <td align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo.jpg\" width=\"150\" height=\"76\" /></a></td>\n    <td align=\"right\" valign=\"middle\"><a href=\"http://weibo.com/u/3424175994\"><img src=\"http://hdx.lanyes.com/mailimg/mail_concerns.jpg\" width=\"235\" height=\"76\" /></a></td>\n  </tr>\n  <tr>\n    <td colspan=\"2\" align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_ban.jpg\" width=\"618\" height=\"68\" /></a></td>\n    </tr>\n</table>\n    <div style=\" font-size:15px; font-weight:bold; color:#666; line-height:30px; margin-top:40px; margin-bottom:16px;\">亲爱的 <?php echo $user->user_name  ?>:您好！ \n    </div><br /><div style=\"line-height:24px; font-size:13px; color:#949494;\">我们已经收到您于 <?php echo  date(\'Y-m-d\',$order->add_time) ?> 提交的订单，该订单编号为：<?php echo $order->order_sn  ?> 请记住这个编号以便日后的查询。 <br /><br /><?php echo  $shop_name ?><br /><br /><?php echo  $send_date ?></div><br />\n<div style=\"line-height:24px; font-size:13px; color:#707070; margin-top:20px;\">本邮件由好东西系统自动发出，请勿直接回复！<br />\n如果您有任何疑问或建议，请联系我们。<br />\n“好东西”电子商城，集第三方监管体系与移动购物为一体，开启了全新的购物体验。您只需要免费下载，安全食品、餐饮酒店、放心商品马上一网打尽！<br />\n客服QQ：2900600475 /2902020658 /2900385974 /2898720036<br />\n客服热线：400 066 3325\n</div>\n<div style=\"height:30px; text-align:center;\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo_b.jpg\" width=\"106\" height=\"30\" /></a></div>\n<div style=\"font-size:13px; color:#000;text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:22px;\">Copyright @ 2013 enlife.com 版权所有</div>\n</div>\n</body>\n</html>\n</body>\n</html>',1158226370),
	(3,'deliver_notice',1,'发货通知','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<title>好东西电子商城</title>\n</head>\n\n<body>\n<!--\n\n-->\n<div style=\"width:662px;margin:auto; font-size:13px; color:#AEAEAE; line-height:30px; padding-left:16px; padding-top:50px;\">为了您能正常收到来自好东西的信息和会员邮件，请将<span style=\"color:#000; font-family:Arial, Helvetica, sans-serif;\"><a style=\"text-decoration: none;color:#000; cursor: default;\">no-reply@enlife.com</a></span>填加进您的通讯录</div>\n<div style=\"width:618px; border: solid 1px #80BB2B; padding:8px 30px 20px 30px; margin:auto;\">\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr>\n    <td align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo.jpg\" width=\"150\" height=\"76\" /></a></td>\n    <td align=\"right\" valign=\"middle\"><a href=\"http://weibo.com/u/3424175994\"><img src=\"http://hdx.lanyes.com/mailimg/mail_concerns.jpg\" width=\"235\" height=\"76\" /></a></td>\n  </tr>\n  <tr>\n    <td colspan=\"2\" align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_ban.jpg\" width=\"618\" height=\"68\" /></a></td>\n    </tr>\n</table>\n    <div style=\" font-size:15px; font-weight:bold; color:#666; line-height:30px; margin-top:40px; margin-bottom:16px;\">亲爱的 <?php echo $user->user_name  ?>:您好！</div>\n<div style=\"line-height:24px; font-size:13px; color:#949494;\">感谢您使用好东西电子商城。<br />\n    您的订单  <?php echo  $order->list_sn ?>已经确认收到，我们已安排发货，感谢您的订购。<br />\n<p>收货信息：</p>\n<p>姓    名：    <?php echo  $order_payment->consignee ?></p>\n<p>手机：   <?php if($order_payment->mobile){ echo $order_payment->mobile; }else{ echo \'未填写\' ;}?></p>\n<p>地    址：   <?php echo  \'[\'.$region.\']\'.$order_payment->address ; ?></p>\n<p>邮    编：   <?php echo  $order_payment->zipcode ?></p>\n\n<p>订单详情：</p>\n</div>\n<div style=\" font-size:15px; color:#333; line-height:30px; margin-top:30px;\">订单信息</div>\n<div style=\"border: solid 1px #80BB2B; margin-bottom:4px;\">\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr style=\"background:url(http://hdx.lanyes.com/mailimg/mail_tit.jpg) repeat-x left top; color:#fff; font-size:13px;\">\n    <th width=\"20%\" height=\"32\" align=\"center\" valign=\"middle\" style=\"background:url(http://hdx.lanyes.com/mailimg/mail_tit_line.jpg) no-repeat right center;\"><font color=\"#FFFFFF\">订单编号</font></th>\n    <th width=\"20%\" align=\"center\" valign=\"middle\" style=\"background:url(http://hdx.lanyes.com/mailimg/mail_tit_line.jpg) no-repeat right center;\"><font color=\"#FFFFFF\">订单总金额</font></th>\n    <th width=\"20%\" align=\"center\" valign=\"middle\" style=\"background:url(http://hdx.lanyes.com/mailimg/mail_tit_line.jpg) no-repeat right center;\"><font color=\"#FFFFFF\">下单时间</font></th>\n    <th width=\"20%\" align=\"center\" valign=\"middle\" style=\"background:url(http://hdx.lanyes.com/mailimg/mail_tit_line.jpg) no-repeat right center;\"><font color=\"#FFFFFF\">支付方式</font></th>\n    <th width=\"20%\" align=\"center\" valign=\"middle\"><font color=\"#FFFFFF\">收货人姓名</font></th>\n  </tr>\n  <tr style=\" font-size:12px; color:#333;\">\n      <td height=\"32\" align=\"center\" valign=\"middle\"><?php echo $order->list_sn ?></td>\n      <td align=\"center\" valign=\"middle\"><span style=\"color:#f00;\"><?php echo Fun::price_format($order->goods_amount) ?></span></td>\n      <td align=\"center\" valign=\"middle\">  <?php echo date(\'Y-m-d\',$order_payment->add_time) ?></td>\n      <td align=\"center\" valign=\"middle\"><?php echo $order_payment->pay_name  ?></td>\n    <td align=\"center\" valign=\"middle\"> <?php echo $order_payment->consignee ?></td>\n  </tr>\n</table>\n</div>\n<div style=\"width:584px;border: solid 1px #80BB2B; padding-left:16px; padding-right:16px; background-color:#FFECC4; padding-top:6px; padding-bottom:12px;\">\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr style=\"font-size:13px;\">\n    <td width=\"111\" height=\"34\" align=\"center\" valign=\"middle\">产品信息</td>\n    <td width=\"111\" align=\"center\" valign=\"middle\">产品编号</td>\n    <td width=\"130\" align=\"center\" valign=\"middle\">产品名称</td>\n    <td width=\"111\" align=\"center\" valign=\"middle\">数量</td>\n	<td width=\"111\" align=\"center\" valign=\"middle\">物流信息</td>\n  </tr>\n  \n   <?php foreach ($goods_list as $goods){ ?>\n  <tr style=\"background:url(http://hdx.lanyes.com/mailimg/mail_list.jpg) no-repeat left top; font-size:12px;\">\n      <td height=\"108\" align=\"center\" valign=\"middle\"><img src=\"<?php echo GOODS_THUMB.$goods[\'goods_img\'] ?>\" width=\"90\" height=\"90\" /></td>\n    <td align=\"center\" valign=\"middle\"><?php echo $goods[\'goods_sn\'] ?></td>\n    <td style=\"background: url(http://hdx.lanyes.com/mailimg/mail_list.jpg) no-repeat left 27 top;\" align=\"center\" valign=\"middle\"><?php echo $goods[\'goods_name\'] ?></td>\n    <td align=\"center\" valign=\"middle\"><?php echo $goods[\'goods_number\'] ?></td>\n    <td align=\"center\" valign=\"middle\"><?php echo $shipping_name ?><br/><?php echo $order->invoice_no ?></td>\n  </tr>\n  <tr style=\"background:url(http://hdx.lanyes.com/mailimg/mail_list_line.jpg) repeat-x left center;\">\n    <td height=\"19\" align=\"center\" valign=\"middle\">&nbsp;</td>\n    <td align=\"center\" valign=\"middle\">&nbsp;</td>\n    <td align=\"center\" valign=\"middle\">&nbsp;</td>\n    <td align=\"center\" valign=\"middle\">&nbsp;</td>\n   <td align=\"center\" valign=\"middle\">&nbsp;</td>\n  </tr>\n   <?php } ?>\n</table>\n</div>\n<div style=\"line-height:24px; font-size:13px; color:#707070; margin-top:20px;\">本邮件由好东西系统自动发出，请勿直接回复！<br />如果您有任何疑问或建议，请联系我们。<br />\n“好东西”电子商城，集第三方监管体系与移动购物为一体，开启了全新的购物体验。您只需要免费下载，安全食品、餐饮酒店、放心商品马上一网打尽！<br />\n客服QQ：2900600475 /2902020658 /2900385974 /2898720036<br />\n客服热线：400 066 3325\n</div>\n<div style=\"height:30px; text-align:center;\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo_b.jpg\" width=\"106\" height=\"30\" /></a></div>\n<div style=\"font-size:13px; color:#000;text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:22px;\">Copyright @ 2013 enlife.com 版权所有</div>\n</div>\n</body>\n</html>\n\n</body>\n\n</html>',1194823291),
	(4,'order_cancel',0,'订单取消','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<title>好东西电子商城</title>\n</head>\n\n<body>\n<div style=\"width:662px;margin:auto; font-size:13px; color:#AEAEAE; line-height:30px; padding-left:16px; padding-top:50px;\">为了您能正常收到来自好东西的优惠信息和会员邮件，请将<span style=\"color:#000; font-family:Arial, Helvetica, sans-serif;\"><a style=\"text-decoration: none;color:#000; cursor: default;\">no-reply@enlife.com</a></span>填加进您的通讯录</div>\n<div style=\"width:618px; border: solid 1px #80BB2B; padding:8px 30px 20px 30px; margin:auto;\">\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr>\n    <td align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo.jpg\" width=\"150\" height=\"76\" /></a></td>\n    <td align=\"right\" valign=\"middle\"><a href=\"http://weibo.com/u/3424175994\"><img src=\"http://hdx.lanyes.com/mailimg/mail_concerns.jpg\" width=\"235\" height=\"76\" /></a></td>\n  </tr>\n  <tr>\n    <td colspan=\"2\" align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_ban.jpg\" width=\"618\" height=\"68\" /></a></td>\n    </tr>\n</table>\n    <div style=\" font-size:15px; font-weight:bold; color:#666; line-height:30px; margin-top:40px; margin-bottom:16px;\">亲爱的 <?php echo $user->user_name ?>:您好！</div><br /><div style=\"line-height:24px; font-size:13px; color:#949494;\">您的编号为：<?php echo $order->order_sn ?>的订单已取消。<br /><br /><?php echo $shop_name ?><br /><br /><?php echo $send_date ?></div><br />\n<div style=\"line-height:24px; font-size:13px; color:#707070; margin-top:20px;\">本邮件由好东西系统自动发出，请勿直接回复！<br />如果您有任何疑问或建议，请联系我们。<br />\n“好东西”电子商城，集第三方监管体系与移动购物为一体，开启了全新的购物体验。您只需要免费下载，安全食品、餐饮酒店、放心商品马上一网打尽！<br />\n客服QQ：2900600475 /2902020658 /2900385974 /2898720036<br />\n客服热线：400 066 3325\n</div>\n<div style=\"height:30px; text-align:center;\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo_b.jpg\" width=\"106\" height=\"30\" /></a></div>\n<div style=\"font-size:13px; color:#000;text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:22px;\">Copyright @ 2013 enlife.com 版权所有</div>\n</div>\n</body>\n</html>\n\n</body>\n\n</html>',1156491130),
	(5,'order_invalid',0,'订单无效','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<title>好东西电子商城</title>\n</head>\n\n<body>\n<div style=\"width:662px;margin:auto; font-size:13px; color:#AEAEAE; line-height:30px; padding-left:16px; padding-top:50px;\">为了您能正常收到来自好东西的信息和会员邮件，请将<span style=\"color:#000; font-family:Arial, Helvetica, sans-serif;\"><a style=\"text-decoration: none;color:#000; cursor: default;\">no-reply@enlife.com</a></span>填加进您的通讯录</div>\n<div style=\"width:618px; border: solid 1px #80BB2B; padding:8px 30px 20px 30px; margin:auto;\">\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr>\n    <td align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo.jpg\" width=\"150\" height=\"76\" /></a></td>\n    <td align=\"right\" valign=\"middle\"><a href=\"http://weibo.com/u/3424175994\"><img src=\"http://hdx.lanyes.com/mailimg/mail_concerns.jpg\" width=\"235\" height=\"76\" /></a></td>\n  </tr>\n  <tr>\n    <td colspan=\"2\" align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_ban.jpg\" width=\"618\" height=\"68\" /></a></td>\n    </tr>\n</table>\n    <div style=\" font-size:15px; font-weight:bold; color:#666; line-height:30px; margin-top:40px; margin-bottom:16px;\">亲爱的 <?php echo $user->user_name ?> ：您好！</div><br /><div style=\"line-height:24px; font-size:13px; color:#949494;\">您的编号为：<?php echo $order->order_sn ?>的订单无效。 <br /><br /><?php echo $shop_name ?><br /><br /><?php echo $send_date ?></div><br />\n<div style=\"line-height:24px; font-size:13px; color:#707070; margin-top:20px;\">本邮件由好东西系统自动发出，请勿直接回复！<br />如果您有任何疑问或建议，请联系我们。<br />\n“好东西”电子商城，集第三方监管体系与移动购物为一体，开启了全新的购物体验。您只需要免费下载，安全食品、餐饮酒店、放心商品马上一网打尽！<br />\n客服QQ：2900600475 /2902020658 /2900385974 /2898720036<br />\n客服热线：400 066 3325\n</div>\n<div style=\"height:30px; text-align:center;\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo_b.jpg\" width=\"106\" height=\"30\" /></a></div>\n<div style=\"font-size:13px; color:#000;text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:22px;\">Copyright @ 2013 enlife.com 版权所有</div>\n</div>\n</body>\n</html>\n\n</body>\n\n</html>',1156491164),
	(6,'send_bonus',1,'发红包','<div style=\"width:662px;margin:auto; font-size:13px; color:#AEAEAE; line-height:30px; padding-left:16px; padding-top:50px;\">为了您能正常收到来自好东西的优惠信息和会员邮件，请将<span style=\"color:#000; font-family:Arial, Helvetica, sans-serif;\"><a style=\"text-decoration: none;color:#000; cursor: default;\">no-reply@enlife.com</a></span>填加进您的通讯录</div><div style=\"width:618px; border: solid 1px #80BB2B; padding:8px 30px 20px 30px; margin:auto;\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">  <tbody><tr>    <td align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo.jpg\" width=\"150\" height=\"76\" alt=\"\" /></a></td>    <td align=\"right\" valign=\"middle\"><a href=\"http://weibo.com/u/3424175994\"><img src=\"http://hdx.lanyes.com/mailimg/mail_concerns.jpg\" width=\"235\" height=\"76\" alt=\"\" /></a></td>  </tr>  <tr>    <td colspan=\"2\" align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_ban.jpg\" width=\"618\" height=\"68\" alt=\"\" /></a></td>    </tr></tbody></table><div style=\" font-size:15px; font-weight:bold; color:#666; line-height:30px; margin-top:40px; margin-bottom:16px;\">亲爱的{$user_name}:您好！ </div><div style=\"line-height:24px; font-size:13px; color:#949494;\">恭喜您获得了{$count}个红包，金额为{$money}<br /><br>\n{$shop_name}<br /><br />\n{$send_date}</div>\n\n<div style=\"line-height:24px; font-size:13px; color:#707070; margin-top:20px;\">本邮件由好东西系统自动发出，请勿直接回复！<br />如果您有任何疑问或建议，请联系我们。<br />“好东西”电子商城，集第三方监管体系与移动购物为一体，开启了全新的购物体验。您只需要免费下载，安全食品、餐饮酒店、放心商品马上一网打尽！<br />客服QQ：2900600475 /2902020658 /2900385974 /2898720036<br />客服热线：400 066 3325</div><div style=\"height:30px; text-align:center;\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo_b.jpg\" width=\"106\" height=\"30\" alt=\"\" /></a></div><div style=\"font-size:13px; color:#000;text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:22px;\">Copyright @ 2013 enlife.com 版权所有</div></div>',1156491184),
	(7,'group_buy',1,'团购商品','亲爱的{$consignee}，您好！<br>\n<br>\n您于{$order_time}在本店参加团购商品活动，所购买的商品名称为：{$goods_name}，数量：{$goods_number}，订单号为：{$order_sn}，订单金额为：{$order_amount}<br>\n<br>\n此团购商品现在已到结束日期，并达到最低价格，您现在可以对该订单付款。<br>\n<br>\n请点击下面的链接：<br>\n<a href=\"{$shop_url}\" target=\"_blank\">{$shop_url}</a><br>\n<br>\n请尽快登录到用户中心，查看您的订单详情信息。 <br>\n<br>\n{$shop_name} <br>\n<br>\n{$send_date}',1194824668),
	(8,'register_validate',1,'邮件验证','{$user_name}您好！<br><br>\n\n这封邮件是 {$shop_name} 发送的。你收到这封邮件是为了验证你注册邮件地址是否有效。如果您已经通过验证了，请忽略这封邮件。<br>\n请点击以下链接(或者复制到您的浏览器)来验证你的邮件地址:<br>\n<a href=\"{$validate_email}\" target=\"_blank\">{$validate_email}</a><br><br>\n\n{$shop_name}<br>\n{$send_date}',1162201031),
	(9,'virtual_card',0,'虚拟卡片','亲爱的{$order.consignee}\r\n你好！您的订单{$order.order_sn}中{$goods.goods_name} 商品的详细信息如下:\r\n{foreach from=$virtual_card item=card}\r\n{if $card.card_sn}卡号：{$card.card_sn}{/if}{if $card.card_password}卡片密码：{$card.card_password}{/if}{if $card.end_date}截至日期：{$card.end_date}{/if}\r\n{/foreach}\r\n再次感谢您对我们的支持。欢迎您的再次光临。\r\n\r\n{$shop_name} \r\n{$send_date}',1162201031),
	(10,'attention_list',0,'关注商品','亲爱的{$user_name}您好~\n\n您关注的商品 : {$goods_name} 最近已经更新,请您查看最新的商品信息\n\n{$goods_url}\n\n{$shop_name} \n{$send_date}',1183851073),
	(11,'remind_of_new_order',0,'新订单通知','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<title>无标题文档</title>\n</head>\n\n<body>\n<div style=\"width:662px;margin:auto; font-size:13px; color:#AEAEAE; line-height:30px; padding-left:16px; padding-top:50px;\">为了您能正常收到来自好东西的信息和会员邮件，请将<span style=\"color:#000; font-family:Arial, Helvetica, sans-serif;\"><a style=\"text-decoration: none;color:#000; cursor: default;\">no-reply@enlife.com</a></span>填加进您的通讯录</div>\n<div style=\"width:618px; border: solid 1px #80BB2B; padding:8px 30px 20px 30px; margin:auto;\">\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr>\n    <td align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo.jpg\" width=\"150\" height=\"76\" /></a></td>\n    <td align=\"right\" valign=\"middle\"><a href=\"http://weibo.com/u/3424175994\"><img src=\"http://hdx.lanyes.com/mailimg/mail_concerns.jpg\" width=\"235\" height=\"76\" /></a></td>\n  </tr>\n  <tr>\n    <td colspan=\"2\" align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_ban.jpg\" width=\"618\" height=\"68\" /></a></td>\n    </tr>\n</table>\n<div style=\" font-size:15px; font-weight:bold; color:#666; line-height:30px; margin-top:40px; margin-bottom:16px;\">亲爱的<?php echo $suppliers_info->suppliers_name ?>供货商，您好！</div>\n<div style=\"line-height:24px; font-size:13px; color:#949494;\">快来看看吧，又有新订单了。<br /> 收货人:<?php echo $order_info->consignee ?>   <br />   收货人地址:<?php echo $region.$order_info->address ?><br />\n 收货人电话:<?php echo $order_info->mobile ?> <br />  \n</div>\n\n\n\n<div style=\" font-size:15px; color:#333; line-height:30px; margin-top:30px;\">订单信息</div>\n\n<div style=\"border: solid 1px #80BB2B; margin-bottom:4px;\">\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr style=\"background:url(http://hdx.lanyes.com/mailimg/mail_tit.jpg) repeat-x left top; color:#fff; font-size:13px;\">\n    <th width=\"20%\" height=\"32\" align=\"center\" valign=\"middle\" style=\"background:url(http://hdx.lanyes.com/mailimg/mail_tit_line.jpg) no-repeat right center;\"><font color=\"#FFFFFF\">订单编号</font></th>\n    <th width=\"40%\" align=\"center\" valign=\"middle\" style=\"background:url(http://hdx.lanyes.com/mailimg/mail_tit_line.jpg) no-repeat right center;\"><font color=\"#FFFFFF\">下单时间</font></th>\n    <th width=\"40%\" align=\"center\" valign=\"middle\"><font color=\"#FFFFFF\">收货人姓名</font></th>\n  </tr>\n  <tr style=\" font-size:12px; color:#333;\">\n    <td height=\"32\" align=\"center\" valign=\"middle\"><?php echo $list_sn ?></td>\n    <td align=\"center\" valign=\"middle\"> <?php echo time(); ?></td>\n    <td align=\"center\" valign=\"middle\"> <?php echo $order_info->consignee ?></td>\n  </tr>\n</table>\n</div>\n<div style=\"width:584px;border: solid 1px #80BB2B; padding-left:16px; padding-right:16px; background-color:#FFECC4; padding-top:6px; padding-bottom:12px;\">\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr style=\"font-size:13px;\">\n    <td width=\"111\" height=\"34\" align=\"center\" valign=\"middle\">产品信息</td>\n    <td width=\"125\" align=\"center\" valign=\"middle\">产品编号</td>\n    <td width=\"251\" align=\"center\" valign=\"middle\">产品名称</td>\n    <td width=\"97\" align=\"center\" valign=\"middle\">数量</td>\n  </tr>\n  \n   <?php  foreach($goods_list as $key=>$goods){ ?>\n  <tr style=\"background:url(http://hdx.lanyes.com/mailimg/mail_list.jpg) no-repeat left top; font-size:12px;\">\n    <td height=\"108\" align=\"center\" valign=\"middle\"><img src=\"<?php echo GOODS_THUMB.$goods[\'goods_img\'] ?>\" width=\"90\" height=\"90\" /></td>\n    <td align=\"center\" valign=\"middle\"><?php echo $goods[\'goods_sn\'] ?></td>\n    <td align=\"center\" valign=\"middle\"><?php echo $goods[\'goods_name\'] ?></td>\n    <td align=\"center\" valign=\"middle\"><?php echo $goods[\'goods_number\'] ?></td>\n  </tr>\n  <tr style=\"background:url(http://hdx.lanyes.com/mailimg/mail_list_line.jpg) repeat-x left center;\">\n    <td height=\"19\" align=\"center\" valign=\"middle\">&nbsp;</td>\n    <td align=\"center\" valign=\"middle\">&nbsp;</td>\n    <td align=\"center\" valign=\"middle\">&nbsp;</td>\n    <td align=\"center\" valign=\"middle\">&nbsp;</td>\n  </tr>\n  <?php } ?>\n  \n  \n \n</table>\n</div>\n\n\n<div style=\"line-height:24px; font-size:13px; color:#707070; margin-top:20px;\">本邮件由好东西系统自动发出，请勿直接回复！<br /><br />\n如果您有任何疑问或建议，请联系我们。<br />\n“好东西”电子商城，集第三方监管体系与移动购物为一体，开启了全新的购物体验。您只需要免费下载，安全食品、餐饮酒店、放心商品马上一网打尽！<br />\n客服QQ：2900600475 /2902020658 /2900385974 /2898720036<br />\n客服热线：400 066 3325\n</div>\n<div style=\"height:30px; text-align:center;\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo_b.jpg\" width=\"106\" height=\"30\" /></a></div>\n<div style=\"font-size:13px; color:#000;text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:22px;\">Copyright @ 2013 enlife.com 版权所有</div>\n</div>\n</body>\n</html>',1196239170),
	(12,'goods_booking',1,'缺货回复','亲爱的{$user_name}。你好！</br></br>{$dispose_note}</br></br>您提交的缺货商品链接为</br></br><a href=\"{$goods_link}\" target=\"_blank\">{$goods_name}</a></br><br>{$shop_name} </br>{$send_date}',0),
	(13,'user_message',1,'留言回复','亲爱的{$user_name}。你好！</br></br>对您的留言：</br>{$message_content}</br></br>店主作了如下回复：</br>{$message_note}</br></br>您可以随时回到店中和店主继续沟通。</br>{$shop_name}</br>{$send_date}',0),
	(14,'recomment',1,'用户评论回复','亲爱的{$user_name}。你好！</br></br>对您的评论：</br>“{$comment}”</br></br>店主作了如下回复：</br>“{$recomment}”</br></br>您可以随时回到店中和店主继续沟通。</br>{$shop_name}</br>{$send_date}',0),
	(15,'remind_of_upgrade',1,'用户等级升级','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<title>好东西电子商城</title>\r\n</head>\r\n\r\n<body>\r\n<div style=\"width:662px;margin:auto; font-size:13px; color:#AEAEAE; line-height:30px; padding-left:16px; padding-top:50px;\">为了您能正常收到来自好东西的优惠信息和会员邮件，请将<span style=\"color:#000; font-family:Arial, Helvetica, sans-serif;\"><a style=\"text-decoration: none;color:#000; cursor: default;\">no-reply@enlife.com</a></span>填加进您的通讯录</div>\r\n<div style=\"width:618px; border: solid 1px #80BB2B; padding:8px 30px 20px 30px; margin:auto;\">\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo.jpg\" width=\"150\" height=\"76\" /></a></td>\r\n    <td align=\"right\" valign=\"middle\"><a href=\"http://weibo.com/u/3424175994\"><img src=\"http://hdx.lanyes.com/mailimg/mail_concerns.jpg\" width=\"235\" height=\"76\" /></a></td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan=\"2\" align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_ban.jpg\" width=\"618\" height=\"68\" /></a></td>\r\n    </tr>\r\n</table>\r\n<div style=\" font-size:15px; font-weight:bold; color:#666; line-height:30px; margin-top:40px; margin-bottom:16px;\">亲爱的{$user_name}，您好！</div>\r\n<div style=\"line-height:24px; font-size:13px; color:#949494;\">很高兴通知您，您的会员等级已升级为{$rank_name}会员，可享受更多专享服务。详情请查看好东西会员制度说明,<br />\r\n由于邮件接收时间可能存在延迟，您的会员级别最终以好东西电子商城会员中心的显示为准。如有任何疑问，可查看好东西相关规则。<br /><br />{$shop_name}<br /><br />{$send_date}\r\n</div>\r\n<div style=\"line-height:24px; font-size:13px; color:#707070; margin-top:20px;\">本邮件由好东西系统自动发出，请勿直接回复！<br />如果您有任何疑问或建议，请联系我们。<br />\r\n“好东西”电子商城，集第三方监管体系与移动购物为一体，开启了全新的购物体验。您只需要免费下载，安全食品、餐饮酒店、放心商品马上一网打尽！<br />\r\n客服QQ：2900600475 /2902020658 /2900385974 /2898720036<br />\r\n客服热线：400 066 3325\r\n</div>\r\n<div style=\"height:30px; text-align:center;\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo_b.jpg\" width=\"106\" height=\"30\" /></a></div>\r\n<div style=\"font-size:13px; color:#000;text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:22px;\">Copyright @ 2013 enlife.com 版权所有</div>\r\n</div>\r\n</body>\r\n</html>\r\n\r\n</body>\r\n\r\n</html>',0),
	(16,'send_revise_email_value',1,'修改用户密码','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<title>好东西电子商城</title>\r\n</head>\r\n\r\n<body>\r\n<div style=\"width:662px;margin:auto; font-size:13px; color:#AEAEAE; line-height:30px; padding-left:16px; padding-top:50px;\">为了您能正常收到来自好东西的优惠信息和会员邮件，请将<span style=\"color:#000; font-family:Arial, Helvetica, sans-serif;\"><a style=\"text-decoration: none;color:#000; cursor: default;\">no-reply@enlife.com</a></span>填加进您的通讯录</div>\r\n<div style=\"width:618px; border: solid 1px #80BB2B; padding:8px 30px 20px 30px; margin:auto;\">\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo.jpg\" width=\"150\" height=\"76\" /></a></td>\r\n    <td align=\"right\" valign=\"middle\"><a href=\"http://weibo.com/u/3424175994\"><img src=\"http://hdx.lanyes.com/mailimg/mail_concerns.jpg\" width=\"235\" height=\"76\" /></a></td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan=\"2\" align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_ban.jpg\" width=\"618\" height=\"68\" /></a></td>\r\n    </tr>\r\n</table>\r\n<div style=\" font-size:15px; font-weight:bold; color:#666; line-height:30px; margin-top:40px; margin-bottom:16px;\">亲爱的{$user_name}:您好！</div><br /><div style=\"line-height:24px; font-size:13px; color:#949494;\">您的账号刚被修改了密码，如非您本人修改请立刻联系客服处理。 </div><br />\r\n<div style=\"line-height:24px; font-size:13px; color:#707070; margin-top:20px;\">本邮件由好东西系统自动发出，请勿直接回复！<br /><br />\r\n如果您有任何疑问或建议，请联系我们。<br />\r\n“好东西”电子商城，集第三方监管体系与移动购物为一体，开启了全新的购物体验。您只需要免费下载，安全食品、餐饮酒店、放心商品马上一网打尽！<br />\r\n客服QQ：2900600475 /2902020658 /2900385974 /2898720036<br />\r\n客服热线：400 066 3325\r\n</div>\r\n<div style=\"height:30px; text-align:center;\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo_b.jpg\" width=\"106\" height=\"30\" /></a></div>\r\n<div style=\"font-size:13px; color:#000;text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:22px;\">Copyright @ 2013 enlife.com 版权所有</div>\r\n</div>\r\n</body>\r\n</html>\r\n\r\n</body>\r\n\r\n</html>',0),
	(17,'send_revise_person_email_value',1,'修改用户个人资料','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<title>好东西电子商城</title>\r\n</head>\r\n\r\n<body>\r\n<div style=\"width:662px;margin:auto; font-size:13px; color:#AEAEAE; line-height:30px; padding-left:16px; padding-top:50px;\">为了您能正常收到来自好东西的优惠信息和会员邮件，请将<span style=\"color:#000; font-family:Arial, Helvetica, sans-serif;\"><a style=\"text-decoration: none;color:#000; cursor: default;\">no-reply@enlife.com</a></span>填加进您的通讯录</div>\r\n<div style=\"width:618px; border: solid 1px #80BB2B; padding:8px 30px 20px 30px; margin:auto;\">\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo.jpg\" width=\"150\" height=\"76\" /></a></td>\r\n    <td align=\"right\" valign=\"middle\"><a href=\"http://weibo.com/u/3424175994\"><img src=\"http://hdx.lanyes.com/mailimg/mail_concerns.jpg\" width=\"235\" height=\"76\" /></a></td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan=\"2\" align=\"left\" valign=\"middle\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_ban.jpg\" width=\"618\" height=\"68\" /></a></td>\r\n    </tr>\r\n</table>\r\n<div style=\" font-size:15px; font-weight:bold; color:#666; line-height:30px; margin-top:40px; margin-bottom:16px;\">亲爱的{$user_name}：您好！</div><br /><div style=\"line-height:24px; font-size:13px; color:#949494;\">您的账号刚被修改了个人资料，如非您本人修改请立刻联系客服处理。 </div><br />\r\n<div style=\"line-height:24px; font-size:13px; color:#707070; margin-top:20px;\">本邮件由好东西系统自动发出，请勿直接回复！<br /><br />\r\n如果您有任何疑问或建议，请联系我们。<br />\r\n“好东西”电子商城，集第三方监管体系与移动购物为一体，开启了全新的购物体验。您只需要免费下载，安全食品、餐饮酒店、放心商品马上一网打尽！<br />\r\n客服QQ：2900600475 /2902020658 /2900385974 /2898720036<br />\r\n客服热线：400 066 3325\r\n</div>\r\n<div style=\"height:30px; text-align:center;\"><a href=\"http://hdx.enlife.com\"><img src=\"http://hdx.lanyes.com/mailimg/mail_logo_b.jpg\" width=\"106\" height=\"30\" /></a></div>\r\n<div style=\"font-size:13px; color:#000;text-align:center; font-family:Arial, Helvetica, sans-serif; line-height:22px;\">Copyright @ 2013 enlife.com 版权所有</div>\r\n</div>\r\n</body>\r\n</html>\r\n\r\n</body>\r\n\r\n</html>',0);

/*!40000 ALTER TABLE `mail_templates` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(10) NOT NULL COMMENT '时间',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 1为已读: 0：未读',
  `user_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言反馈表';



# Dump of table options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(20) NOT NULL,
  `value` text NOT NULL COMMENT 'JSON配置信息',
  `weixin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='配置表';



# Dump of table post_actions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_actions`;

CREATE TABLE `post_actions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL COMMENT '1为like赞 2为thinks感谢',
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员动作表';

LOCK TABLES `post_actions` WRITE;
/*!40000 ALTER TABLE `post_actions` DISABLE KEYS */;

INSERT INTO `post_actions` (`id`, `type`, `post_id`, `user_id`)
VALUES
	(1,1,9,2),
	(2,2,9,2);

/*!40000 ALTER TABLE `post_actions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_comments`;

CREATE TABLE `post_comments` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `comment` text NOT NULL COMMENT '评论',
  `create_time` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1为正常 0为禁用',
  `path` varchar(100) NOT NULL DEFAULT '0' COMMENT '无极限排序',
  `user_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论表';



# Dump of table post_posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_posts`;

CREATE TABLE `post_posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `excerpt` varchar(255) DEFAULT NULL COMMENT '摘录',
  `image` varchar(100) NOT NULL COMMENT '封面图片',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(10) NOT NULL COMMENT '时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1:发布 0：草稿',
  `order` int(5) DEFAULT NULL COMMENT '排序 0最大',
  `tags` varchar(200) NOT NULL COMMENT '空格隔开',
  `view_count` int(8) DEFAULT '0' COMMENT '浏览次数',
  `thanks_count` int(8) DEFAULT '0' COMMENT '感谢次数',
  `like_count` int(8) DEFAULT '0' COMMENT '点赞次数',
  `admin_id` int(10) NOT NULL,
  `comment_count` int(8) DEFAULT '0' COMMENT '评论次数',
  `weixin_id` int(10) NOT NULL COMMENT '微信ID',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表';

LOCK TABLES `post_posts` WRITE;
/*!40000 ALTER TABLE `post_posts` DISABLE KEYS */;

INSERT INTO `post_posts` (`id`, `title`, `excerpt`, `image`, `content`, `create_time`, `status`, `order`, `tags`, `view_count`, `thanks_count`, `like_count`, `admin_id`, `comment_count`, `weixin_id`, `author`)
VALUES
	(12,'举国的焦虑','','http://readeep.qiniudn.com/197.jpg','<p>举国的焦虑</p>',1393894800,1,NULL,'hello 小道消息',0,0,0,1,0,1,NULL),
	(20,'sds','','017CA187-E925-4E5C-8143-42A4C7CB0A08.png','<p>ds</p>',1395756480,1,NULL,'hello world',0,0,0,1,0,1,NULL),
	(29,'ds','','3401dd97db153d3b49d974b3218da927_r.jpg','<p>ds</p>',1395759900,1,NULL,'hello world',0,0,0,1,0,1,NULL),
	(30,'举国的焦虑d','','017CA187-E925-4E5C-8143-42A4C7CB0A08.png','<p>ds</p>',1395760440,1,NULL,'hello 你阿红',1,0,0,1,0,1,'d');

/*!40000 ALTER TABLE `post_posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_read_later
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_read_later`;

CREATE TABLE `post_read_later` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1为已读 0为未读',
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='稍后阅读表';



# Dump of table post_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_tags`;

CREATE TABLE `post_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '名称',
  `admin_id` int(10) NOT NULL,
  `weixin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标签库';

LOCK TABLES `post_tags` WRITE;
/*!40000 ALTER TABLE `post_tags` DISABLE KEYS */;

INSERT INTO `post_tags` (`id`, `name`, `admin_id`, `weixin_id`)
VALUES
	(1,'hello',1,0),
	(2,'world',1,0),
	(3,'你阿红',1,0),
	(4,'小道消息',1,0),
	(5,'马云',1,0),
	(6,'演讲',1,0),
	(7,'程序员',1,0),
	(8,'sd',1,1),
	(9,'d',1,1),
	(10,'sds',1,1),
	(11,'ds',1,1);

/*!40000 ALTER TABLE `post_tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_openids
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_openids`;

CREATE TABLE `user_openids` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `open_id` varchar(100) DEFAULT NULL COMMENT '获取的open_id',
  `access_token` varchar(100) DEFAULT NULL COMMENT '获取的Token',
  `login_type` varchar(50) NOT NULL COMMENT '第三方类型',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户第三方登录信息';



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `open_id` varchar(80) NOT NULL DEFAULT '' COMMENT '微信openid',
  `username` varchar(20) DEFAULT NULL COMMENT '用户名',
  `email` varchar(50) DEFAULT NULL COMMENT '登录邮箱',
  `password` varchar(20) DEFAULT NULL COMMENT '密码',
  `login_ip` varchar(20) NOT NULL COMMENT '登录IP',
  `login_time` int(10) NOT NULL COMMENT '登录时间',
  `login_count` int(10) DEFAULT '0' COMMENT '登录次数',
  `create_ip` varchar(20) NOT NULL COMMENT '创建IP',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员表';

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `open_id`, `username`, `email`, `password`, `login_ip`, `login_time`, `login_count`, `create_ip`, `create_time`, `admin_id`)
VALUES
	(1,'9',NULL,NULL,NULL,'127.0.0.1',1390121933,NULL,'127.0.0.1',1390121933,1);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table weixin_reply
# ------------------------------------------------------------

DROP TABLE IF EXISTS `weixin_reply`;

CREATE TABLE `weixin_reply` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `excerpt` varchar(255) DEFAULT NULL COMMENT '摘录',
  `image` varchar(100) DEFAULT NULL COMMENT '封面图片',
  `keyword` varchar(10) NOT NULL COMMENT '关键词',
  `type` tinyint(1) DEFAULT '1' COMMENT '1为回复 2为关注时自动回复 3为URL',
  `content` text NOT NULL COMMENT '回复内容',
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='回复表';

LOCK TABLES `weixin_reply` WRITE;
/*!40000 ALTER TABLE `weixin_reply` DISABLE KEYS */;

INSERT INTO `weixin_reply` (`id`, `title`, `excerpt`, `image`, `keyword`, `type`, `content`, `admin_id`)
VALUES
	(1,'','','','m',1,'sd',1);

/*!40000 ALTER TABLE `weixin_reply` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table weixin_set
# ------------------------------------------------------------

DROP TABLE IF EXISTS `weixin_set`;

CREATE TABLE `weixin_set` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(10) NOT NULL COMMENT '微信token',
  `name` varchar(20) NOT NULL COMMENT '公众号名称',
  `wx_id` varchar(20) NOT NULL COMMENT '微信号',
  `rawid` varchar(50) NOT NULL DEFAULT '' COMMENT '原始ID',
  `avatar` varchar(100) DEFAULT NULL COMMENT '微信头像',
  `qr_code` varchar(100) DEFAULT NULL COMMENT '二维码',
  `admin_id` int(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL COMMENT '简介',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信设置表';

LOCK TABLES `weixin_set` WRITE;
/*!40000 ALTER TABLE `weixin_set` DISABLE KEYS */;

INSERT INTO `weixin_set` (`id`, `token`, `name`, `wx_id`, `rawid`, `avatar`, `qr_code`, `admin_id`, `description`)
VALUES
	(1,'forecho','三个朋友之家','sanuhome','gh_52776cc48d20','http://ww4.sinaimg.cn/large/4cc5f9b3tw1ecoxc7art5j204v04vdft.jpg','http://ww1.sinaimg.cn/large/4cc5f9b3tw1ecoxfzv89dj20by0by755.jpg',1,'这家伙很懒什么都没有留下。'),
	(2,'forecho','三个朋友之家','sanuhome','gh_52776cc48d20','http://ww4.sinaimg.cn/large/4cc5f9b3tw1ecoxc7art5j204v04vdft.jpg','http://ww1.sinaimg.cn/large/4cc5f9b3tw1ecoxfzv89dj20by0by755.jpg',1,'这家伙很懒什么都没有留下。');

/*!40000 ALTER TABLE `weixin_set` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
