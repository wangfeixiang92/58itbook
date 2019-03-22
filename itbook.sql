/*
Navicat MySQL Data Transfer

Source Server         : 虚拟机
Source Server Version : 50725
Source Host           : 192.168.33.10:3306
Source Database       : itbook

Target Server Type    : MYSQL
Target Server Version : 50725
File Encoding         : 65001

Date: 2019-03-22 18:59:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uId` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `userName` varchar(30) DEFAULT '' COMMENT '用户昵称',
  `password` varchar(255) DEFAULT '' COMMENT '密码',
  `photo` varchar(255) DEFAULT '' COMMENT '照片',
  `address` varchar(255) DEFAULT '' COMMENT '个人地址',
  `cName` varchar(30) DEFAULT '' COMMENT '匿名',
  `phone` varchar(20) DEFAULT '' COMMENT '手机号',
  `email` varchar(100) DEFAULT '' COMMENT '邮箱',
  `github` varchar(100) DEFAULT '' COMMENT 'github地址',
  `qq` varchar(20) DEFAULT '' COMMENT '邮箱',
  `wechat` varchar(50) DEFAULT '' COMMENT '微信号',
  `sex` tinyint(1) DEFAULT '2' COMMENT '1-男 0-女 2-保密',
  `level` tinyint(3) DEFAULT '0' COMMENT '等级',
  `levelName` varchar(30) DEFAULT '' COMMENT '等级称号',
  `reputation` int(10) DEFAULT '0' COMMENT '信誉值',
  `lucky` int(10) DEFAULT '0' COMMENT '幸运值',
  `experience` int(10) DEFAULT '0' COMMENT '经验',
  `ITmoney` int(10) DEFAULT '0' COMMENT 'IT币',
  `money` int(10) NOT NULL DEFAULT '0' COMMENT '余额',
  `status` tinyint(2) DEFAULT '0' COMMENT '0-正常  -1-黑名单',
  `isDelete` tinyint(2) DEFAULT '0' COMMENT '0-正常 1-删除',
  `registerTime` datetime DEFAULT NULL COMMENT '注册时间',
  `logoutTime` varchar(20) DEFAULT '' COMMENT '上次退出时间',
  `loginTime` varchar(20) DEFAULT '' COMMENT '最近登陆时间',
  `isSystem` tinyint(2) DEFAULT '0' COMMENT '0-正常用户 1-系统用户',
  `updateTime` varchar(20) DEFAULT '' COMMENT '更新时间',
  `salt` varchar(32) DEFAULT '' COMMENT '密码盐值',
  `label` varchar(255) DEFAULT '' COMMENT '签名',
  `introduction` text COMMENT '简介',
  PRIMARY KEY (`uId`,`money`),
  UNIQUE KEY `userName` (`userName`,`isDelete`) USING BTREE,
  UNIQUE KEY `email` (`email`,`isDelete`) USING BTREE,
  UNIQUE KEY `phone` (`phone`,`isDelete`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('32', 'wfx', '$2y$13$j/Re5CPAQD.cQ6wydbB5quVjclfwrbsXEkwXYJwCIeaPcKmp9e8pe', 'img/profile_small.jpg', '', '', '', '2579552905@qq.com', '', '', '', '2', '1', '小白期', '0', '0', '0', '0', '0', '0', '0', '2019-03-20 03:00:17', '1553069339', '1553050817', '0', '1553052704', 'DzcSlWy1KVogJQ9FI3HNaBrIySxC2K1L', '', null);

-- ----------------------------
-- Table structure for userLevelName
-- ----------------------------
DROP TABLE IF EXISTS `userLevelName`;
CREATE TABLE `userLevelName` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `levelName` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '等级',
  `level` tinyint(3) NOT NULL DEFAULT '0' COMMENT '等级',
  `experience` int(10) NOT NULL DEFAULT '0' COMMENT '经验',
  `describe` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '描述',
  `isDelete` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0-存在 1-删除',
  `reward` float(2,1) NOT NULL DEFAULT '0.0' COMMENT 'IT币奖励倍数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COMMENT='用户等级表';

-- ----------------------------
-- Records of userLevelName
-- ----------------------------
INSERT INTO `userLevelName` VALUES ('1', '小白期', '1', '10', '', '0', '1.0');
INSERT INTO `userLevelName` VALUES ('2', '菜鸟期', '2', '100', '', '0', '1.5');
INSERT INTO `userLevelName` VALUES ('3', '发车期', '3', '200', '', '0', '2.0');
INSERT INTO `userLevelName` VALUES ('4', '飙车期', '4', '400', '', '0', '2.5');
INSERT INTO `userLevelName` VALUES ('5', '超车期', '5', '800', '', '0', '3.0');
INSERT INTO `userLevelName` VALUES ('6', '老司机', '6', '1600', '', '0', '3.5');
INSERT INTO `userLevelName` VALUES ('7', '脱发期', '7', '3200', '', '0', '4.0');
INSERT INTO `userLevelName` VALUES ('8', '秃顶期', '8', '6400', '', '0', '4.5');
INSERT INTO `userLevelName` VALUES ('9', '顿悟期', '9', '12800', '', '0', '5.0');
INSERT INTO `userLevelName` VALUES ('10', '大佬期', '10', '25600', '', '0', '5.5');
INSERT INTO `userLevelName` VALUES ('11', '女装大佬期', '11', '51200', '', '0', '6.0');

-- ----------------------------
-- Table structure for webSource
-- ----------------------------
DROP TABLE IF EXISTS `webSource`;
CREATE TABLE `webSource` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uId` int(10) NOT NULL DEFAULT '0' COMMENT '用户Id',
  `title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '标题',
  `keyword` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '关键字',
  `describe` text CHARACTER SET utf8 COMMENT '描述',
  `manual` text CHARACTER SET utf8 COMMENT '使用手册，说明',
  `subjectId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '科目Id',
  `oldUrl` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '官网地址',
  `coverUrl` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '封面图',
  `previewUrl` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '预览地址',
  `soureUrl` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '资源Url',
  `browseNum` int(10) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `collectionNum` int(10) NOT NULL DEFAULT '0' COMMENT '收藏数',
  `likeNum` int(10) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `shareNum` int(10) NOT NULL DEFAULT '0' COMMENT '分享数',
  `commentNum` int(10) NOT NULL DEFAULT '0' COMMENT '评论数',
  `downloadNum` int(10) NOT NULL DEFAULT '0' COMMENT '下载数',
  `price` int(10) NOT NULL DEFAULT '0' COMMENT '价格',
  `registerTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '-1 锁定 0-审核 1上线 ',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `IE` tinyint(2) NOT NULL DEFAULT '8' COMMENT 'IE兼容',
  `isIE` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否兼容IE',
  `isFirefox` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否兼容火狐',
  `isChrome` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否兼容Chrome',
  `isSafari` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否兼容Safari',
  `isResponseType` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否响应式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COMMENT='web资源表';

-- ----------------------------
-- Records of webSource
-- ----------------------------
INSERT INTO `webSource` VALUES ('34', '32', 'H+ 后台主题UI框架', '后端,H+,Bootstrap3,扁平化，html5,css3', 'H+是一个完全响应式，基于Bootstrap3.3.6最新版本开发的扁平化主题,她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术写成的一款后端框架', '<p><span style=\"color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">H+是一个完全响应式，基于Bootstrap3.3.6最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术，她提供了诸多的强大的可以重新组合的UI组件，并集成了最新的jQuery版本(v2.1.4)，当然，也集成了很多功能强大，用途广泛的jQuery插件，她可以用于所有的Web应用程序，如</span><span style=\"box-sizing: border-box; font-weight: 700; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">网站管理后台</span><span style=\"color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">，</span><span style=\"box-sizing: border-box; font-weight: 700; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">网站会员中心</span><span style=\"color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">，</span><span style=\"box-sizing: border-box; font-weight: 700; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">CMS</span><span style=\"color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">，</span><span style=\"box-sizing: border-box; font-weight: 700; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">CRM</span><span style=\"color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">，</span><span style=\"box-sizing: border-box; font-weight: 700; color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">OA</span><span style=\"color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\">等等，当然，您也可以对她进行深度定制，以做出更强系统。</span></p><p><span style=\"color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\"><img src=\"/ueditor/php/upload/image/20190321/1553148379520994.png\" title=\"1553148379520994.png\" alt=\"image.png\"/></span></p><p><span style=\"color: rgb(103, 106, 108); font-family: &quot;open sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);\"><img src=\"/ueditor/php/upload/image/20190321/1553148404966509.png\" title=\"1553148404966509.png\" alt=\"image.png\"/><img src=\"/ueditor/php/upload/image/20190321/1553148437902609.png\" title=\"1553148437902609.png\" alt=\"image.png\"/></span></p>', '0', '', '', 'resources/preview/228156.zip', 'resources/web/190321/228156.zip', '0', '0', '0', '0', '0', '0', '50', '2019-03-21 06:07:30', '1553148450', '0', '0', '8', '1', '1', '1', '1', '0');

-- ----------------------------
-- Table structure for webSubject
-- ----------------------------
DROP TABLE IF EXISTS `webSubject`;
CREATE TABLE `webSubject` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '科目名称',
  `sort` int(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父级id',
  `level` int(3) NOT NULL DEFAULT '0' COMMENT '等级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COMMENT='web分类表';

-- ----------------------------
-- Records of webSubject
-- ----------------------------
INSERT INTO `webSubject` VALUES ('1', '模板分类', '0', '0', '0', '0');
INSERT INTO `webSubject` VALUES ('2', '模板颜色', '1', '0', '0', '0');
INSERT INTO `webSubject` VALUES ('3', '模板布局', '2', '0', '0', '0');
INSERT INTO `webSubject` VALUES ('4', '模板语言', '3', '0', '0', '0');
INSERT INTO `webSubject` VALUES ('6', '行业', '1', '0', '1', '1');
INSERT INTO `webSubject` VALUES ('7', '商城', '2', '0', '1', '1');
INSERT INTO `webSubject` VALUES ('8', '企业', '3', '0', '1', '1');
INSERT INTO `webSubject` VALUES ('9', '专题', '4', '0', '1', '1');
INSERT INTO `webSubject` VALUES ('10', '后台', '5', '0', '1', '1');
INSERT INTO `webSubject` VALUES ('11', '其他', '6', '0', '1', '1');
INSERT INTO `webSubject` VALUES ('12', '旅游酒店', '1', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('13', '网络设计', '2', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('14', '房地产', '3', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('15', '婚庆摄影', '4', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('16', '家政家教', '5', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('17', '教育培训', '6', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('18', '办公OA', '7', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('19', '求职招聘', '8', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('20', '食品', '9', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('21', '医院医疗', '10', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('22', '金融贷款', '11', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('23', '房产租赁', '12', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('24', '视频影视', '13', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('25', '游戏', '14', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('26', '订餐外送', '15', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('27', '科技', '16', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('28', '生活服务', '17', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('29', '时尚美容', '18', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('30', '情感交友', '19', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('31', '汽车', '20', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('32', '农业养殖', '21', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('33', '养生', '22', '0', '6', '2');
INSERT INTO `webSubject` VALUES ('37', '团购', '1', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('38', '商务平台', '2', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('39', '返利', '3', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('40', '海淘', '4', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('41', '数码电器', '5', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('42', '服装鞋帽', '6', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('43', '水果蔬菜', '7', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('44', '鲜花礼品', '8', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('45', '美容化妆', '9', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('46', '珠宝配饰', '10', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('47', '装饰家居', '11', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('48', '零食食品', '12', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('54', '团购', '1', '0', '7', '2');
INSERT INTO `webSubject` VALUES ('55', '网络公司', '1', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('56', '设计公司', '2', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('57', '婚纱摄影', '3', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('58', '咨询公司', '4', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('59', '软件科技', '5', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('60', '办公家具', '6', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('61', '生活旅游', '7', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('62', '教育培训', '8', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('63', '广告传媒', '9', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('64', '政府部门', '10', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('65', '项目工程', '11', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('66', '设备自动化', '12', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('67', '美容化妆', '13', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('68', '单页模板', '14', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('69', '医院医疗', '15', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('70', '物业租赁', '16', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('71', '环保卫生', '17', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('72', '房地产建筑', '18', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('73', '农业养殖', '19', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('74', '服装', '20', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('75', '亲子母婴', '21', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('76', '快递物流', '22', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('77', '行业模板', '23', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('78', '汽车配件', '24', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('79', '装修公司', '25', '0', '8', '2');
INSERT INTO `webSubject` VALUES ('80', '淘宝', '1', '0', '9', '2');
INSERT INTO `webSubject` VALUES ('81', '医院', '2', '0', '9', '2');
INSERT INTO `webSubject` VALUES ('82', '节日', '3', '0', '9', '2');
INSERT INTO `webSubject` VALUES ('83', '活动', '4', '0', '9', '2');
INSERT INTO `webSubject` VALUES ('84', '测试', '5', '0', '9', '2');
INSERT INTO `webSubject` VALUES ('85', '企业宣传', '6', '0', '9', '2');
INSERT INTO `webSubject` VALUES ('86', '登录界面', '1', '0', '10', '2');
INSERT INTO `webSubject` VALUES ('87', 'bootstrap', '2', '0', '10', '2');
INSERT INTO `webSubject` VALUES ('88', '国外后台模板', '3', '0', '10', '2');
INSERT INTO `webSubject` VALUES ('89', '企业后台模板', '4', '0', '10', '2');
INSERT INTO `webSubject` VALUES ('90', 'CMS后台模板', '5', '0', '10', '2');
INSERT INTO `webSubject` VALUES ('91', 'OA系统', '6', '0', '10', '2');
INSERT INTO `webSubject` VALUES ('92', 'div+css', '7', '0', '10', '2');
INSERT INTO `webSubject` VALUES ('93', '常用后台模板', '8', '0', '10', '2');
INSERT INTO `webSubject` VALUES ('94', '门户资讯', '1', '0', '11', '2');
INSERT INTO `webSubject` VALUES ('95', '个人博客', '2', '0', '11', '2');
INSERT INTO `webSubject` VALUES ('96', '笑话', '3', '0', '11', '2');
INSERT INTO `webSubject` VALUES ('97', '网址导航', '4', '0', '11', '2');
INSERT INTO `webSubject` VALUES ('98', '登录注册', '5', '0', '11', '2');
INSERT INTO `webSubject` VALUES ('99', '个人中心', '6', '0', '11', '2');
INSERT INTO `webSubject` VALUES ('100', '404', '7', '0', '11', '2');
INSERT INTO `webSubject` VALUES ('101', 'app', '8', '0', '11', '2');
INSERT INTO `webSubject` VALUES ('102', '引导', '9', '0', '11', '2');
INSERT INTO `webSubject` VALUES ('103', '蓝色', '1', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('104', '红色', '2', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('105', '橙色', '3', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('106', '黄色', '4', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('107', '绿色', '5', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('108', '黑白', '6', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('109', '灰色', '7', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('110', '黑色', '8', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('111', '白色', '8', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('112', '粉色', '9', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('113', '多色', '10', '0', '2', '1');
INSERT INTO `webSubject` VALUES ('114', '常列', '1', '0', '3', '1');
INSERT INTO `webSubject` VALUES ('115', '两列', '2', '0', '3', '1');
INSERT INTO `webSubject` VALUES ('116', '滚动', '3', '0', '3', '1');
INSERT INTO `webSubject` VALUES ('117', '全屏', '4', '0', '3', '1');
INSERT INTO `webSubject` VALUES ('118', '响应式', '5', '0', '3', '1');
INSERT INTO `webSubject` VALUES ('119', '手机wap', '6', '0', '3', '1');
INSERT INTO `webSubject` VALUES ('120', 'app模板', '7', '0', '3', '1');
INSERT INTO `webSubject` VALUES ('121', 'iframe', '8', '0', '3', '1');
INSERT INTO `webSubject` VALUES ('122', 'table', '9', '0', '3', '1');
INSERT INTO `webSubject` VALUES ('123', '中文模板', '1', '0', '4', '1');
INSERT INTO `webSubject` VALUES ('124', '英文模板', '2', '0', '4', '1');
INSERT INTO `webSubject` VALUES ('125', '俄语模板', '3', '0', '4', '1');

-- ----------------------------
-- Table structure for webSubRelation
-- ----------------------------
DROP TABLE IF EXISTS `webSubRelation`;
CREATE TABLE `webSubRelation` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `subId` int(10) NOT NULL DEFAULT '0' COMMENT '科目ID',
  `webId` int(10) NOT NULL DEFAULT '0' COMMENT '网页Id',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `level` int(2) NOT NULL DEFAULT '0' COMMENT '分类定级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='web与分类关系表';

-- ----------------------------
-- Records of webSubRelation
-- ----------------------------
