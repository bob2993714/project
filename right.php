<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<SCRIPT language=JavaScript>

</SCRIPT>

<style type="text/css">
<!--
body,td,th {
	font-size: 20px;
	color: #000;
	font-weight: bold;
}
body {
	background-image: url(backgg.jpg);
	background-color: #FFF;
}
-->
</style>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
</head>

<body onload=runSlideShow()>
<strong><font face="標楷體">未登入無法進行發布動態以及評價的功能!!!</font></strong>

<hr>

<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">動態列</li>
    <li class="TabbedPanelsTab" tabindex="0">商品評價表</li>
    <li class="TabbedPanelsTab" tabindex="0">商家列表</li>
    <li class="TabbedPanelsTab" tabindex="0">好友</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <?php
      require_once("dbtools.inc.php");
			
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
      $sql = "SELECT * FROM message ORDER BY date DESC";	
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
        echo "時間：" . $row["date"] . "<hr>";
        echo $row["content"] . "</td></tr>";
        $j++;
      }
      echo "</table>" ;

      //產生導覽列
      echo "<p align='center'>";

      if ($page > 1)
        echo "<a href='right.php?page=". ($page - 1) . "'>上一頁</a> ";

      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='right.php?page=$i'>$i</a> ";
      }

      if ($page < $total_pages)
        echo "<a href='right.php?page=". ($page + 1) . "'>下一頁</a> ";
      echo "</p>";

      //釋放記憶體空間
      mysql_free_result($result);
      mysql_close($link);
    ?>
    </div>
    
    <div class="TabbedPanelsContent">
        <table align='' width='651' border='1' bordercolor='black'>
        <tr bgcolor='#D9F2FF'> 
        <td width="100" align='center'><b><font color='black'>菜單</font></b></td>
        <td width="155" align='center'><b><font color='black'>服務態度(平均/總數)</font></b></td>
        <td width="155" align='center'><b><font color='black'>服務效率(平均/總數)</font></b></td>
        <td width="155" align='center'><b><font color='black'>菜色口味(平均/總數)</font></b></td>
        <td width="100" align='center'><b><font color='black'>評價人數</font></b></td>

        
      </tr>
      <tr bgcolor='#FFCCFF'> 
      <?php
        require_once("dbtools.inc.php");
				
        //建立資料連接
        $link = create_connection();
						
        //執行 SELECT 陳述式來擷取候選人資料
        $sql = "SELECT * FROM candidate";
        $result = execute_sql("user", $sql, $link);
				
        //計算總記錄數
        $total_records = mysql_num_rows($result);
				
        //計算總票數
          //$total_score ="0";
		for ($i = 0; $i < $total_records; $i++){
		  @$total_score += mysql_result($result, $i, "score");
		  @$total_star1 += mysql_result($result, $i, "star1");
		  @$total_star2 += mysql_result($result, $i, "star2");
		  @$total_star3 += mysql_result($result, $i, "star3");
		}
        /* 目前記錄指錄已經在資料表尾端，我們使用 
           mysql_data_seek() 函式將記錄指標移至第 1 筆記錄 */
        mysql_data_seek($result, 0);
				
        //列出所有候選人得票資料
        for ($j = 0; $j < $total_records; $j++)
        {
          //取得候選人資料
          $row = mysql_fetch_assoc($result);
					
          //計算候選人得票百分比
          $percent = round($row["score"] / $total_score, 4) * 100;
					
          //顯示候選人各欄位的資料
          echo "<tr>";
          echo "<td align='center'>" . $row["name"] . "</td>";
		  echo "<td align='center'>" . sprintf("%.1f", $row['star1']/$row['score'] ) . " / ". $row['star1']."    顆星</td>";
		  echo "<td align='center'>" . sprintf("%.1f", $row['star2']/$row['score'] ) . " / ". $row['star2']."    顆星</td>";
		  echo "<td align='center'>" . sprintf("%.1f", $row['star3']/$row['score'] ) . " / ". $row['star3']."    顆星</td>";
		  echo "<td align='center'>" . $row['score'] . "</td>";

          echo "</tr>";
        }
								
        //釋放資源及關閉資料連接
        mysql_free_result($result);
        mysql_close($link);
      ?>
      <tr bgcolor='#66CCCC'> 
        <td align='center'>總計</td>
        <td width="155" align='center'><?php echo $total_star1 ?></td>
        <td width="155" align='center'><?php echo $total_star2 ?></td>
        <td width="155" align='center'><?php echo $total_star3 ?></td>
        <td align='center'><?php echo $total_score ?></td>
      </tr>
    </table>
    </div>
    
    <div class="TabbedPanelsContent">

    <img src="伊甸香活力餐早午餐.jpg" width="292" height="187">
    <img src="老爸素食.jpg" width="292" height="187">
    <img src="老爸麵食快餐.jpg" width="292" height="187"><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">伊甸香活力餐早午餐</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">老八素食</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">老八麵食快餐</a><br>
    <img src="彭爸餐飲早午餐.jpg" width="292" height="187">
    <img src="藝馨餐飲店.jpg" width="292" height="187">
    <img src="景觀餐廳.jpg" width="292" height="187"><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">彭爸餐飲早午餐</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">藝馨餐飲店</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">景觀餐廳</a>

    </div>
    <div class="TabbedPanelsContent">
      <strong><font face="標楷體">未登入無法使用此功能</font></strong>
    </div>
  </div>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</body>
</html>
