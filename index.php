<?php
	session_start();
	if($_SESSION["user"]==null)
	{
		echo "<script> alert('您还未登录，准备跳至登录页面');parent.location.href='login.html'; </script>"; 
		exit;
	}
	else
	{
		$font = '<font color="green" face="glyphicons-halflings-regular">';
		$fontEnd = '</font>';
		$conn=odbc_connect('bbs','','')or die("Could not connect to ODBC database!");;
		//odbc_exec($conn,"SET NAMES utf8");
		$sql="select * from subject order by date desc";
		$rs=odbc_exec($conn,$sql);
		while(odbc_fetch_row($rs))
		{
			$id = odbc_result($rs,1);
			$name = iconv("GBK", "UTF-8", odbc_result($rs,3));
			$title = iconv("GBK", "UTF-8", odbc_result($rs,4));
			$date = iconv("GBK", "UTF-8", odbc_result($rs,6));
			$url = "subject:<a href=\"show.php?id=$id\">".$font.$title.$fontEnd."</a> 最后编辑时间：$date by:$name";
			echo $url."<br><br>";
		}
		odbc_close($conn);
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/htm;charset=utf-8" />
<title>bbs首页</title>
<link rel="stylesheet" href="css/supersized.css">
<link rel="stylesheet" href="css/login.css">
<link href="css/bootstrap.min.css" rel="stylesheet">

<script src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/tooltips.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</head>

<body>
<script src="js/supersized.3.2.7.min.js"></script>
<script src="js/supersized-init.js"></script>
<script src="js/scripts.js"></script>

	<div class="main_box">	
			<form name='f' action="new.php" method="post">
				<input type="text" name="text" value="主题" size=85 style="background:none;"><br><br>
				<textarea name="testarea" rows="15" cols="87" style='background:none;'>内容</textarea><br>
				<input type="submit" value="发帖" style='background:none;'>
			</form>
	</div>
</body>
</html>
