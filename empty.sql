/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : empty

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-06-15 14:53:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `realname` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，0禁用，1启用',
  `openid` varchar(64) NOT NULL DEFAULT '' COMMENT '管理员微信号',
  `last_login` int(32) NOT NULL DEFAULT '0',
  `last_ip` varchar(32) NOT NULL DEFAULT '',
  `role_id` int(10) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `login_num` int(32) NOT NULL DEFAULT '0',
  `create_by` varchar(16) NOT NULL DEFAULT '' COMMENT '创建者',
  `remark` text COMMENT '备注',
  `created` int(32) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '1', 'ohs_4sgyk31vkfKLHy2wg5HrrGeo', '1465958775', '127.0.0.1', '1', '496', '', null, '1360085491');
INSERT INTO `admin` VALUES ('3', 'yunying1', '96e79218965eb72c92a549dd5a330112', 'asdf', '1', '', '1465970684', '127.0.0.1', '2', '5', 'admin', 'asdf', '1465961416');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL DEFAULT '' COMMENT '标题',
  `summary` varchar(512) NOT NULL DEFAULT '' COMMENT '摘要',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类',
  `image` varchar(256) NOT NULL DEFAULT '' COMMENT '图片地址',
  `content` longtext,
  `view_count` smallint(6) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否热门',
  `created` int(11) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `seo_title` varchar(64) NOT NULL DEFAULT '' COMMENT '标题',
  `seo_keyword` varchar(512) NOT NULL DEFAULT '' COMMENT '关键词',
  `seo_description` text COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', '国金所金融控股董事长何玉山受邀云滴科技开幕典礼', '云滴公司是一家综合型互联网公司，隶属于云南盛达集团。云滴公司服务面涵盖交通，旅游，物流，教育，农业，金融等多个领域，充分发挥互联网在社会资源配置中的优化和集成作用，将互联网的创新成果深度融合于各个领域之中。', '1', '/static/images/news/news-cover-big.png', '&#60;p&#62;云滴公司是一家综合型互联网公司，隶属于云南盛达集团。云滴公司服务面涵盖交通，旅游，物流，教育，农业，金融等多个领域，充分发挥互联网在社会资源配置中的优化和集成作用，将互联网的创新成果深度融合于各个领域之中。&#60;&#47;p&#62;', '1232', '1', '1462519710', '', '', null);

-- ----------------------------
-- Table structure for `news_category`
-- ----------------------------
DROP TABLE IF EXISTS `news_category`;
CREATE TABLE `news_category` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '新闻类名称',
  `pid` tinyint(2) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `created` int(32) NOT NULL DEFAULT '0',
  `seo_title` varchar(64) NOT NULL DEFAULT '' COMMENT '标题',
  `seo_keyword` varchar(512) NOT NULL DEFAULT '' COMMENT '关键词',
  `seo_description` text COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_category
-- ----------------------------
INSERT INTO `news_category` VALUES ('1', '云滴旅行', '0', '10', '1463559139', '', '', null);
INSERT INTO `news_category` VALUES ('2', '云滴生活', '0', '20', '1463559149', '', '', null);
INSERT INTO `news_category` VALUES ('3', '云滴活动', '0', '30', '1463559157', '', '', null);
INSERT INTO `news_category` VALUES ('4', '云滴动态', '0', '40', '1463559165', '', '', null);

-- ----------------------------
-- Table structure for `rbac_menu`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_menu`;
CREATE TABLE `rbac_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '菜单标题',
  `controller_action` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器和方法',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `sorting` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `menu_desc` varchar(512) NOT NULL DEFAULT '' COMMENT '描述',
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0不显示，1显示',
  `created` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rbac_menu
