<!--회원 정보 수정 페이지-->

<? include("top.html");?>
<table height=100><tr><td></td></tr></table>
<? 
$con =   mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
	
$result = mysql_query("select * from member where uid='$UserID'", $con);
	
$uname = mysql_result($result, 0, "uname"); //이름
$email = mysql_result($result, 0, "email"); //이메일
$zip = mysql_result($result, 0, "zipcode");
$addr1 = mysql_result($result, 0,  "addr1"); //주소
$addr2 = mysql_result($result, 0,  "addr2"); //주소
$mphone = mysql_result($result, 0, "mphone"); //전화번호
	
echo ("
	<script language='Javascript'>
	function go_zip(){
		window.open('zipcode.php','ZIP','width=470, height=180, scrollbars=yes');
	}
	</script>

	<form action=register2.php method=post name=comma>
	<table width=800 border=0 cellpadding=0 cellspacing=5 align=center>
	<tr><td height=40><img src=./photo/mypage1.png width=800></td></tr>
	</table>
	<table border=1 width=800 align=center>
	<tr><td>
		<table width=670 border=0 align=center>
			<tr>
				<td width=5% align=right>*</td>
				<td width=15% height=30><font size=2>회원 ID</td>
				<td width=80%><font   size=2><b>$UserID</b></td></tr>
			<tr>
				<td align=right>*</td>
				<td height=30><font size=2>비밀번호</font></td>
				<td><input type=password   maxlength=15 style='height:20;' size=20 name=upass1></td></tr>
			<tr>
				<td   align=right >*</td>
				<td height=30><font size=2>비밀번호확인</font></td>
				<td><input type=password   maxlength=15 style='height:20;' size=20 name=upass2></td></tr>
			<tr>
				<td align=right>*</td>
				<td height=30><font size=2>이 름</font></td>
				<td><input type=text size=10   name=uname value=$uname></td></tr>
			<tr>
				<td align=right>*</td>
				<td height=30><font size=2>휴대전화</font></td>
				<td><input type=text size=20 name=mphone value=$mphone></td> </tr>
			<tr>
				<td align=right>*</td>
				<td height=30><font size=2>이메일</td>
				<td><input type=text size=30 name=email value=$email></td></tr>
			<tr>
				<td align=right>*</td>
				<td height=30><font size=2>집주소</td>
				<td><input type=text size=7   name=zip value=$zip readonly=readonly> <font size=2>[<a   href='javascript:go_zip()'>우편번호검색</a>]</font><br>
					<input type=text size=50 name=addr1 value='$addr1' readonly=readonly><br><input type=text size=35 name=addr2 value='$addr2'> 
				</td></tr>
		</table>
    </td></tr>
	</table>
  
	<table width=800 border=0 cellpadding=0 cellspacing=5 align=center>
	<tr><td height=40><input type=submit value='회원정보수정'> </td></tr>
	</table>
	</form>
");

?>

<table height=100><tr><td></td></tr></table>
<? include("bottom.html");?>

