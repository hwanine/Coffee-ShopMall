<!--쇼핑백에 담긴 정보 삭제 페이지-->
<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

//pcode에 맞는 상품을 쇼핑백 테이블에서 삭제함
$result = mysql_query("delete from shoppingbag where session='$Session' and pcode='$pcode'", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=showbag.php'>");

?>
