<?php 
/*
 *Author: hehao
 *Email:  mickeymousesysu@gmail.com
 *Date: 2014-02-17
 *Function:
 *   This interface represent the user's authority bit 
 */

interface ModuleAuth
{
   const AUTH_SUPER_ADMIN = 0;
   const AUTH_HOMEPAGE_ADMIN = 2;
   const AUTH_SPECIAL_CLASSROOM = 4;
   const AUTH_SERVICE_ADMIN = 8;
   const AUTH_RULE_ADMIN = 16;
   const AUTH_TECH_EXPLORE = 32;
   const AUTH_TEAMSTYLE = 64;
   const AUTH_COMMENT = 128;
   const AUTH_USER_ADMIN = 256;
   const AUTH_TRASH_ADMIN = 512;
}


?>

