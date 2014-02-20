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


