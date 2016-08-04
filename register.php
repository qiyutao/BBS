<?php
	$username = $_POST["username"];
	$passwd = md5($_POST["password"]);
	$mail = $_POST["mail"];
	
	$conn=odbc_connect('bbs','','')or die("Could not connect to ODBC database!");;
	$sql="SELECT * FROM user where username='$username'"; 
	$rs=odbc_exec($conn,$sql);
	if(odbc_fetch_row($rs))
	{
		$message = "用户已存在，请重新注册或登录";
	}
	else
	{
		$sql = "insert into user values(null,'$username','$passwd','$mail',now());";
		odbc_exec($conn,$sql);
		$message = "注册成功，返回登录";
	}
	
	odbc_close($conn);
	echo "<script> alert('$message');parent.location.href='login.html'; </script>"; 
?>