-- ----------------------------
INSERT INTO `rbac_menu` VALUES ('1', '新闻资讯', '#', '0', '1', '新闻资讯', '1', '1465717449');
INSERT INTO `rbac_menu` VALUES ('3', '分类管理', 'news_category/index', '1', '0', '', '1', '1465719290');
INSERT INTO `rbac_menu` VALUES ('5', '分类添加', 'news_category/create', '3', '0', '', '0', '1465720556');
INSERT INTO `rbac_menu` VALUES ('6', '分类修改', 'news_category/update', '3', '0', '', '0', '1465720865');
INSERT INTO `rbac_menu` VALUES ('7', '分类添加操作', 'news_category/createSave', '3', '0', '', '0', '1465720894');
INSERT INTO `rbac_menu` VALUES ('8', '分类修改操作', 'news_category/updateSave', '3', '0', '', '0', '1465720912');
INSERT INTO `rbac_menu` VALUES ('9', '分类删除', 'news_category/delete', '3', '0', '', '0', '1465720927');
INSERT INTO `rbac_menu` VALUES ('10', '资讯管理', 'news/index', '1', '0', '', '1', '1465721371');
INSERT INTO `rbac_menu` VALUES ('11', '添加资讯', 'news/create', '10', '0', '', '0', '1465721408');
INSERT INTO `rbac_menu` VALUES ('12', '修改资讯', 'news/update', '10', '0', '', '0', '1465721437');
INSERT INTO `rbac_menu` VALUES ('13', '添加资讯操作', 'news/createSave', '10', '0', '', '0', '1465722053');
INSERT INTO `rbac_menu` VALUES ('14', '修改资讯操作', 'news/updateSave', '10', '0', '', '0', '1465722117');
INSERT INTO `rbac_menu` VALUES ('15', '删除资讯', 'news/delete', '10', '0', '', '0', '1465722130');
INSERT INTO `rbac_menu` VALUES ('16', '权限配置', '#', '0', '2', '', '1', '1465722242');
INSERT INTO `rbac_menu` VALUES ('17', '菜单管理', 'rbac_menu/index', '16', '0', '', '1', '1465722289');
INSERT INTO `rbac_menu` VALUES ('18', '菜单添加', 'rbac_menu/create', '17', '0', '', '0', '1465722306');
INSERT INTO `rbac_menu` VALUES ('19', '菜单修改', 'rbac_menu/update', '17', '0', '', '0', '1465722323');
INSERT INTO `rbac_menu` VALUES ('20', '菜单添加操作', 'rbac_menu/createSave', '17', '0', '', '1', '1465722342');
INSERT INTO `rbac_menu` VALUES ('21', '菜单修改操作', 'rbac_menu/updateSave', '17', '0', '', '0', '1465722358');
INSERT INTO `rbac_menu` VALUES ('22', '删除菜单', 'rbac_menu/delete', '17', '0', '', '0', '1465722376');
INSERT INTO `rbac_menu` VALUES ('23', '管理员管理', 'admin/index', '16', '0', '', '1', '1465896372');
INSERT INTO `rbac_menu` VALUES ('24', '角色管理', 'role/index', '16', '0', '', '1', '1465896396');
INSERT INTO `rbac_menu` VALUES ('25', '修改角色', 'role/update', '24', '0', '', '0', '1465898535');
INSERT INTO `rbac_menu` VALUES ('26', '添加角色', 'role/create', '24', '0', '', '0', '1465898594');
INSERT INTO `rbac_menu` VALUES ('27', '修改角色-操作', 'role/updateSave', '24', '0', '', '0', '1465898621');
INSERT INTO `rbac_menu` VALUES ('28', '添加角色-操作', 'role/createSave', '24', '0', '', '0', '1465898667');
INSERT INTO `rbac_menu` VALUES ('29', '删除角色', 'role/delete', '24', '0', '', '0', '1465898678');
INSERT INTO `rbac_menu` VALUES ('30', '编辑权限', 'role/permission', '24', '0', '', '0', '1465898721');

