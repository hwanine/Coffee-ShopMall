<!--찜 리스트-->

<?
//로그인 사용자가 아닐경우 기존 페이지로 되돌아감
if (!$UserID) {
	echo ("<script>
		window.alert('로그인 사용자만 찜할 수 있습니다')
		</script>"
		);
	echo ("<meta http-equiv='Refresh' content='0; url=login.php'>"); 
      exit;
} 

if (!isset($quantity)) $quantity = 1; //동일한 물건이 담겼는지 확인하는 코드

$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 이미 쇼핑백에 담은 물건이면 수량만 보탬 
$result = mysql_query("select * from zzim where session='$Session' and pcode='$code'", $con);
$total = mysql_num_rows($result);

if ($total){
	echo ("<script>
		window.alert('이미 물품이 있습니다.')
		</script>"
		);
	echo ("<meta http-equiv='Refresh' content='0; url=login.php'>"); 
      exit;
}else{
	//찜 테이블에 데이터를 추가함
	mysql_query("insert into zzim(id, session, pcode) values ('$UserID','$Session', '$code')", $con);
}

mysql_close($con);	//데이터베이스 연결해제

echo ("<meta http-equiv='Refresh' content='0; url=zzimbag.php'>");

?>
