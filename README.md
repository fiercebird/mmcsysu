mmcsysu
=======

Based on yii to create an web project for MutilMediea Center of SYSU

Installing Guide
1.make a "runtime" dir and set its authority bit.The command listed as follow: 
cmd1:  mkdir /mmcsysu/protected/runtime 
cmd2:  chmod 777 runtime -R 
or cmd2:[anthor method] chown  daemon:daemon runtime -R

2.make a "assets" dir and set its authority bit.The command listed as follow: 
cmd1:  mkdir /mmcsysu/assets 
cmd2:  chmod 777 assets -R
or cmd2:[anthor method] chown  daemon:daemon assets -R

3.mkdir /mmcsysu/images 
then copy images file from TestMachine and put the images at path: /mmcsysu/images

4.copy yii framework to WebDoc/yii.
Note: the Yii framework path showed as bellow:
.
├── mmcsysu
├── mmdsysu
└── yii

5.alter a css file in Yii framework showed as follow:
Alter file path: /yii/framework/web/widgets/pagers/pager.css
Alter file content:
---------------------------------------------------
/**
* Hide first and last buttons by default.
*/
ul.yiiPager .first,
ul.yiiPager .last
{
        display:inline;
}
---------------------------------------------------

6.import DB schema into mysql.
The schema file at /mmcsysu/protected/data/schema/*.sql
import *.sql order:
1) mmc.sql
2) mmc-data-initial.sql
3) mmc-data-article.sql
Note: 
1) all the mis_article.status = 0 means they are draft and will not be shown at page.
You must alter the status =1 which will be published at page.

