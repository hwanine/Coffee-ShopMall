<!--마이페이지 (주문배송조회) -->

<?include ("top.html");?>
<table height=100><tr><td></td></tr></table>
<?

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
$result = mysql_query("select * from member where uid='$UserID'", $con);
	
$uid = mysql_result($result, 0,   "UID"); //아이디
$uname = mysql_result($result, 0,   "UNAME"); //이름
$email = mysql_result($result, 0,   "EMAIL"); //이메일
$zip = mysql_result($result, 0,   "ZIPCODE");
$addr1 = mysql_result($result, 0,   "ADDR1"); //주소
$addr2 = mysql_result($result, 0,   "ADDR2"); //주소
$mphone = mysql_result($result, 0,   "MPHONE"); //전화번호

?>

<?
$result = mysql_query("select * from receivers where id='$UserID' order by buydate desc", $con);
$total = mysql_num_rows($result);

echo ("
	<table width=1000 border=0 align=center>
	<tr><td   align=center><img src=./photo/buyclear.png width=1000></td></tr>
	<tr><td>* <font color=red   size=2>주문 물품이 배송 이전 단계이면 온라인으로 주문   취소가 가능합니다.</td></tr>
	<tr><td>* <font size=2>배송중이거나 구매 완료된 제품에 대한 반품 및 환불 요청은     당사 고객센터(전화: 010-5509-0020)로 문의바랍니다.</td></tr>
	</table>

	<table border=1 width=1000 align=center cellspacing=0 id=t1>
	<tr bgcolor=#EAEAEA id=t1>
		<td align=center id=t1><font size=2>구매번호</td>
		<td align=center id=t1><font size=2>구매일자</td>
		<td align=center id=t1><font size=2>주문내역</td>
		<td align=center id=t1><font size=2>금액</td>
		<td align=center id=t1><font size=2>주문상태</td>
	</tr>");	

if ($total > 0) {	
	$counter = 0;
	while($counter < $total) :
		$session = mysql_result($result, $counter, "session");
		$buydate = mysql_result($result, $counter, "buydate"); //구매 날짜
		$ordernum = mysql_result($result, $counter, "ordernum"); //주문 번호
		$status = mysql_result($result, $counter, "status"); //주문 상태
		$oldstatus = $status;
	 
		switch ($status) {
		  case 1:
				$status = "주문신청";
				break;
		  case 2:
				$status = "주문접수";
				break;
		  case 3: 
				$status = "배송준비중";
				break;
		  case 4:
				$status = "배송중";
				break;
		  case 5:
				$status = "배송완료";
				break;
		  case 6:
				$status = "구매완료";
				break;
		}
	 
		$subresult = mysql_query("select * from orderlist where session='$session'",   $con);
        $subtotal =  mysql_num_rows($subresult);

        $subcounter=0;
        $totalprice=0;

        while ($subcounter <   $subtotal) :
             $pcode = mysql_result($subresult, $subcounter, "pcode");
             $quantity = mysql_result($subresult, $subcounter, "quantity");
      
             $tmpresult = mysql_query("select * from product where code='$pcode'", $con);
             $pname = mysql_result($tmpresult, 0, "name");
			 $price = mysql_result($tmpresult, 0, "price");
       
             $subtotalprice = $quantity * $price;
             $totalprice = $totalprice + $subtotalprice;
             $subcounter++;
        endwhile;
	
		$items = $subtotal - 1;
	
        echo ("<tr>
			<td align=center id=t1><font size=2>
				<a href=# onclick=\"window.open('detailview.php?ordernum=$ordernum', '_new',   'width=940, height=250, scrollbars=yes');\">$ordernum</a></td>
			<td align=center id=t1><font size=2>$buydate</td>
			<td align=center id=t1><font size=2>$pname 외 $items 종</td>
			<td align=center id=t1><font   size=2>$totalprice 원</td>
			<td align=center id=t1><font size=2>$status");
      
		if ($oldstatus < 4) echo ("<br>(<a href=ordercancel.php?ordernum=$ordernum>주문취소</a>)");

		echo ("</td></tr>");

		$counter++;
	endwhile;

} else {

	echo ("<tr id=t1><td align=center colspan=5 id=t1><font size=2><b>주문 내역이 존재하지 않습니다</b></td></tr>");

}

echo ("</table>");

mysql_close($con);	

?>
<table height=100><tr><td></td></tr></table>
<?include ("bottom.html");?>