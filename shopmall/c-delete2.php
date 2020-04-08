<!--c.delete.php에서 삭제 (예)를 눌렀을 ? 나오는 페이지-->
<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 상품 이미지 파일을 photo 폴더 내에서 삭제
$tmp = mysql_query("select userfile from product where code='$code'", $con);
$fname = mysql_result($tmp, 0, "userfile");
$savedir = "./photo1";
unlink("$savedir/$fname");

//상품 코드에 맞는 데이터가 데이터베이스에서 삭제됨
$result = mysql_query("delete from product where code='$code'", $con);

// 상품이 없을경우(삭제 불가)
if (!$result) {
   echo("
      <script>
      window.alert('상품 삭제에 실패했습니다')
      history.go(-1)
      </script>
   ");
   exit;
} else { //상품이 있으면 삭제
   echo("
      <script>
      window.alert('상품이 정상적으로 삭제되었습니다')
      </script>
   ");
}

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=c-adminlist.php'>");

?>
