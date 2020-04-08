<!--공지사항 수정 테이블(p-modify.php에 이어서...)-->

<?
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
$result = mysql_query("select * from customer where id=$id", $con);

// 기존 필드값을 유지할 항목을 추출함
// 변경 내용을 테이블에 저장함
mysql_query("update customer set topic='$topic', content='$content' where id=$id", $con);

echo("<meta http-equiv='Refresh' content='0; url=customer.php'>");

mysql_close($con);

?>
