<?php
	session_start();
	$cont = $_POST['testarea'];
	$userName = $_SESSION['user'];
	$id = $_GET['id'];
	$cont = iconv("UTF-8", "GBK", $cont);
	$userName = iconv("UTF-8", "GBK", $userName);
	
	$conn=odbc_connect('bbs','','')or die("Could not connect to ODBC database!");
	$sql = "select num from subject where id=$id";
	$rs=odbc_exec($conn,$sql);
	$num = odbc_result($rs,1);
	$num++;
	odbc_exec($conn,"insert into context values($num,$id,0,'$userName','$cont',now())");
	
	$sql1 = "update subject set num=$num,date=now() where id=$id";
	odbc_exec($conn,$sql1);
	odbc_close($conn);
	
	header("Location: show.php?id=$id");
?>