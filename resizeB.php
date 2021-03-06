<?php
	session_start();
	
	require_once("dbtools.inc.php");
	  
	//建立資料連接
	$link = create_connection();
	$login_user = $_SESSION["username"];

	// 取得上傳圖片
	$src = imagecreatefromjpeg($_FILES['file']['tmp_name']);

	
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
	imagejpeg($thumb, "thumb/".$_FILES['file']['name']);
	
	// 複製上傳圖片到指定 images 目錄
	copy($_FILES['file']['tmp_name'], "images/" . $_FILES['file']['name']);
	
	$src_file_name = $_FILES['file']['name'];
		
	$sql = "update business set photo = '$src_file_name' where account = '$login_user' ";
    execute_sql("user", $sql, $link);
	
	header("location:user.php"); 
?>