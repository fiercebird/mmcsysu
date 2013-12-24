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
insert into mis_category (category_name) values ('特色课室'), ('规章制度'), ('多媒体风采'), ('服务资讯'), ('技术探索');


/*
 Must insert the article of special classroom firstly!!
 them insert the dictionary data below.
 item_key is the article_id in table mis_article
 display_order is the order in the navbar on the left side of the page 
 */

insert into mis_dictionary (dictionary_type, item_key, item_value, display_order) values
('SpecialClassRoom', 0, '云录播课室', 0),
('SpecialClassRoom', 1, 'PBL课室',  1),
('SpecialClassRoom', 2, '视屏会议系统（硬）',  2),
('SpecialClassRoom', 3, '视屏会议（软）', 3);


