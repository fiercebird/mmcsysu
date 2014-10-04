<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="language" content="en" />
            <script type="text/javascript" src="sha256.js"></script>
   </head>
<body>

<?php

$salts = array();
for($i=0; $i<100; $i++){
$salt = substr( str_pad( dechex( mt_rand() ), 8, '0', STR_PAD_LEFT ), -8 ); 
$salts[] = $salt;
}
$saltsJson = json_encode($salts);
//echo $saltsJson;

//var_dump($salts);
?>



<script language="javascript" type='text/javascript'>
var username = "hh";
var pwd="hh";
var salt = '340b5f95';
var authority = 984062;
var newPwd=salt+CryptoJS.SHA256(salt+pwd);
document.writeln( "1. Update User<br \>");
document.writeln( "update mis_user set password ='" + newPwd + "' where username ='" + username + "';" + "<br \>");
document.writeln( "2. Create User<br \>");
document.writeln( "insert into mis_user (username, password, authority ) value ('" + username + "', '" + newPwd + "', " + authority + ");" + "<br \>");
</script>


</body>
</html>
