mmcsysu
=======

Based on yii to create an web project for MutilMediea Center of SYSU

Installing Guide
1.make a "runtime" dir and set its authority bit.The command listed as follow: 
#cmd1:  mkdir /mmcsysu/protected/runtime 
#cmd2:  chmod 777 runtime -R 
#cmd2:[anthor method] chown  daemon:daemon runtime -R

2.make a "assets" dir and set its authority bit.The command listed as follow: 
#cmd1:  mkdir /mmcsysu/assets 
#cmd2:  chmod 777 assets -R
#cmd2:[anthor method] chown  daemon:daemon assets -R

3.need to copy  images from TestMachine.


4.copy yii framework to WebDoc/yii, and then alter a css style showed as follow:
/yii/framework/web/widgets/pagers/pager.css
59 /**
60  * Hide first and last buttons by default.
61  */
62 ul.yiiPager .first,
63 ul.yiiPager .last
64 {
65         display:inline;
66 }

5.import DB schema into mysql.
The schema file at /mmcsysu/protected/data/schema/*.sql

