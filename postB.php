<?php
  require_once("dbtools.inc.php");
  
  session_start();
  $username = $_SESSION['username'];
  
  //建立資料連接
  $link = create_connection();
  
  $sql = "select photo from business where account = '$username'";
				
  $result = execute_sql("user", $sql, $link);

  $row = mysql_fetch_array($result);
				
  $file_name = $row["photo"];	
  $account = $username;
  $author = $_POST["author"];
  $content = $_POST["content"];
  $current_time = date("Y-m-d H:i:s");

  //執行 SQL 命令
  $sql = "INSERT INTO message(photo, account, author, content, date)
          VALUES('$file_name', '$account', '$author', '$content', '$current_time')";
  $result = execute_sql("user", $sql, $link);

  //關閉資料連接
  mysql_close($link);

  //將網頁重新導向到 index.php
  header("location:rightB.php");
  exit();
?>