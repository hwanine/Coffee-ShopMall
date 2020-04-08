<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

//수취인 정보 테이블(receivers)에서 주문 번호(ordernum)에 맞는 데이터를 가져옴
$result = mysql_query("select status from receivers where ordernum='$ordernum'", $con);
$total = mysql_num_rows($result);

if ($total > 0) {
	$status = mysql_result($result, 0, "status");
	$status = $status + 1;
} else {
	$status = 1;
}

//수취인 정보 테이블(recivers)에서 배송상태(status)정보를 변경함
$result = mysql_query("update receivers set status=$status where ordernum='$ordernum'", $con);

mysql_close($con);	

echo ("<meta http-equiv='Refresh' content='0; url=c-orderlist.php'>");

?>
