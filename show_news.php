<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.author.value.length == 0)
          alert("作者欄位不可以空白哦！");
        else if (document.myForm.content.value.length == 0)
          alert("內容欄位不可以空白哦！");
        else
          myForm.submit();
      }
    </script>			
  </head>
  <body>
    <?php	
      require_once("dbtools.inc.php");
	  
	  session_start();
			
      //取得要顯示之記錄
      $id = $_GET["id"];
				
      //建立資料連接
      $link = create_connection();
			
      //執行 SQL 命令
      $sql = "SELECT * FROM message WHERE id = $id";
      $result = execute_sql("user", $sql, $link);
				
      echo "<table width='800' align='center' cellpadding='3'>";
      echo "<tr height='40'><td colspan='2' align='center'
            bgcolor='#663333'><font color='white'>
            <b>文章</b></font></td></tr>";	 
						  
      //顯示原討論主題的內容
      while ($row = mysql_fetch_assoc($result))
      {
        echo "<tr>";
        echo "<td bgcolor='#CCFFCC'>作者：" . $row["author"] . "　";
        echo "時間：" . $row["date"] . "</td></tr>";				
        echo "<tr height='40'><td bgcolor='CCFFFF'>";
        echo $row["content"] . "</td></tr>";
      }
			
      echo "</table>";		
			
      //釋放 $result 佔用的記憶體空間
      mysql_free_result($result);

      //執行 SQL 命令
      $sql = "SELECT * FROM reply_message WHERE reply_id = $id";
      $result = execute_sql("user", $sql, $link);
			
      if (mysql_num_rows($result) <> 0)
      {
        echo "<hr>";
        echo "<table width='800' align='center' cellpadding='3'>";
        echo "<tr height='40'><td colspan='2' align='center'
              bgcolor='#99CCFF'><font color='#FF3366'>
              <b>回覆</b></font></td></tr>";
							 
        //顯示回覆主題的內容
        while ($row = mysql_fetch_assoc($result))
        {
          echo "<tr>";
          echo "<td bgcolor='#FFFF99'>作者：" . $row["author"] . "　";
          echo "時間：" . $row["date"] . "</td></tr>";				
          echo "<tr><td bgcolor='CCFFFF'>";
          echo $row["content"] . "</td></tr>";
        }
				
        echo "</table>";			
      }

      //釋放記憶體空間
      mysql_free_result($result);				
      mysql_close($link);					
    ?>
    <hr>
    <form name="myForm" method="post" action="post_reply.php">
      <input type="hidden" name="reply_id" value="<?php echo $id ?>">
      <table border="0" width="800" align="center" cellspacing="0">
        <tr bgcolor="#0084CA" align="center">
          <td colspan="2"><font color="white">請在此輸入您的回覆</font></td>
        </tr>
        <?php 
		$link = create_connection() or die("connecting fails!");
				
		$username = $_SESSION['username'];
				
		$sql = "SELECT name FROM customer Where account = '$username'";
				
		$result = execute_sql("user", $sql, $link);				
					
		mysql_close($link);
		?>
        <tr bgcolor="#D9F2FF">
          <td width="15%">使用者</td>
          <td width="85%"><input name="author" type="text" value="<?php echo mysql_result($result,0,0);?>" size="50" readonly></td>
        </tr>
        <tr bgcolor="#D9F2FF">
          <td width="15%">內容</td>
          <td width="85%"><textarea name="content" cols="50" rows="5"></textarea></td>
        </tr>
        <tr>
          <td colspan="2" height="40" align="center">
            <input type="button" value="回覆" onClick="check_data()">   
            <input type="reset" value="重新輸入"><br><br><br>
            <a href="main.php" target="_top"><img src="3.png" width="150" height="70" /></a>
          </td>
        </tr>  
      </table>                   
    </form>
  </body>                                                                                 
</html>