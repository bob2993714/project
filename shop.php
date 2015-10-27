<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>無標題文件</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background-color: #42413C;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ 元素/標籤選取器 ~~ */
ul, ol, dl { /* 由於瀏覽器之間的差異，最佳作法是在清單中使用零寬度的欄位間隔及邊界。為了保持一致，您可以在這裡指定所要的量，或在清單包含的清單項目 (LI、DT、DD) 上指定所要的量。請記住，除非您寫入較為特定的選取器，否則在此執行的作業將重疊顯示到 .nav 清單。 */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* 移除上方邊界可以解決邊界可能從其包含的 Div 逸出的問題。剩餘的下方邊界可以保持 Div 不與接在後面的元素接觸。 */
	padding-right: 15px;
	padding-left: 15px; /* 將欄位間隔加入至 Div 內元素的兩側 (而不是 Div 本身)，即可不需執行任何方塊模型的計算作業。具有側邊欄位間隔的巢狀 Div 也可當做替代方法。 */
}
a img { /* 這個選取器會移除某些瀏覽器在影像由連結所圍繞時，影像周圍所顯示的預設藍色邊框 */
	border: none;
}

/* ~~ 網站連結的樣式設定必須保持此順序，包括建立滑過 (Hover) 效果的選取器群組在內。~~ */
a:link {
	color: #42413C;
	text-decoration: underline; /* 除非您要設定非常獨特的連結樣式，否則最好提供底線，以便快速看出 */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* 這個選取器群組可以讓使用鍵盤導覽的使用者，也和使用滑鼠的使用者一樣擁有相同的滑過體驗。 */
	text-decoration: none;
}

/* ~~這個固定寬度的容器環繞著其他 Div~~ */
.container {
	width: 960px;
	background-color: #FFF;
	margin: 0 auto; /* 兩側的自動值與寬度結合後，版面便會置中對齊 */
}

/* ~~ 頁首沒有指定的寬度，而會橫跨版面的整個寬度。頁首包含影像預留位置，必須由您自己的連結商標加以取代 ~~ */
.header {
	background-color: #ADB96E;
}

/* ~~ 這是版面的欄位。~~ 

1) 欄位間隔只會置於 Div 的頂端或底部。這些 Div 內的元素在兩側會有欄位間隔，可讓您不需進行「方塊模型計算」。請記住，如果對 Div 本身加入任何側邊的欄位間隔或邊框，在計算「總」寬度時，就會將這些加入您定義的寬度。您也可以選擇移除 Div 中元素的欄位間隔，然後在其中放置沒有寬度的第二個 Div，並依設計所需放置欄位間隔。

2) 尚未為這些欄位提供邊界，因為它們全都是浮動的。如果必須加入邊界，請避免將其放在浮動方向的一側 (例如將右邊界放在設定為向右浮動的 Div 上)。在許多時候，您都可以改用欄位間隔。對於必須違反此規則的 Div，您應該在 Div 的規則中加入 "display:inline" 宣告，以防止某些版本的 Internet Explorer 將邊界加倍。

3) 因為可在文件中多次使用類別 (也可對單一的元素套用多個類別)，所以已為欄位指定類別名稱，而非 ID。例如，您可在必要時將兩個側邊列 Div 堆疊起來。如有需要，也可以將這些名稱輕鬆地變更為 ID (只要您在每份文件中只使用一次)。

4) 如果想要將導覽放在右方而非左方，只要將這些欄設定為往反方向浮動 (全部往右，而非全部往左)，它們就會以相反順序呈現。您不需要在 HTML 原始碼中移動 Div。

*/
.sidebar1 {
	float: left;
	width: 180px;
	background-color: #EADCAE;
	padding-bottom: 10px;
}
.content {

	padding: 10px 0;
	width: 780px;
	float: left;
}

