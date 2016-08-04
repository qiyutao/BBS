<?php
	session_start();
	
	$username = $_POST["username"];
	$passwd = md5($_POST["password"]);
	
	$conn=odbc_connect('bbs','','')or die("Could not connect to ODBC database!");;
	$sql="SELECT * FROM user where username='$username'"; 
	$rs=odbc_exec($conn,$sql);
	if(odbc_fetch_row($rs))
	{
		if($passwd==odbc_result($rs,"passwd"))
		{
			$_SESSION['user'] = $username;
			odbc_close($conn);
			echo "<script> alert('登录成功，即将跳转至首页！');parent.location.href='index.php'; </script>";
			exit;
		}
		else
		{
			$message = '密码错误，请重新输入！';
		}
	}
	else
	{
		$message = '用户名错误，请重新输入！';
	}
	
	odbc_close($conn);
	echo "<script> alert('$message');parent.location.href= 'javascript:history.back()';</script>";
?>