<!--찜 페이지-->
<? include ("top.html");?>

<?
//로그인 되어있지 않을 시 로그인 하는 페이지(login.php)로 넘어감
if (!isset($UserID)) {
	echo ("<script>
		window.alert('로그인 사용자만 이용하실 수 있어요')
		<meta http-equiv='Refresh' content='0; url=login.php'>
		</script>");
	exit;
}
?>
<table height=100><tr><td></td></tr></table>
<table width=1000 border=0 align=center>
<tr><td align=center><font size=3><img src=./photo/wishlist.png width=1000></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>님의 위시 리스트</td>
</table>

<?
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from zzim where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=1 width=1000 align=center id=t1 cellspacing=0>
		<tr bgcolor=#F6F6F6 id=t1>
			<td width=100 align=center id=t1><font size=2>상품사진</td>
			<td width=300 align=center id=t1><font size=2>상품이름</td>
			<td width=90 align=center id=t1><font size=2>가격(단가)</td>
			<td width=100 align=center id=t1><font size=2>적립 포인트</td>
			<td width=50 align=center id=t1><font size=2>삭제</td>
		</tr>
");

if (!$total) {
     echo("<tr id=t1><td id=t1 colspan=6 align=center><font size=2><img src=./photo/nopick.png width=1000></td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;    // 총 구매 금액  

    while ($counter < $total) :
       $pcode = mysql_result($result, $counter, "pcode");
   
       $subresult = mysql_query("select * from product where code='$pcode'", $con);
       $userfile = mysql_result($subresult, 0, "userfile");
       $pname = mysql_result($subresult, 0, "name");

       $price = mysql_result($subresult, 0, "price");
       
       $subprice = $price / 100;

		echo ("
			<tr id=t1>
				<td align=center id=t1>
					<a href=# onclick=\"window.open('./photo1/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo1/$userfile' width=50   border=0></a></td>
				<td align=center id=t1><font size=2><a   href=p-show.php?code=$pcode>$pname </a></td>
				<td align=right id=t1><font size=2>$price&nbsp;원</td>
				
				<td align=right id=t1><font size=2>$subprice&nbsp;원</td>
				<td align=center id=t1>
					<form method=post action=wishdelete.php?pcode=$pcode><input type=submit value=삭제>
				</td></form>
			</tr>");

		$counter++;
    endwhile;
 	$poind = $totalprice / 100;
    echo("</table>");
		
	
}

mysql_close($con);	//데이터베이스 연결해제


?>
<table height=100><tr><td></td></tr></table>

<? include ("bottom.html");?>