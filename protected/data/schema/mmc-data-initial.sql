/*
*Author: hehao
*Email:  mickeymousesysu@gmail.com
*Date: 2013-12-24
*Function:
*       mmc initialization data
*
*Note:
*
**/

use mis;
insert into mis_category (category_name) values
('特色课室'), ('规章制度'),  ('服务资讯'), ('技术探索'),('优秀助理'), ('活动报道'), ('工作感想');


/*
 Must insert the article of special classroom firstly!!
 them insert the dictionary data below.
 item_key is the article_id in table mis_article
 display_order is the order in the navbar on the left side of the page 
 */

insert into mis_dictionary (dictionary_type, item_key, item_value, display_order) values
('SpecialClassroom', 0, '云录播课室', 1),
('SpecialClassroom', 1, 'PBL课室',  2),
('SpecialClassroom', 2, '视屏会议系统（硬）',  3),
('SpecialClassroom', 3, '视屏会议（软）', 4);


insert into mis_dictionary (dictionary_type, item_key, item_value, display_order) values
('Campus', 1, '东校区',  1),
('Campus', 2, '南校区',  2),
('Campus', 3, '北校区',  3),
('Campus', 4, '珠海校区',  4);

insert into mis_dictionary (dictionary_type, item_key, item_value, display_order) values
('Category', 0, '特色课室',  1),
('Category', 1, '规章制度',  2),
('Category', 2, '服务信息',  3),
('Category', 3, '技术探索',  4),
('Category', 4, '优秀助理',  5),
('Category', 5, '活动报道',  6),
('Category', 6, '工作感想',  7);

insert into mis_dictionary (dictionary_type, item_key, item_value, display_order) values
('Article', 0, '草稿',  1),
('Article', 1, '置顶',  2),
('Article', 2, '发布',  3);

insert into mis_dictionary (dictionary_type, item_key, item_value, display_order) values
('Comment', 0, '未审核',  1),
('Comment', 1, '置顶',  2),
('Comment', 2, '通过',  3);


insert into mis_dictionary (dictionary_type, item_key, item_value, display_order) values
('Module' , 2, '首页管理', 1),
('Module' , 4, '课室管理', 2),
('Module' , 8, '服务列表', 3),
('Module' , 16, '规章制度', 4),
('Module' , 32, '技术探索', 5),
('Module' , 64, '多媒体风采', 6),
('Module' , 128, '评论管理', 7),
('Module' , 256, '用户管理', 8),
('Module' , 512, '回收站管理', 9),

('Module' , 65536, '设备检查登记', 10),
('Module' , 131072, '设备信息查询', 11),
('Module' , 262144, '设备操作管理', 12),
('Module' , 524288, '服务调查统计', 13);
