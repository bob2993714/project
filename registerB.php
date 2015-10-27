<HTML>
  <HEAD>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset="utf-8">
	<header>
	<h1  style="color:#2E9AFE" class="big" ><b>會員註冊</b> </h1>
	</header>  	
    <TITLE>註冊成功</TITLE>
	</HEAD>
	
    <?php
	  require_once("dbtools.inc.php");
      $a = $_POST["account"]; 
      $p = $_POST["password"];
	  $n = $_POST["name"];	 
	  $kind = $_POST["kind"];	
	  $mail = $_POST["mail"];
 
	
	if($a==""||$a==null||$p==null||$p==""||$n==""||$n==null||$kind==null||$kind==""||$mail==null||$mail=="")
	{
	header ("Location:registerB.html");
	}
	else
	{
	echo $n."親愛的貴賓您好！您輸入的資訊如下：<br>
	
	  帳號:".$a."<br>
	  密碼:".$p."<BR>
	  商家名稱:".$n."<br>
	  商家種類:".$kind."<BR>
	  電子郵件:".$mail."<BR>";
	  
	  
	// 連結資料庫
	$link = create_connection() or die("connecting fails!");

	// 執行 query 並取得執行結果  
	$sql = "INSERT INTO business(account,password,name,kind,mail) VALUES ('$a','$p','$n','$kind','$mail');";  // 請使用雙引號
	$result = execute_sql("user", $sql, $link);
	echo "insert".$result." record(s) <br/>";
	}
	  
    ?>
  <br><br><a href="loginB.html">商家登入</a>
  </BODY>
</HTML>
