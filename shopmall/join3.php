<!--회원 가입 페이지(회원 정보 데이터베이스에 입력)-->


<? 
include ("top.html"); 

if (!$uid) {
	echo ("<script>
		window.alert('사용자 ID를 입력하세요');
		history.go(-1);
		</script>");
	exit;
}
if (!$upass1) {
	echo ("<script>
		window.alert('비밀번호를 입력해 주세요');
		history.go(-1);
		</script>");
	exit;
}
if ($upass1 != $upass2) {
	echo ("<script>
		window.alert('비밀번호와 비밀번호 확인이 일치하지 않습니다');
		history.go(-1);
		</script>");
	exit;
}
if (!$uname) {
	echo ("<script>
		window.alert('이름을 입력해 주세요');
		history.go(-1);
		</script>");
	exit;
}	
	
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall", $con);

//join2.php에서 받은 변수들로 회원정보테이블(member)에 저장함
$result = mysql_query("insert into member(uid, upass,uname, mphone, email, zipcode, addr1, addr2, approved) values ('$uid', '$upass1', '$uname', '$mphone', '$email', '$zip', '$addr1', '$addr2', 0)", $con);
	

	
mysql_close($con);

	
?>

<table height=50><tr><td></td></tr></table>
<table width=670 align=center id=t1 cellspacing=0 height=50>
	<tr>
		<td align=center><img src="./photo/join3_1.png"></td>
	</tr>
	<tr>
		<td align=center><a href="main.html"><img src="./photo/join3_2.png"></a></td>
	</tr>
</table>
<table height=50><tr><td></td></tr></table>

<? include ("bottom.html"); ?>