<?php
	$id = $_GET['id'];
	
	echo '<html>';
	echo '<head>';
	echo '<meta http-equiv="Content-Type" content="text/htm;charset=utf-8" />';
	echo '<title>详细内容</title>';
	echo '</head>';

	echo "<body background='image/snow.jpg'>";
	
	$conn=odbc_connect('bbs','','')or die("Could not connect to ODBC database!");;
	$sql="select title from subject where id=$id";
	$rs=odbc_exec($conn,$sql);
	$title=iconv("GBK", "UTF-8", odbc_result($rs,1));
	echo "<h2>".$title."</h2><br><br><hr>";
	$sql="select * from context where id=$id";
	$rs=odbc_exec($conn,$sql);
	while(odbc_fetch_row($rs))
	{
		$num = odbc_result($rs,1);
		$name = iconv("GBK", "UTF-8", odbc_result($rs,4));
		$cont = iconv("GBK", "UTF-8", odbc_result($rs,5));
		$date = iconv("GBK", "UTF-8", odbc_result($rs,6));
		
		echo $num."楼<br>";
		echo "by.".$name."<br><br>";
		echo nl2br($cont)."<br><br>";
		echo "时间：".$date."<br><hr>";
	}
	odbc_close($conn);
	
	echo "<form name='f' action='reply.php?id=$id' method='post'>"
?>

<textarea name="testarea" rows="15" cols="87" style="background-image:url('image/snow.jpg');margin-left: 0px;margin-top: 125px;width:630px;">回复内容</textarea><br>
<input type="submit" value="回复" style="background-image:url('image/snow.jpg')">
</form>
</body>
</html>
