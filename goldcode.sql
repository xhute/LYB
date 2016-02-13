# Host: localhost  (Version: 5.5.47)
# Date: 2016-02-01 17:10:25
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "goldcode"
#

DROP TABLE IF EXISTS `goldcode`;
CREATE TABLE `goldcode` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT '兑换码',
  `value` float(16,2) NOT NULL DEFAULT '0.00' COMMENT 'RMB价值,可以为小数',
  `game` varchar(255) DEFAULT NULL COMMENT '游戏名称',
  `room` varchar(255) DEFAULT NULL COMMENT '分区',
  `valid` tinyint(3) NOT NULL DEFAULT '1' COMMENT '兑换码是否有效',
  `generator` varchar(255) DEFAULT NULL COMMENT '生产者',
  `gentime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '生成时间',
  `usetime` datetime DEFAULT NULL COMMENT '使用时间',
  `user` varchar(255) DEFAULT NULL COMMENT '使用人',
  PRIMARY KEY (`Id`,`code`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
