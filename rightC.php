<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />
<script src='https://cdn.firebase.com/js/client/1.0.17/firebase.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
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
	  
	  function check_data_1()
      {				
        if (found != true)
        {
          alert("您沒有選擇菜色");				
        }				
		else		
          myForm.submit();
      }	  
	  function chg(){ 
		str_n = document.getElementById('select4').value;
		location.href = "rightC.php?a="+str_n;
	  } 
</script>

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
	<?php

			if(isset($_SESSION['username']) ){
				require_once("dbtools.inc.php");
				
				$link = create_connection() or die("connecting fails!");
				
				$username = $_SESSION['username'];
				
				$sql = "SELECT name FROM customer Where account = '$username'";
				
				$result = execute_sql("user", $sql, $link);				
					
				mysql_close($link);
			}
			
   ?>
    <form name="myForm" method="post" action="post.php">
          <table border="0" width="800" cellspacing="0">
            <tr bgcolor="#0084CA" align="center">
              <td colspan="2">
                <font color="#FFFFFF">您在想什麼?</font></td>
            </tr>
            <tr bgcolor="#D9F2FF">
              <td width="15%">使用者</td>
              <td width="85%"><input name="author" type="text" value="<?php echo mysql_result($result,0,0);?>" size="50" readonly></td>
            </tr>
            <tr bgcolor="#D9F2FF">
              <td width="15%">內容</td>
              <td width="85%"><textarea name="content" cols="50" rows="5"></textarea></td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                <input type="submit" value="留言" onClick="check_data()">　
                <input type="reset" value="重新輸入">
              </td>
            </tr>
          </table>
     </form>
<hr>

<?php
require_once('Connections\register.php');
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_register, $register);
$query_Recordset2 = "SELECT * FROM appraise ORDER BY pId ASC";
$Recordset2 = mysql_query($query_Recordset2, $register) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_register, $register);
$query_Recordset3 = "select * from business order by account asc";
$Recordset3 = mysql_query($query_Recordset3, $register) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
        <form name="myForm" action="vote.php" method="post" >
      <table width="100%" align="" border="1" bordercolor="">
      <tr bgcolor="#D9F2FF">
        <td colspan="3" align="left" width="100%">選擇想評價的商家:<select name="select4" id="select4" onChange="chg();"><option value="0">請選擇</option><?php do {  ?><option value="<?php echo $row_Recordset3['account']?>"<?php if (!(strcmp($row_Recordset3['account'], $row_Recordset3['name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset3['name']?></option><?php
} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
  $rows = mysql_num_rows($Recordset3);
  if($rows > 0) {
      mysql_data_seek($Recordset3, 0);
	  $row_Recordset3 = mysql_fetch_assoc($Recordset3);}?></select>
</td><tr>
      
        <tr bgcolor="#0084CA">
          <td align="center" width="30%"><font color="#FFFFFF">菜單</font></td>
          <td align="center" width="20%"><font color="#FFFFFF">圖片</font></td>
          <td align="center" width="50%"><font color="#FFFFFF">菜色介紹</font></td>
        </tr>
       
        <?php
			$select = $_GET['a'];
			
            require_once("dbtools.inc.php");
						
            //建立資料連接
            $link = create_connection();
														
            //執行 Select 陳述式取得候選人資料
            $sql = "SELECT * FROM candidate where bus = '$select'";
            $result = execute_sql("user", $sql, $link);
						
            echo "<tr bgcolor='white'>";
            for ($i = 0; $i < mysql_num_rows($result); $i++)
            {

              echo "<td bgcolor='#87EAEB'> ";
              echo "<input type='radio' name='name' value='" . 
                    mysql_result($result, $i, "name") . "'>";
              echo mysql_result($result, $i, "name") . "</td>";
			  echo "<td bgcolor='#87EAEB'><img src='images/".mysql_result($result, $i, "photo")."' width='230' height='150'></td>";
              echo "<td bgcolor='#87EAEB'>".mysql_result($result, $i, "introduction")."</td>";
              echo "</tr>";
            }
												
            //關閉資料連接
            mysql_close($link);
          ?>
           <tr bgcolor="#D9F2FF">
          <td colspan="3" align="left" width="100%">服務態度
            <select name="select" id="select"><option value="0">請選擇</option>
              <?php do {  ?>
              <option value="<?php echo $row_Recordset2['pId']?>"<?php if (!(strcmp($row_Recordset2['pId'], $row_Recordset2['star']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['star']?></option>
              <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
            </select>
            　服務效率
            
            <select name="select2" id="select2"><option value="0">請選擇</option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset2['pId']?>"<?php if (!(strcmp($row_Recordset2['pId'], $row_Recordset2['star']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['star']?></option>
              <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
            </select>
　　菜色口味
<select name="select3" id="select3"><option value="0">請選擇</option>
  <?php
do {  
?>
  <option value="<?php echo $row_Recordset2['pId']?>"<?php if (!(strcmp($row_Recordset2['pId'], $row_Recordset2['star']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['star']?></option>
  <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
</select></td>
        </tr>
      </table>
      <p align="center"> 
        <input type="submit" value="評價" onClick="check_data_1()">
        <input type="reset" value="重新設定">
      </p>
</form>

<hr>
   
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
        echo "<a href='rightC.php?page=". ($page - 1) . "'>上一頁</a> ";

      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='rightC.php?page=$i'>$i</a> ";
      }

      if ($page < $total_pages)
        echo "<a href='rightC.php?page=". ($page + 1) . "'>下一頁</a> ";
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
    <div id='messagesDiv'></div>
        <input type='text' id='nameInput' placeholder='Name'>
        <input type='text' id='messageInput' placeholder='Message'>
        <script>
          var myDataRef = new Firebase('https://msl7tpfpta0.firebaseio-demo.com/');
          $('#messageInput').keypress(function (e) {
            if (e.keyCode == 13) {
              var name = $('#nameInput').val();
              var text = $('#messageInput').val();
              myDataRef.push({name: name, text: text});
              $('#messageInput').val('');
            }
          });
          myDataRef.on('child_added', function(snapshot) {
            var message = snapshot.val();
        displayChatMessage(message.name, message.text);
          });
          function displayChatMessage(name, text) {
            $('<div/>').text(text).prepend($('<em/>').text(name+': ')).appendTo($('#messagesDiv'));
            $('#messagesDiv')[0].scrollTop = $('#messagesDiv')[0].scrollHeight;
          };
        </script>
    </div>
  </div>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</body>
</html>
