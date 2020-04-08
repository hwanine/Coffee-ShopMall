<!--공지사항(삭제) 페이지-->



<?
	//관리자 아이디는 donguk입니다!
	if($UserID != 'donguk'){
	echo("
		<script>
		window.alert('관리자만 작성할 수 있습니다.')
		history.go(-1)
		</script>
	");
	exit;
	}
?>
<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

mysql_query("delete from customer where id=$id",$con);
echo("
	<script>
	window.alert('글이 삭제 되었읍니다.');
	</script>
");

// 삭제된 글보다 글 번호가 큰 게시물은 글 번호를 1씩 감소
$tmp = mysql_query("select id from customer order by id desc", $con);
$last = mysql_result($tmp, 0, "id");     // 가장 마지막 글 번호 추출

$i = $id + 1;       // 삭제된 글의 번호보다 1이 큰 글 번호부터 변경
while($i <= $last):
	mysql_query("update customer set id=id-1 where id=$i", $con);
	$i++;
endwhile;

// 글 삭제 결과를 보여주기 위한 글 목록 보기 프로그램 호출
echo("<meta http-equiv='Refresh' content='0; url=customer.php'>");

mysql_close($con);

?>
