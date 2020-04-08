<!--쇼핑백에 담긴 상품 보여주는 페이지-->

<? include ("top.html");?>
<?
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
<tr><td align=center><font size=3><img src=./photo/shopbag.png width=1000></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>님의 현재 쇼핑 카트 내용</td>
</table>

<?
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=1 width=1000 align=center id=t1 cellspacing=0>
		<tr bgcolor=#F6F6F6 id=t1>
			<td width=100 align=center id=t1><font size=2>상품사진</td>
			<td width=300 align=center id=t1><font size=2>상품이름</td>
			<td width=90 align=center id=t1><font size=2>가격(단가)</td>
			<td width=50 align=center id=t1><font size=2>수량</td>
			<td width=100 align=center id=t1><font size=2>품목별합계</td>
			<td width=50 align=center id=t1><font size=2>삭제</td>
		</tr>
");

if (!$total) {
     echo("<tr id=t1><td id=t1 colspan=6 align=center><font size=2><img src=./photo/nopick.png width=1000></td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;    // 총 구매 금액  

    while ($counter < $total) :
       $pcode = mysql_result($result, $counter, "pcode");  //상품 코드
       $quantity = mysql_result($result, $counter, "quantity"); //상품 수량
   
       $subresult = mysql_query("select * from product where code='$pcode'", $con);
       $userfile = mysql_result($subresult, 0, "userfile"); 
       $pname = mysql_result($subresult, 0, "name"); //상품 이름

       $price = mysql_result($subresult, 0, "price"); //상품 가격
     
       $subtotalprice = $quantity * $price;
       $totalprice = $totalprice + $subtotalprice; 

		echo ("
			<tr id=t1>
				<td align=center id=t1>
					<a href=# onclick=\"window.open('./photo1/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo1/$userfile' width=50   border=0></a></td>
				<td align=center id=t1><font size=2><a   href=p-show.php?code=$pcode>$pname </a></td>
				<td align=right id=t1><font size=2>$price&nbsp;원</td>
				<td align=center id=t1>
					<form method=post action=qmodify.php?pcode=$pcode><input type=text name=newnum size=3 value=$quantity>&nbsp;<input type=submit value=변경>
				</td></form>
				<td align=right id=t1><font size=2>$subtotalprice&nbsp;원</td>
				<td align=center id=t1>
					<form method=post action=itemdelete.php?pcode=$pcode><input type=submit value=삭제>
				</td></form>
			</tr>");

		$counter++;
    endwhile;
 	$poind = $totalprice / 100;
    echo("<tr id=t1 bgcolor=#F6F6F6 border=1>
				<td colspan=4 align=right id=t1></td>
				<td id=t1><font size=2>적립금</font>:<font size=2 color=red> $poind</font> <font size=2>원</font></td>
				<td id=t1><font size=2>합계 : <font size=2 color=red>$totalprice</font>  <font size=2>원</font></td>
		</tr></table>");
		
		
	echo("<table height=40><tr><td></td></tr></table>
		<table width=1000 border=0 cellspacing=0 align=center>
			<tr>
				<td><font size=2><b>$UserName 고객님께서 결제하실 내역입니다.</b></td>
			</tr>
		</table>");
	echo("<table width=1000 border=1 cellspacing=0 align=center>
				<tr height=50>
					<td bgcolor=#F6F6F6 align=center>상품가격</td>
					<td align=center><font color=red>$totalprice</font></td>");
	if($totalprice>=30000){
		$delivery='무료배송';
		$total1=$totalprice;
	}else{
		$delivery=2500;
		$total1=$delivery + $totalprice;
	}
	
	echo("
					<td bgcolor=#F6F6F6 align=center>배송비</td>
					<td align=center><font color=#1DDB16>$delivery</font></td>
					<td bgcolor=#F6F6F6 align=center>총금액</td>
					<td align=center><font color=red>$total1</font></td>
				</tr>");
}

mysql_close($con);	//데이터베이스 연결해제

echo ("<table width=1000 border=0 align=center>
	<tr><td align=right><font size=2><a href=buy.php><img src=./photo/pick.png width=100 height=40></a> <a href=main.html><img src=./photo/pick1.png width=100 height=40></a></td></tr></table>");

?>
<table height=100><tr><td></td></tr></table>

<? include ("bottom.html");?>