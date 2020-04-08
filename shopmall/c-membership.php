<!--가입고객 정보를 볼 수 있는 페이지-->

<?include("top.html");?>
<table height=100><tr><td></td></tr></table>
<?

if ($UserID != 'donguk') {
	echo ("<script>
		window.alert('관리자만 접근 가능한 기능입니다')
		history.go(-1)
		</script>");
    exit;
} 

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);

//가입 고객 정보(member) 테이블에서 정보를 읽음	
$result = mysql_query("select * from member order by uname", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=0 width=800 align=center>
    <tr><td align=center><font size=3><b>[회원 목록 조회]</b></td></tr>
	<tr><td align=right><font size=2>[<a href=admin.php>Back</a>]</td>
	</tr></table> ");
	   
$i = 0;	

echo ("
	<table border=1 width=800 align=center id=t1 cellspacing=0>
	<tr id=t1 height=35 bgcolor=#D4F4FA>
		<td id=t1 align=center width=60><font size=2><b>ID</b></td>
		<td id=t1 align=center width=50><font   size=2><b>이름</b></td>
		<td id=t1 align=center width=340><font size=2><b>주소</b></td>
		<td id=t1 align=center width=100><font size=2><b>전화번호</b></td>
		<td id=t1 align=center width=100><font size=2><b>이메일</b></td>
	</tr>
");	

// member 정보를 테이블에 저장함
while($i < $total):
	$uid = mysql_result($result, $i, "UID");
	$uname = mysql_result($result, $i, "UNAME");
	$zip = mysql_result($result, $i, "ZIPCODE");
	$addr1 = mysql_result($result, $i, "ADDR1");
	$addr2 = mysql_result($result, $i, "ADDR2");
	$mphone = mysql_result($result, $i, "MPHONE");
	$email = mysql_result($result, $i, "EMAIL");
	$approved = mysql_result($result, $i, "APPROVED");

	$address = "(" . $zip .   ")" . "&nbsp;" . $addr1 . "&nbsp;" .   $addr2;
	
    echo ("<tr id=t1 height=30><td align=center><font size=2>$uid</td>
		<td id=t1 align=center><font size=2>$uname</td>
		<td id=t1><font size=2>$address</td>
		<td id=t1 align=center><font size=2>$mphone</td>
		<td id=t1 align=center><font size=2>$email</td>");
		
	
	      
	$i++;
endwhile;

echo ("</table>");
mysql_close($con);

?>
<table height=100><tr><td></td></tr></table>
<?include("bottom.html");?>

