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
   /*  mmc  authority bit 0~8 bits used */
   const MMC_SUPER_ADMIN = 1;
   const MMC_HOMEPAGE_ADMIN = 2;
   const MMC_CLASSROOM_ADMIN = 4;
   const MMC_SERVICE_ADMIN = 8;
   const MMC_RULE_ADMIN = 16;
   const MMC_TECH_EXPLORE = 32;
   const MMC_TEAMSTYLE = 64;
   const MMC_COMMENT_ADMIN = 128;
   const MMC_USER_ADMIN = 256;
   const MMC_TRASH_ADMIN = 512;

   /* mmd authority bit  16 17 18 19  used*/

   const MMD_DEVICE_CHECK =  65536;
   const MMD_DEVICE_INFO = 131072;
   const MMD_ACTION_MANAGE = 262144;
   const MMD_SERVICE_SURVEY = 524288;
}


?>

