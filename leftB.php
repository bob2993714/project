<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
<style type="text/css">
<!--
body {
	background-image: url(b2.jpg);
	background-color:#F1E9A9;
}
-->
</style></head>

<body>
<div align="left">
<table border="0"> 
<tr>  
<td align="left" border="0"><font size="1">
<script language="JavaScript"> 
<!-- 
function visitor() 
{ 
//define variable 
var Jsay; 
var Jdayr; 
var Jtoday= new Date(); 
var Jyear= Jtoday.getYear(); Jmonth=Jtoday.getMonth(); 
Jday= Jtoday.getDay(); Jdate=Jtoday.getDate(); 
Jhrs= Jtoday.getHours(); Jmin=Jtoday.getMinutes(); 
Jsec=Jtoday.getSeconds(); 
document.write("<font size=4>"); 
document.write("<font color=khaki>"); 
if (Jhrs<12) 
document.write("<font color=black >"+"早安"+"</font>"); 
else if (Jhrs<18) 
document.write("<font color=black >"+"午安"+"</font>"); 
else 
document.write("<font color=black >"+"晚安"+"</font>");  
document.write('\t'+"<font color=black >"+'!!'+"</font>");
}
visitor(); 
//--> 
</script><spacer size="10"><br> 
</font></td>               
</tr>               
</table>               
</div>
<!--變色連結按鈕 _開始-->
<script language="JavaScript">
<!--
function change(color){
if (event.srcElement.tagName=="INPUT")
event.srcElement.style.backgroundColor=color
}
function jumpto(url){
window.location=url
}
-->
</script>
<style type=text/css>
<!--
input{
border: 1px solid #000000; /*設定邊框色彩*/
color : #525050; /*設定文字色彩*/
font-size : 16pt; /*設定文字大小*/
background-color:#eeeeee; /*設定背景色彩*/
}
-->
</style>

<!--在change('#FFFF00')修改變化的顏色-->
<form onMouseover="change('#FF55FF')" onMouseout="change('')">
  	<?php

			if(isset($_SESSION['username']) ){
				require_once("dbtools.inc.php");
				
				$link = create_connection() or die("connecting fails!");
				
				$username = $_SESSION['username'];
				
				$sql = "SELECT name FROM business Where account = '$username'";
				
				$result = execute_sql("user", $sql, $link);
				
				echo "歡迎商家:".mysql_result($result,0,0);
				
				$sql = "select photo from business where account = '$username'";
				
				$result = execute_sql("user", $sql, $link);

				$row = mysql_fetch_array($result);
				
				$file_name = $row["photo"];
				
				mysql_close($link);
			}
			else{
				echo '您無權限觀看此頁面!';
			}
   ?>
   <div><img src="images/<?php echo $file_name; ?>" width="180" height="200"/></div>
  <p>  
   <INPUT TYPE="button" VALUE="登出" onClick="parent.window.location.href='logout.php'">  
   <INPUT TYPE="button" VALUE="商家主頁" onClick="parent.window.location.href='bus.php'">
  <p>
</form>

<!--變色連結按鈕 _結束--> 

</body>
</html>
