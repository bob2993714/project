﻿<?php session_start(); ?>
<?php
  require_once("dbtools.inc.php");
	
  //取得表單資料
  $account = $_POST["account"]; 	
  $password = $_POST["password"];

  //建立資料連接
  $link = create_connection();
					
  //檢查帳號密碼是否正確
  $sql = "SELECT * FROM business where account = '$account' && password = '$password'";
  
  $result = execute_sql("user", $sql, $link);

  //如果帳號密碼錯誤
  
   if(mysql_num_rows($result) == 0)
  {	
  	//顯示訊息要求使用者輸入正確的帳號密碼
    echo "<script type='text/javascript'>";
    echo "alert('帳號密碼錯誤，請查明後再登入');";
    echo "history.back();";
    echo "</script>";
	echo "<script>parent.window.location='main.html'</script>";     
  }
	
  //如果帳號密碼正確
  else
  {	  
	
	$_SESSION['username'] = $account;
	
	echo "<script>parent.window.location='mainB.php'</script>";
	
	//釋放 $result 佔用的記憶體
    mysql_free_result($result);
	
    //關閉資料連接	
    mysql_close($link);		
	
    
		
    /*
	//取得 id 欄位
    $id = mysql_result($result, 0, "id");
	
    //釋放 $result 佔用的記憶體	
    mysql_free_result($result);
		
    //關閉資料連接	
    mysql_close($link);				

    //將使用者資料加入 cookies
    setcookie("id", $id);
    setcookie("passed", "TRUE");		
    header("location:main2.php");
	*/		
  }
  
?>