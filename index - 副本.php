<?php
	session_start();
	if($_SESSION["user"]==null)
	{
		echo "<script> alert('您还未登录，准备跳至登录页面');parent.location.href='login.html'; </script>"; 
		exit;
	}
	else
	{
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
			$url = "subject:<a href=\"show.php?id=$id\">".$title."</a> 最后编辑时间：$date by:$name";
			echo $url."<br><br>";
		}
		odbc_close($conn);
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/htm;charset=utf-8" />
<title>bbs首页</title>
</head>

<body background="image/4.jpg">
<form name='f' action="new.php" method="post">
<input type="text" name="text" value="主题" size=100 style="background-image:url('image/3.png');margin-left: 0px;margin-top: 250px;width:630px;height:30px;"><br><br>
<textarea name="testarea" rows="15" cols="87" style="background-image:url('image/3.png');">内容</textarea><br>
<input type="submit" value="发帖" style="background-image:url('image/3.png');">
</form>
</body>
</html>
