<!--공지사항 등록 테이블(p-input.php에 이어서...)-->
<?

if(!$topic){
	echo("
		<script>
		window.alert('제목이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$content){
	echo("
		<script>
		window.alert('내용이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

// 데이터베이스에 연결
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result=mysql_query("select id from customer",$con);
$total=mysql_num_rows($result);

// 글에 대한 id부여
if (!$total){
	$id = 1;
} else {
	$id = $total + 1;
}
if ($filename) {	
   $savedir = "./photo2";	//첨부 파일이 저장될 폴더
   $temp = $filename_name;
   copy($filename, "$savedir/$temp");
   unlink($filename);
}
$wdate = date("Y-m-d");	//   글 쓴 날짜 저장

// 테이블에 입력 글 내용을 저장
mysql_query("insert into customer(id, topic, content, hit, wdate, filename) values($id, '$topic', '$content', 0, '$wdate','$filename_name')", $con);

mysql_close($con);	// 데이터베이스 연결해제

//show.php 프로그램을 호출하면서 테이블 이름을 전달
echo("<meta http-equiv='Refresh' content='0; url=customer.php'>");

?>