-- ----------------------------
-- Table structure for `rbac_role`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_role`;
CREATE TABLE `rbac_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名称',
  `role_desc` varchar(64) NOT NULL DEFAULT '' COMMENT '角色描述',
  `token` varchar(108) NOT NULL DEFAULT '' COMMENT '令牌',
  `permission` text COMMENT '权限,menu_id用逗号隔开',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 （1 正常 ，2 删除）',
  `created` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of rbac_role
-- ----------------------------
INSERT INTO `rbac_role` VALUES ('2', '运营专员', 'dfasdf', '', '1,3,5,7,8,10,11,13,14', '1', '1465898275');

-- ----------------------------
-- Table structure for `upload`
-- ----------------------------
DROP TABLE IF EXISTS `upload`;
CREATE TABLE `upload` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_type` int(10) NOT NULL DEFAULT '0' COMMENT '用户类型，管理平台0',
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `item_type` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `file` varchar(50) NOT NULL,
  `size` int(10) NOT NULL DEFAULT '0',
  `ext` varchar(5) NOT NULL,
  `thumbs` varchar(32) NOT NULL COMMENT '缩略图',
  `uniqid` varchar(15) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1->被使用，2->已删除',
  `created` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `file` (`file`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='上传表';

-- ----------------------------
-- Records of upload
-- ----------------------------
INSERT INTO `upload` VALUES ('1', '0', '0', '0', '0', '573c4331bf0af.jpg', '/upload/1605/1818/25/573c4331bf0af.jpg', '162944', 'jpg', '', '', '1', '1463567153');
INSERT INTO `upload` VALUES ('2', '0', '0', '0', '0', '573c43782e07a.jpg', '/upload/1605/1818/27/573c43782e07a.jpg', '233009', 'jpg', '', '', '1', '1463567224');
INSERT INTO `upload` VALUES ('3', '0', '0', '0', '0', '573c438838ff0.jpg', '/upload/1605/1818/27/573c438838ff0.jpg', '233009', 'jpg', '', '', '1', '1463567240');
INSERT INTO `upload` VALUES ('4', '0', '0', '0', '0', '573c43c2c4bae.jpg', '/upload/1605/1818/28/573c43c2c4bae.jpg', '233009', 'jpg', '', '', '1', '1463567298');
INSERT INTO `upload` VALUES ('5', '0', '0', '0', '0', '573c440b11133.jpg', '/upload/1605/1818/29/573c440b11133.jpg', '233009', 'jpg', '', '', '1', '1463567371');
INSERT INTO `upload` VALUES ('6', '0', '0', '0', '0', '573c4432918e8.jpg', '/upload/1605/1818/30/573c4432918e8.jpg', '233009', 'jpg', '', '', '1', '1463567410');
INSERT INTO `upload` VALUES ('7', '0', '0', '0', '0', '573c4479c41c9.jpg', '/upload/1605/1818/31/573c4479c41c9.jpg', '233009', 'jpg', '', '', '1', '1463567481');
INSERT INTO `upload` VALUES ('8', '0', '0', '0', '0', '573c44878456b.jpg', '/upload/1605/1818/31/573c44878456b.jpg', '233009', 'jpg', '', '', '1', '1463567495');
INSERT INTO `upload` VALUES ('9', '0', '0', '0', '0', '573c449dd0557.jpg', '/upload/1605/1818/31/573c449dd0557.jpg', '233009', 'jpg', '', '', '1', '1463567517');
INSERT INTO `upload` VALUES ('10', '0', '0', '0', '0', '573c44cd61e9e.jpg', '/upload/1605/1818/32/573c44cd61e9e.jpg', '233009', 'jpg', '', '', '1', '1463567565');
INSERT INTO `upload` VALUES ('11', '0', '0', '0', '0', '573c44e18559f.jpg', '/upload/1605/1818/33/573c44e18559f.jpg', '162944', 'jpg', '', '', '1', '1463567585');
INSERT INTO `upload` VALUES ('12', '0', '0', '0', '0', '573c44e8906fa.jpg', '/upload/1605/1818/33/573c44e8906fa.jpg', '233009', 'jpg', '', '', '1', '1463567592');
INSERT INTO `upload` VALUES ('13', '0', '0', '0', '0', '573c44e89f92d.jpg', '/upload/1605/1818/33/573c44e89f92d.jpg', '162944', 'jpg', '', '', '1', '1463567592');
INSERT INTO `upload` VALUES ('14', '0', '0', '0', '0', '573c45177d50d.jpg', '/upload/1605/1818/33/573c45177d50d.jpg', '162944', 'jpg', '', '', '1', '1463567639');
INSERT INTO `upload` VALUES ('15', '0', '0', '0', '0', '573c452d935a5.jpg', '/upload/1605/1818/34/573c452d935a5.jpg', '233009', 'jpg', '', '', '1', '1463567661');
INSERT INTO `upload` VALUES ('16', '0', '0', '0', '0', '573c453e19065.jpg', '/upload/1605/1818/34/573c453e19065.jpg', '233009', 'jpg', '', '', '1', '1463567678');
INSERT INTO `upload` VALUES ('17', '0', '0', '0', '0', '573c45e14fcb4.jpg', '/upload/1605/1818/37/573c45e14fcb4.jpg', '162944', 'jpg', '', '', '1', '1463567841');
INSERT INTO `upload` VALUES ('18', '0', '0', '0', '0', '573c45f52a3ac.jpg', '/upload/1605/1818/37/573c45f52a3ac.jpg', '233009', 'jpg', '', '', '1', '1463567861');
INSERT INTO `upload` VALUES ('19', '0', '0', '0', '0', '573c46054d9c7.jpg', '/upload/1605/1818/37/573c46054d9c7.jpg', '233009', 'jpg', '', '', '1', '1463567877');
INSERT INTO `upload` VALUES ('20', '0', '0', '0', '0', '573c461d4f2ac.jpg', '/upload/1605/1818/38/573c461d4f2ac.jpg', '233009', 'jpg', '', '', '1', '1463567901');
INSERT INTO `upload` VALUES ('21', '0', '0', '0', '0', '573c46364b1f1.jpg', '/upload/1605/1818/38/573c46364b1f1.jpg', '233009', 'jpg', '', '', '1', '1463567926');
INSERT INTO `upload` VALUES ('22', '0', '0', '0', '0', '573c46452d0e4.jpg', '/upload/1605/1818/39/573c46452d0e4.jpg', '233009', 'jpg', '', '', '1', '1463567941');
INSERT INTO `upload` VALUES ('23', '0', '0', '0', '0', '573c465091119.jpg', '/upload/1605/1818/39/573c465091119.jpg', '233009', 'jpg', '', '', '1', '1463567952');
INSERT INTO `upload` VALUES ('24', '0', '0', '0', '0', '573c465af0eab.jpg', '/upload/1605/1818/39/573c465af0eab.jpg', '233009', 'jpg', '', '', '1', '1463567962');
INSERT INTO `upload` VALUES ('25', '0', '0', '0', '0', '573c468ef2602.jpg', '/upload/1605/1818/40/573c468ef2602.jpg', '233009', 'jpg', '', '', '1', '1463568014');
INSERT INTO `upload` VALUES ('26', '0', '0', '0', '0', '573c46ce4d7d0.jpg', '/upload/1605/1818/41/573c46ce4d7d0.jpg', '233009', 'jpg', '', '', '1', '1463568078');
INSERT INTO `upload` VALUES ('27', '0', '0', '0', '0', '573c4711271d7.jpg', '/upload/1605/1818/42/573c4711271d7.jpg', '233009', 'jpg', '', '', '1', '1463568145');
INSERT INTO `upload` VALUES ('28', '0', '0', '0', '0', '573c4718ea4ad.jpg', '/upload/1605/1818/42/573c4718ea4ad.jpg', '233009', 'jpg', '', '', '1', '1463568152');
INSERT INTO `upload` VALUES ('29', '0', '0', '0', '0', '573d162d387db.jpg', '/upload/1605/1909/26/573d162d387db.jpg', '233009', 'jpg', '', '', '1', '1463621165');
INSERT INTO `upload` VALUES ('30', '0', '0', '0', '0', '573d16a47442f.jpg', '/upload/1605/1909/28/573d16a47442f.jpg', '233009', 'jpg', '', '', '1', '1463621284');
INSERT INTO `upload` VALUES ('31', '0', '0', '0', '0', '573d16b0dea2f.jpg', '/upload/1605/1909/28/573d16b0dea2f.jpg', '233009', 'jpg', '', '', '1', '1463621296');
INSERT INTO `upload` VALUES ('32', '0', '0', '0', '0', '573d16be3a071.jpg', '/upload/1605/1909/28/573d16be3a071.jpg', '233009', 'jpg', '', '', '1', '1463621310');
INSERT INTO `upload` VALUES ('33', '0', '0', '0', '0', '573d170768373.jpg', '/upload/1605/1909/29/573d170768373.jpg', '220014', 'jpg', '', '', '1', '1463621383');
INSERT INTO `upload` VALUES ('34', '0', '0', '0', '0', '573d170b7e7d5.jpg', '/upload/1605/1909/29/573d170b7e7d5.jpg', '233009', 'jpg', '', '', '1', '1463621387');
INSERT INTO `upload` VALUES ('35', '0', '0', '0', '0', '573d17135ab5e.jpg', '/upload/1605/1909/29/573d17135ab5e.jpg', '220014', 'jpg', '', '', '1', '1463621395');
INSERT INTO `upload` VALUES ('36', '0', '0', '0', '0', '573d17198ecca.jpg', '/upload/1605/1909/30/573d17198ecca.jpg', '220014', 'jpg', '', '', '1', '1463621401');
INSERT INTO `upload` VALUES ('37', '0', '0', '0', '0', '573d1719b0fb2.jpg', '/upload/1605/1909/30/573d1719b0fb2.jpg', '233009', 'jpg', '', '', '1', '1463621401');
INSERT INTO `upload` VALUES ('38', '0', '0', '0', '0', '573d1719cadc8.jpg', '/upload/1605/1909/30/573d1719cadc8.jpg', '162944', 'jpg', '', '', '1', '1463621401');
INSERT INTO `upload` VALUES ('39', '0', '0', '0', '0', '573d185bd2883.jpg', '/upload/1605/1909/35/573d185bd2883.jpg', '220014', 'jpg', '', '', '1', '1463621723');
INSERT INTO `upload` VALUES ('40', '0', '0', '0', '0', '573d1878a0e2a.jpg', '/upload/1605/1909/35/573d1878a0e2a.jpg', '220014', 'jpg', '', '', '1', '1463621752');
INSERT INTO `upload` VALUES ('41', '0', '0', '0', '0', '573d187b07d7a.jpg', '/upload/1605/1909/35/573d187b07d7a.jpg', '233009', 'jpg', '', '', '1', '1463621755');
INSERT INTO `upload` VALUES ('42', '0', '0', '0', '0', '573d187e05715.jpg', '/upload/1605/1909/35/573d187e05715.jpg', '162944', 'jpg', '', '', '1', '1463621758');
INSERT INTO `upload` VALUES ('43', '0', '0', '0', '0', '573d18ade63b9.jpg', '/upload/1605/1909/36/573d18ade63b9.jpg', '220014', 'jpg', '', '', '1', '1463621805');
INSERT INTO `upload` VALUES ('44', '0', '0', '0', '0', '573d18ebecf55.jpg', '/upload/1605/1909/37/573d18ebecf55.jpg', '233009', 'jpg', '', '', '1', '1463621867');
INSERT INTO `upload` VALUES ('45', '0', '0', '0', '0', '573d193cd56e1.jpg', '/upload/1605/1909/39/573d193cd56e1.jpg', '220014', 'jpg', '', '', '1', '1463621948');
INSERT INTO `upload` VALUES ('46', '0', '0', '0', '0', '573d197e0c311.jpg', '/upload/1605/1909/40/573d197e0c311.jpg', '233009', 'jpg', '', '', '1', '1463622014');
INSERT INTO `upload` VALUES ('47', '0', '0', '0', '0', '573d1988ee2c9.jpg', '/upload/1605/1909/40/573d1988ee2c9.jpg', '220014', 'jpg', '', '', '1', '1463622024');
INSERT INTO `upload` VALUES ('48', '0', '0', '0', '0', '573d1b5b98a64.jpg', '/upload/1605/1909/48/573d1b5b98a64.jpg', '220014', 'jpg', '', '', '1', '1463622491');
INSERT INTO `upload` VALUES ('49', '0', '0', '0', '0', '573d1d7363189.jpg', '/upload/1605/1909/57/573d1d7363189.jpg', '233009', 'jpg', '', '', '1', '1463623027');
INSERT INTO `upload` VALUES ('50', '0', '0', '0', '0', '573d1d8f7d1f9.jpg', '/upload/1605/1909/57/573d1d8f7d1f9.jpg', '233009', 'jpg', '', '', '1', '1463623055');
INSERT INTO `upload` VALUES ('51', '0', '0', '0', '0', '573d1d9f3419b.jpg', '/upload/1605/1909/57/573d1d9f3419b.jpg', '135487', 'jpg', '', '', '1', '1463623071');
INSERT INTO `upload` VALUES ('52', '0', '0', '0', '0', '573d1dd5a23c5.jpg', '/upload/1605/1909/58/573d1dd5a23c5.jpg', '233009', 'jpg', '', '', '1', '1463623125');
INSERT INTO `upload` VALUES ('53', '0', '0', '0', '0', '573d1e0c0aa6c.jpg', '/upload/1605/1909/59/573d1e0c0aa6c.jpg', '220014', 'jpg', '', '', '1', '1463623180');
INSERT INTO `upload` VALUES ('54', '0', '0', '0', '0', '573d1ed812df2.jpg', '/upload/1605/1910/03/573d1ed812df2.jpg', '233009', 'jpg', '', '', '1', '1463623384');
INSERT INTO `upload` VALUES ('55', '0', '0', '0', '0', '573d1ee21a947.jpg', '/upload/1605/1910/03/573d1ee21a947.jpg', '162944', 'jpg', '', '', '1', '1463623394');
INSERT INTO `upload` VALUES ('56', '0', '0', '0', '0', '573d1f0b23b2b.jpg', '/upload/1605/1910/03/573d1f0b23b2b.jpg', '233009', 'jpg', '', '', '1', '1463623435');
INSERT INTO `upload` VALUES ('57', '0', '0', '0', '0', '573d1f11a81d1.jpg', '/upload/1605/1910/04/573d1f11a81d1.jpg', '162944', 'jpg', '', '', '1', '1463623441');
INSERT INTO `upload` VALUES ('58', '0', '0', '0', '0', '573d201533dd5.jpg', '/upload/1605/1910/08/573d201533dd5.jpg', '162944', 'jpg', '', '', '1', '1463623701');
INSERT INTO `upload` VALUES ('59', '0', '0', '0', '0', '573d24bb04c22.jpg', '/upload/1605/1910/28/573d24bb04c22.jpg', '162944', 'jpg', '', '', '1', '1463624891');
INSERT INTO `upload` VALUES ('60', '0', '0', '0', '0', '573d24c0571bb.jpg', '/upload/1605/1910/28/573d24c0571bb.jpg', '135487', 'jpg', '', '', '1', '1463624896');
INSERT INTO `upload` VALUES ('61', '0', '0', '0', '0', '573d9321a5956.jpg', '/upload/1605/1918/19/573d9321a5956.jpg', '220014', 'jpg', '', '', '1', '1463653153');
