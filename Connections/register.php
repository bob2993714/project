<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_register = "localhost";
$database_register = "user";
$username_register = "enen";
$password_register = "123";
$register = mysql_pconnect($hostname_register, $username_register, $password_register) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8");
?>