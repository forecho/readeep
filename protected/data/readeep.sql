CREATE TABLE `post_posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `excerpt` varchar(255) DEFAULT NULL COMMENT '摘录',
  `image` varchar(100) NOT NULL COMMENT '封面图片',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(10) NOT NULL COMMENT '时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1:发布 0：草稿',
  `order` int(5) DEFAULT NULL COMMENT '排序 0最大',
  `tags` varchar(200) NOT NULL COMMENT '空格隔开',
  `view_count`  int(8) DEFAULT '0' COMMENT '浏览次数',
  `thanks_count` int(8) DEFAULT '0' COMMENT '感谢次数',
  `like_count` int(8) DEFAULT '0' COMMENT '点赞次数',
  `comment_count` int(8) DEFAULT '0' COMMENT '评论次数',
  `admin_id` int(10) NOT NULL,
  `weixin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='文章表';


CREATE TABLE `admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名-微信名',
  `email` varchar(50) NOT NULL COMMENT '登录邮箱',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `login_ip` varchar(20) NOT NULL COMMENT '登录IP',
  `login_time` int(10) NOT NULL COMMENT '登录时间',
  `login_count` int(10) DEFAULT '0' COMMENT '登录次数',
  `create_ip` varchar(20) NOT NULL COMMENT '创建IP',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '1为正常 0为禁用',
  `invite_code` varchar(10) NOT NULL COMMENT '邀请码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员表';


CREATE TABLE `post_actions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL COMMENT '1为like赞 2为thinks感谢',
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='会员动作表';


CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `open_id` varchar(80) NOT NULL COMMENT '微信openid',
  `username` varchar(20) DEFAULT NULL COMMENT '用户名',
  `email` varchar(50) DEFAULT NULL COMMENT '登录邮箱',
  `password` varchar(20) DEFAULT NULL COMMENT '密码',
  `login_ip` varchar(20) NOT NULL COMMENT '登录IP',
  `login_time` int(10) NOT NULL COMMENT '登录时间',
  `login_count` int(10) DEFAULT '0' COMMENT '登录次数',
  `create_ip` varchar(20) NOT NULL COMMENT '创建IP',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `fake_id` int(10) NOT NULL COMMENT '微信的 fakeid',
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='会员表';


CREATE TABLE `options` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(20) NOT NULL,
  `value` text NOT NULL COMMENT 'JSON配置信息',
  `weixin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='配置表';


CREATE TABLE `post_comments` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `comment` text NOT NULL COMMENT '评论',
  `create_time` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1为正常 0为禁用',
  `path` varchar(100) NOT NULL DEFAULT '0' COMMENT '无极限排序',
  `user_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='评论表';


CREATE TABLE `post_read_later` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1为已读 0为未读',
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='稍后阅读表';


CREATE TABLE `weixin_set` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(10) NOT NULL COMMENT '微信token',
  `name` varchar(20) NOT NULL COMMENT '公众号名称',
  `wx_id` varchar(20) NOT NULL COMMENT '微信号',
  `rawid` varchar(10) NOT NULL COMMENT '原始ID',
  `avatar` varchar(100) DEFAULT NULL COMMENT '微信头像',
  `qr_code` varchar(100) DEFAULT NULL COMMENT '二维码',
  `description` varchar(255) DEFAULT NULL COMMENT '简介',
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='微信设置表';


CREATE TABLE `user_openids` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `open_id` varchar(100) COMMENT '获取的open_id',
  `access_token` varchar(100) COMMENT '获取的Token',
  `login_type` varchar(50) NOT NULL COMMENT '第三方类型',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='用户第三方登录信息';


CREATE TABLE `post_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '名称',
  `admin_id` int(10) NOT NULL,
  `weixin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='标签库';


CREATE TABLE `weixin_reply` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `excerpt` varchar(255) DEFAULT NULL COMMENT '摘录',
  `image` varchar(100) DEFAULT NULL COMMENT '封面图片',
  `keyword` varchar(10) NOT NULL COMMENT '关键词',
  `type` tinyint(1) DEFAULT '1' COMMENT '1为回复 2为关注时自动回复 3为URL',
  `content` text COMMENT '回复内容',
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='回复表';


CREATE TABLE `invite_code` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0为已经被用过 1为可以',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='邀请码表';


CREATE TABLE `messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(10) NOT NULL COMMENT '时间',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 1为已读: 0：未读',
  `user_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='留言反馈表';

CREATE TABLE `config` (
  `key` varchar(100) COLLATE utf8_bin NOT NULL,
  `value` text COLLATE utf8_bin,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `mail_templates`
--

CREATE TABLE IF NOT EXISTS `mail_templates` (
  `template_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `template_code` varchar(30) NOT NULL DEFAULT '',
  `is_html` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `template_subject` varchar(200) NOT NULL DEFAULT '',
  `template_content` text NOT NULL,
  `last_modify` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`template_id`),
  UNIQUE KEY `template_code` (`template_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
INSERT INTO `config` (`key`, `value`) VALUES
('qiniu', '');

CREATE TABLE `contact_group` (
  `contact_group_id` int(11) NOT NULL auto_increment COMMENT '联系人分组id',
  `mail_template_id` int(11) NOT NULL COMMENT '模板id',
  `contact_group_name` varchar(60) NOT NULL COMMENT '分组名',
  `contact_group_parent_id` int(11) NOT NULL default '0' COMMENT '上级分组id',
  PRIMARY KEY  (`contact_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `contact_person` (
  `contact_person_id` int(11) NOT NULL auto_increment COMMENT '联系人id',
  `admin_id` int(11) NOT NULL COMMENT '管理员id',
  `contact_group_id` varchar(60) NOT NULL COMMENT '联系人所在分组id',
  `mobile` varchar(20) NOT NULL COMMENT '手机号',
  `gender` tinyint(1) NOT NULL COMMENT '性别',
  `email` varchar(60) NOT NULL COMMENT 'email邮箱',
  `birthday` date NOT NULL COMMENT '生日',
  `address` varchar(60) NOT NULL COMMENT '地址',
  `nickname` varchar(20) NOT NULL default '0' COMMENT '昵称',
  PRIMARY KEY  (`contact_person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `mail_account` (
  `mai_account_id` int(11) NOT NULL auto_increment COMMENT '邮箱账号id',
  `mail_account` varchar(60) NOT NULL COMMENT '邮箱账号',
  `nick_name` varchar(60) NOT NULL,
  `mail_password` varchar(60) NOT NULL COMMENT '邮箱密码',
  `host` varchar(60) NOT NULL COMMENT '邮箱服务器',
  `port` tinyint(3) NOT NULL COMMENT '服务器端口',
  PRIMARY KEY  (`mai_account_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

