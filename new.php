<?php
	session_start();
	$title = $_POST['text'];
	$cont = $_POST['testarea'];
	$userName = $_SESSION['user'];

	$title = iconv("UTF-8", "GBK", $title);
	$cont = iconv("UTF-8", "GBK", $cont);
	$userName = iconv("UTF-8", "GBK", $userName);
	
	$conn=odbc_connect('bbs','','')or die("Could not connect to ODBC database!");
	$sql = "insert into subject values(NULL,1,'$userName','$title',null,now())";
	odbc_exec($conn,$sql);
	$rs=odbc_exec($conn,"select id from subject order by id desc limit 1");
	$id = odbc_result($rs,1);
	$sql1 = "insert into context values(1,$id,0,'$userName','$cont',now())";
	odbc_exec($conn,$sql1);
	odbc_close($conn);
	
	header("Location: index.php");
?>