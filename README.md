mmcsysu
=================================== 
Based on yii to create an web project for MutilMediea Center of SYSU

Installing Guide
---------------------------------------------------
		1. Make a "runtime" dir and set its authority bit. The command listed as follow: 
		cmd1:  mkdir /mmcsysu/protected/runtime 
		cmd2:  chmod 777 runtime -R 
		or cmd2:[anthor method] chown  daemon:daemon runtime -R

		2. Make a "assets" dir and set its authority bit. The command listed as follow: 
		cmd1:  mkdir /mmcsysu/assets 
		cmd2:  chmod 777 assets -R
		or cmd2:[anthor method] chown  daemon:daemon assets -R

		3. Make a "images" dir 
		cmd1:  mkdir /mmcsysu/images
		then copy images file from (TestMachine) and put the images at path: /mmcsysu/images

		4. Copy yii framework to WebDoc/yii.
		Note: the Yii framework path showed as bellow:
		.
		├── mmcsysu
		├── mmdsysu
		└── yii

		5. Alter a css file in Yii framework showed as follow:
		Alter file path: /yii/framework/web/widgets/pagers/pager.css
		Alter file content:

		/**
		* Hide first and last buttons by default.
		*/
		ul.yiiPager .first,
		ul.yiiPager .last
		{
				display:inline;
		}

		6. Import DB schema into mysql.
		The schema file at /mmcsysu/protected/data/schema/*.sql
		import *.sql order:
		1) mmc.sql
		2) mmc-data-initial.sql
		3) mmc-data-article.sql
		Note: 
		1) all the mis_article.status = 0 means they are draft and will not be shown at page.
		You must alter the status =1 which will be published at page.

		7. Create a administrator user
		Now You can see the WebSite successfully. If you want to login the backend of the WebSite, you need to create a user for youself.
		1) alter the username and pwd variable in javascript at the file: /mmcsysu/genUser/genUser.php
		2) open the genUser.php on the browser, and you can see something like this:
        2-1 Update User
		update mis_user set password ='340b5f9511d72121354835b3f457996a62e764bab7a4c35e78fe4e33605c910729361c76' where username ='hh';
		2-2 Create User
		insert into mis_user (username, password, authority ) value ('hh', '340b5f9511d72121354835b3f457996a62e764bab7a4c35e78fe4e33605c910729361c76', 984062);	
		3) copy the "Create User" sql showed above and excute it in mysql.Then you can login backend with your own username and password.