/* ~~ 這個群組選取器會在 .content 區域空間中提供清單 ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* 這個欄位間隔反映出上方標題和段落規則中的右方間隔。當欄位間隔位於下方時，便可將清單中的其他元素間隔開來；當位於左方時，則可藉此建立縮排。這些動作均可依需要進行調整。 */
}

/* ~~ 導覽清單樣式 (如果選擇使用 Spry 之類的預製飛出選單，則可移除) ~~ */
ul.nav {
	list-style: none; /* 這會移除清單標記 */
	border-top: 1px solid #666; /* 這會建立連結的上方邊框，其他則都會使用下方邊框放置在 LI 上 */
	margin-bottom: 15px; /* 這會在下方的內容上建立導覽間的間距 */
}
ul.nav li {
	border-bottom: 1px solid #666; /* 這會建立按鈕分隔 */
}
ul.nav a, ul.nav a:visited { /* 將這些選取器放入群組，即可確保您的連結即使在受到點擊後仍保有按鈕外觀 */
	padding: 5px 5px 5px 15px;
	display: block; /* 這會為連結提供區塊屬性，使連結能填滿包含它的整個 LI，讓整個區域都能回應滑鼠點按動作。 */
	width: 160px;  /*這個寬度使整個按鈕都可用於 IE6 的點按動作。如果不需要支援 IE6，就可將其移除。請從側邊列容器的寬度減去此連結的間距來計算適當的寬度。 */
	text-decoration: none;
	background-color: #C6D580;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* 這會同時變更滑鼠及鍵盤導覽器的背景及文字顏色 */
	background-color: #ADB96E;
	color: #FFF;
}

/* ~~ 頁尾 ~~ */
.footer {
	padding: 10px 0;
	background-color: #CCC49F;
	position: relative;/* 這會為 IE6 提供 hasLayout 以進行適當的清除動作 */
	clear: both; /* 這個 clear 屬性可以強制 .container 辨識欄結束於何處以及包含欄的位置 */
}

/* ~~ 其他 float/clear 類別 ~~ */
.fltrt {  /* 這個類別可用來讓元素在頁面中浮動，浮動的元素必須位於頁面上相鄰的元素之前。 */
	float: right;
	margin-left: 8px;
}
.fltlft { /* 這個類別可用來讓元素在頁面左方浮動，浮動的元素必須位於頁面上相鄰的元素之前。 */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* 這個類別可放置在 <br /> 或空白的 Div 上，當做接在 #container 內最後一個浮動 Div 後方的最後一個元素 (如果從 #container 移除或取出 #footer) */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style></head>

<body>

<div class="container">
  <div class="header"></div>
  <div class="sidebar1">
    <ul class="nav">
      <li>
      <p><?php

			if(isset($_SESSION['username']) ){
				require_once("dbtools.inc.php");
				
				$link = create_connection() or die("connecting fails!");
				
				$username = $_SESSION['username'];
				
				$sql = "SELECT name FROM business Where account = '$username'";
				
				$result = execute_sql("user", $sql, $link);
				
				echo "商家: ".mysql_result($result,0,0);
				
				$sql = "select photo from business where account = '$username'";
				
				$result = execute_sql("user", $sql, $link);

				$row = mysql_fetch_array($result);
				
				$file_name = $row["photo"];
				
				mysql_close($link);
			}
			else{
				echo '您無權限觀看此頁面!';
			}
   ?></p>
   		<div><img src="images/<?php echo $file_name; ?>" width="180" height="200"/></div>
        <p>綜合評分項目:</p>
        <p>服務態度</p>
        <p>服務效率</p>
        <p>菜色口味</p>
       <li><a href="uploadB.php">上傳大頭貼</a></li>
      <li><a href="#">發布商品動態</a></li>
      <li><a href="#">我的商品評價</a></li>
      <li><a href="merchandise.html">登記新商品</a></li>
      <li><a href="#">個人化設定</a></li>
    </ul>
<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  <!-- end .sidebar1 --></div>
  <div class="content">
    
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
