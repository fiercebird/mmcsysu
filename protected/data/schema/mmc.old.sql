/*
*Author: hehao
*Email:  mickeymousesysu@gmail.com
*Date: 2013-12-21
*Function:
*      some of  old  mmc schemas will be used in MMC Version 2.0 
*
*Note:
*
**/

use mis;

drop table if exists users;
drop table if exists campus;
drop table if exists building;
drop table if exists classroom;

create table users(
      UserId 		int unsigned not null auto_increment,
      UserName 		varchar(50) not null default '',
      UserPwd 		varchar(50)  not null default '',
      Campus 		tinyint not null default 0,
      Authority 	int unsigned not null default 0,
      primary key (UserId),
      unique key (UserName)
)engine='InnoDB' default charset='utf8' comment='用户表';




--
-- 表的结构 `campus`
--

CREATE TABLE IF NOT EXISTS `campus` (
        `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `cname` varchar(30) NOT NULL,
	    PRIMARY KEY (`cid`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `campus`
--

INSERT INTO `campus` (`cid`, `cname`) VALUES
(1, '东校区'),
(2, '南校区'),
(3, '北校区'),
(4, '珠海校区');





--
-- 表的结构 `building`
--

CREATE TABLE IF NOT EXISTS `building` (
   `bid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `bname` varchar(50) NOT NULL,
   `cid` int(10) unsigned NOT NULL,
   PRIMARY KEY (`bid`),
   KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `building`
--

INSERT INTO `building` (`bid`, `bname`, `cid`) VALUES
(1, 'A栋', 1),
(2, 'B栋', 1),
(3, 'C栋', 1),
(4, 'D栋', 1),
(5, 'E栋', 1);


--
-- 表的结构 `classroom`
--

CREATE TABLE IF NOT EXISTS `classroom` (
      `classId` int(10) unsigned NOT NULL AUTO_INCREMENT,
      `className` varchar(50) NOT NULL,
      `seatNum` int(10) unsigned NOT NULL,
      `examNum` int(10) unsigned NOT NULL,
      `bid` int(10) unsigned NOT NULL,
      `more` varchar(200) DEFAULT NULL,
      PRIMARY KEY (`classId`),
      KEY `bid` (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `classroom`
--

INSERT INTO `classroom` (`classId`, `className`, `seatNum`, `examNum`, `bid`, `more`) VALUES
(1, 'A101', 100, 50, 1, NULL),
(2, 'A102', 100, 50, 1, NULL),
(3, 'A103', 120, 60, 1, NULL),
(4, 'B101', 200, 100, 2, NULL),
(5, 'B102', 200, 100, 2, NULL),
(6, 'B103', 250, 150, 2, NULL);



