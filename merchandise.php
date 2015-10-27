    <?php
	session_start();
	require_once("dbtools.inc.php");
    $n = $_POST["name"]; 
    $i = $_POST["introduction"];
	
	// 連結資料庫
	$link = create_connection() or die("connecting fails!");
	
	$username = $_SESSION['username'];
	  
	$src = imagecreatefromjpeg($_FILES['photo']['tmp_name']);

	// 取得來源圖片長寬
	$src_w = imagesx($src);
	$src_h = imagesy($src);
	
	// 假設要長寬不超過90
	if($src_w > $src_h){
	  $thumb_w = 90;
	  $thumb_h = intval($src_h / $src_w * 90);
	}else{
	  $thumb_h = 90;
	  $thumb_w = intval($src_w / $src_h * 90);
	}
	
	// 建立縮圖
	$thumb = imagecreatetruecolor($thumb_w, $thumb_h);
	
	// 開始縮圖
	imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);
	
	// 儲存縮圖到指定 thumb 目錄
	imagejpeg($thumb, "thumb/".$_FILES['photo']['name']);
	
	// 複製上傳圖片到指定 images 目錄
	copy($_FILES['photo']['tmp_name'], "images/" . $_FILES['photo']['name']);
	
	$src_file_name = $_FILES['photo']['name'];

	// 執行 query 並取得執行結果  
	$sql = "INSERT INTO candidate(name,introduction,photo,bus) VALUES ('$n','$i','$src_file_name','$username');";  // 請使用雙引號
	$result = execute_sql("user", $sql, $link);
	
	header ("Location:shop.php");	  
    ?>