

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- 后台管理员表 管理员只有一个
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `password` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- 初始化管理员表
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '123456');

-- ----------------------------
-- 定义请假表结构
-- ----------------------------
DROP TABLE IF EXISTS `form`;
CREATE TABLE `form` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_id` int(11) NOT NULL COMMENT '请假的员工对应的id',
  `worker_name` varchar(20) NOT NULL comment'请假员工姓名',
  -- `form_start_time` DATE,
  `form_start_time` date  comment '申请假期开始日期',
  `form_end_time` date comment '申请假期结束日期',
  `form_length` int(11) not null comment '请假总计天数',
  `department_id` int(11) NOT NULL comment '请假员工对应的部门id',
	-- `manager_id` int(11) NOT NULL COMMENT '审批的部门负责人对应的id',
  `form_reason` text COMMENT '请假原因',
  `form_type` int(10) NOT NULL comment '请假类型',
  `add_time` int(11) DEFAULT NULL COMMENT '写请假单的时间',
  `approval_time` int(11) DEFAULT NULL COMMENT '审批时间',
  `status` tinyint(1) NOT NULL COMMENT '0是待审批 1 审批通过 -1 审批不通过',
   `manager_id` int(20) not null comment '提交申请给负责人id',
   `form_flag` tinyint(1) not null default 0 comment '设置一个flag标志，0为未审批 1为已审批 目的是设置只能审批一次',
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- 定义员工表结构
-- ----------------------------
DROP TABLE IF EXISTS `worker`;
CREATE TABLE `worker` (
  `worker_id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_no` char(20) NOT NULL COMMENT '工号',
  `password` char(32) NOT NULL,
  `name` char(30) NOT NULL COMMENT '姓名',
  `phone` char(11) NOT NULL COMMENT '手机号',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 0男1女',
  `department_id` int(10) not null comment'所属部门id',
  `department_name` char(50) DEFAULT NULL COMMENT '部门名称',
  PRIMARY KEY (`worker_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- 初始化员工表
-- 这里的密码都采用md5加密
-- ----------------------------
INSERT INTO `worker` VALUES ('1', '2001', 'e10adc3949ba59abbe56e057f20f883e', '吕树', '15121543654', '0','1000' ,'销售部');
INSERT INTO `worker` VALUES ('3', '2003', 'c8758b517083196f05ac29810b924aca', '吕小鱼', '13457883965', '1','1000', '销售部');
INSERT INTO `worker` VALUES ('6', '2004', 'dc5c7986daef50c1e02ab09b442ee34f', '李弦一', '13457882965', '0', '1002','技术部');
INSERT INTO `worker` VALUES ('7', '2005', 'ea6b2efbdd4255a9f1b3bbc6399b58f4', '知微', '13457996577', '0', '1001','宣传部');

-- ----------------------------
-- 定义部门负责人表结构
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_no` char(30) NOT NULL COMMENT '负责人编号',
  `password` char(32) NOT NULL COMMENT '登陆密码',
  `name` char(30) DEFAULT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别0男1女',
  `phone` char(11) DEFAULT NULL,
  `department_id` int(10) not null comment'所属部门id',
  `department_name` char(50) DEFAULT NULL COMMENT '部门名称',
  PRIMARY KEY (`manager_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- 初始化负责人表
-- ----------------------------
INSERT INTO `manager` VALUES ('1', '001', 'e10adc3949ba59abbe56e057f20f883e', '卢伟', '0', '1345788965','1000','销售部');
INSERT INTO `manager` VALUES ('2', '002', 'e10adc3949ba59abbe56e057f20f883e', '刘某', '1', '1345788964','1002','技术部');
INSERT INTO `manager` VALUES ('3', '003', 'e88a49bccde359f0cabb40db83ba6080', '刘培强', '1', '15233873895','1001','人事部');
-- ----------------------------
-- 定义部门结构
-- ----------------------------

DROP TABLE IF EXISTS `department`;
CREATE TABLE department(
`department_id` int NOT NULL COMMENT '部门id',
`department_name` varchar(100) NOT NULL COMMENT '部门名称',
PRIMARY KEY (department_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='部门表';
-- ----------------------------
-- 初始化部门
-- ----------------------------

insert into department
(department_id, department_name)
VALUES
(1000, '销售部'),
(1001, '人事部'),
(1002, '技术部'),
(1003, '宣传部');