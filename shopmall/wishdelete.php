<!--찜 리스트에서 상품을 삭제하는 테이블

<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("delete from zzimbag where session='$Session' and pcode='$pcode'", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=zzimbag.php'>");

?>
