数据库更新说明：

1月17日
	post_posts 表添加 comment_count 评论数字段。

1月18日
	admins 表添加 avatar 头像字段。
	admins 表添加 description 简介字段。
	post_posts 表 view_count thanks_count like_count comment_count默认由 null 改为 0

1月19日
	users 表 open_id 字段由 varchar(30) 改成 varchar(80)
	weixin_set 表 rawid 字段由 varchar(10) 改成 varchar(50)
	--weixin_set 表添加 description 简介字段。
	users 表 login_count 默认值改为 0。
	admins 表 login_count 默认值改为 0。

01月20日
	weixin_set 表添加 description 简介字段。
	admins 表删除 avatar 头像字段。
	admins 表删除 description 简介字段。

01月22日
	card 表加 title varchar(20) 字段。
	card_info 表 添加 name varchar(20) 署名字段。

01月23日
	砍掉发贺卡。


2014年03月04日
post_posts 表添加 weixin_id 字段
ALTER TABLE `post_posts` ADD `weixin_id` int(10) NOT NULL COMMENT '微信ID'
ALTER TABLE `post_tags` ADD `weixin_id` int(10) NOT NULL COMMENT '微信ID'

2014年03月25日
post_posts 添加作者字段
ALTER TABLE `post_posts` ADD `author` varchar(50) DEFAULT NULL COMMENT '作者'


2014年03月25日
mail_templates 增加mail_templates表

2014年3月27日
options 表的 name 字段改成 key


