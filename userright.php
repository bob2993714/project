<!DOCTYPE html>
<html lang="en">
<style type="text/css">	
	body {
		background-image: url(backcc.jpg);
		background-color: #FFF;
	}	
</style>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<strong><font size="5" face="標楷體">我的發布:</font></strong>
	 <?php
 	  session_start();

      require_once("dbtools.inc.php");

      $username = $_SESSION['username'];
			
      //指定每頁顯示幾筆記錄
      $records_per_page = 5;

      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;

      //建立資料連接
      $link = create_connection();
			
      //執行 SQL 命令
      $sql = "SELECT * FROM message  where account = '$username' ORDER BY date DESC";	
      $result = execute_sql("user", $sql, $link);

      //取得記錄數
      $total_records = mysql_num_rows($result);

      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);

      //計算本頁第一筆記錄的序號
      $started_record = $records_per_page * ($page - 1);

      //將記錄指標移至本頁第一筆記錄的序號
      mysql_data_seek($result, $started_record);

      //使用 $bg 陣列來儲存表格背景色彩
      $bg[0] = "#D9D9FF";
      $bg[1] = "#FFCAEE";
      $bg[2] = "#FFFFCC";
      $bg[3] = "#B9EEB9";
      $bg[4] = "#B9E9FF";

      echo "<table width='800' cellspacing='3'>";

      //顯示記錄
      $j = 1;
      while ($row = mysql_fetch_assoc($result) and $j <= $records_per_page)
      {
        echo "<tr bgcolor='" . $bg[$j - 1] . "'>";
        echo "<td width='120'><img src='images/".$row['photo']."' width='120' height='150'>";
        echo "<td>使用者：" . $row["author"] . "<br>";
        echo "時間：" . $row["date"] . "<br>";
		echo "<a href='show_news.php?id=";
        echo $row["id"] . "'>留言</a><hr>";
		echo $row["content"] . "</td></tr>";
        $j++;
      }
      echo "</table>" ;

      //產生導覽列
      echo "<p align='center'>";

      if ($page > 1)
        echo "<a href='userright.php?page=". ($page - 1) . "'>上一頁</a> ";

      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='userright.php?page=$i'>$i</a> ";
      }

      if ($page < $total_pages)
        echo "<a href='userright.php?page=". ($page + 1) . "'>下一頁</a> ";
      echo "</p>";

      //釋放記憶體空間
      mysql_free_result($result);
      mysql_close($link);
    ?>
</body>
</html>