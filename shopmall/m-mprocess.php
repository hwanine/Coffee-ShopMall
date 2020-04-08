<!--m-modify.php에서 보낸 변수를 이용해 후기 변경 페이지-->
<?

if (!$writer){
	echo("
		<script>
		window.alert('이름이 없습니다. 다시 입력하세요')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$topic){
	echo("
		<script>
		window.alert('제목이 없습니다. 다시 입력하세요')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$content){
	echo("
		<script>
		window.alert('내용이 없습니다. 다시 입력하세요')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from comment where id=$id", $con);

// 기존 필드값을 유지할 항목을 추출함



// 변경 내용을 테이블에 저장함
mysql_query("update comment set writer='$writer', passwd='$passwd', topic='$topic', content='$content' where id=$id", $con);

echo("<meta http-equiv='Refresh' content='0; url=comment.php'>");

mysql_close($con);

?>
