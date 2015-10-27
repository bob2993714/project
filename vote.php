<?php
  require_once("dbtools.inc.php");
	
  //取得表單資料
//  $id = strtoupper($_POST["id"]);
  $name = $_POST["name"];
  $select =$_POST["select"];
  $select2 =$_POST["select2"];
  $select3 =$_POST["select3"];

  //建立資料連接
  $link = create_connection();
			
  
    //釋放 $result 佔用的記憶體	
    mysql_free_result($result);
		

				
    //使用 UPDATE 陳述式將票數 + 1
    $sql = "UPDATE candidate SET score = score + 1 ,star1 = star1 +$select,star2 = star2 +$select2,star3 = star3 +$select3 WHERE name = '$name'";
    $result = execute_sql("user", $sql, $link);

	
  //關閉資料連接	
  mysql_close($link);

  //將使用者導向 result.php 網頁
  header("location:rightC.php");
  exit();
?>