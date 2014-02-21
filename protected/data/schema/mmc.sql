/*
*Author: hehao
*Email:  mickeymousesysu@gmail.com
*Date: 2013-12-20
*Function:
*       mmc schema
*
*Note:
*
**/

/*
drop database if exists mis;
create database mis;
*/


use mis;
drop table if exists mis_user;
drop table if exists mis_category;
drop table if exists mis_article;
drop table if exists mis_article_index;
drop table if exists mis_comment;
drop table if exists mis_dictionary;



/*
 *为了兼容旧版格式
 */
create table mis_user (
      user_id 		int unsigned not null auto_increment comment '用户id',
      username 		varchar(128) not null default '' comment '用户名',
      password 		varchar(128)  not null default '' comment '密码',
      campus_id		tinyint(4) not null default 0 comment '校区id',
      authority 	int unsigned not null default 0 comment '用户权限',
     
      constraint pk_user_id 	primary key  (user_id),
      constraint uk_username 	unique key  (username)
)engine='InnoDB' default charset='utf8' comment='用户表';


create table mis_category(
      category_id 	tinyint(4) unsigned not null auto_increment comment '类别id',
      category_name 	varchar(128)  not null default '' comment '类别名称',

      constraint pk_category_id 	primary key (category_id),
      constraint uk_category_name 	unique key (category_name)
)engine='InnoDB' default charset='utf8' comment='类别表';



/*
   删除某一类别也不会删除该类别的所有文章，该类别下的文章移到默认类别（CatyId=0）下
   删除某一用户也不会删除该用户下的所有文章，该用户的文章默认转到root用户所发表的文章
   foreign key(category_id) references mis_category(category_id),
   foreign key(author_id) references Users(UserId),

   status 
   0	草稿箱的文章，不显示在页面上
   1	已发布的文章
   2	垃圾箱的文章，不显示在页面上，还可以被从垃圾箱中还原到草稿箱
   3    已删除的文章，普通用户删除的文章，删除之后个人不可见，管理员可见
*/

create table mis_article(
      article_id 	int unsigned not null auto_increment comment '文章id',
      category_id 	tinyint(4)  unsigned not null default 0 comment '类别id',
      author_id  	int unsigned not null default 0 comment '作者id',
      campus_id 	tinyint not null default 0 comment '校区id', 
      publisher 	varchar(128) not null default '' comment '发布方',
      create_time	datetime not null default '0000-00-00 00:00:00' comment '发布时间',
      update_time	datetime not null default '0000-00-00 00:00:00' comment '更新时间',
      title 		varchar(256) not null default '' comment '文章标题',
      content 		mediumtext not null default '' comment '文章内容',
      tag 		tinytext not null default '' comment '文章标签',
      status		tinyint(4) not null default 0 comment '文章状态',

      constraint pk_article_id	primary key (article_id),
      index  idx_category_id 	(category_id),
      index  idx_author_id   	(author_id)
)engine='InnoDB' default charset='utf8' comment='文章表';


/*
   删除\添加\修改某篇文章则自动删除\添加\修改某篇文章的全文索引，通过事务原子性来实现

      foreign key(ArteId) references article(ArteId),
 */
create table mis_article_index(
      index_id 		int unsigned not null comment '索引id',
      title	 	varchar(255) not null default '' comment '文章标题',
      content 		mediumtext not null default  '' comment '文章内容',
     
      constraint pk_index_id		primary key (index_id),
      fulltext(title, content)
)engine='MyISAM' default charset='utf8' comment='全文索引表';



/**
 
  status
  0	未审核的留言
  1	页面上的留言
  2	页面上置顶的留言
  3	垃圾箱的留言
 
 */


create table mis_comment(
      comment_id 	int unsigned not null auto_increment comment '留言id',
      create_time	datetime not null default '0000-00-00 00:00:00' comment '发布时间',
      author		varchar(128) not null default '' comment '留言人',
      email		varchar(256) not null default '' comment '留言人邮箱',
      content 		varchar(1024) not null default '' comment '留言内容',
      status 		tinyint(4) not null default 0 comment '审核状态',
      reply             varchar(1024) not null default '' comment '管理员回复', 

      constraint pk_comment_id		primary key (comment_id)
)engine='InnoDB' default charset='utf8' comment='留言表';


/*
字典表，用于存储通用的KV数据
*/

create table mis_dictionary(
      dictionary_id 	int unsigned not null auto_increment comment '字典id',
      dictionary_type 	varchar(128) not null default '' comment '字典类型',
      item_key		int unsigned not null default 0  comment '字典键',
      item_value	varchar(256) not null default '' comment '字典值',
      display_order	int unsigned not null default 0  comment '显示顺序',

      constraint pk_dictionary_id 	primary key (dictionary_id),
      index idx_type_key_value (dictionary_type, item_key, item_value)
)engine='InnoDB' default charset='utf8' comment='字典表';


