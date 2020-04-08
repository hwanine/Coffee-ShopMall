<!--비밀번호 찾기 페이지-->
<!--앞의 페이지에서 받은 uname(이름), uid(아이디), email(이메일) 변수를 이용해 고객 정보 테이블(member)에서 데이터를 가져와 사용자에게 알려줌-->
<?
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from member where uname='$uname' and uid='$uid'   and email='$email'", $con);
$total = mysql_num_rows($result);

if (!$total)   {
   echo("
      <script>
      window.alert('입력하신 아이디와 이름과 이메일 주소를 동시에 만족하는 사용자 아이디가 없습니다')
      history.go(-1)
      </script>
   ");
   exit;
} else {
	$upass = mysql_result($result, 0, "upass");
   echo("
      <script>
      window.alert('귀하의 비밀번호는 $upass 입니다')
      </script>
   ");
}

mysql_close($con);	
echo   ("<meta http-equiv='Refresh' content='0; url=login.php'>");
?>
