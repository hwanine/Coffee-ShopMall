<!--마이페이지-->

<?include ("top.html");?>
<table height=100><tr><td></td></tr></table>
<?

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
$result = mysql_query("select * from member where uid='$UserID'", $con);
	
$uid = mysql_result($result, 0,   "UID"); //아이디
$uname = mysql_result($result, 0,   "UNAME"); //이름
$email = mysql_result($result, 0,   "EMAIL"); //이메일
$zip = mysql_result($result, 0,   "ZIPCODE"); //주소
$addr1 = mysql_result($result, 0,   "ADDR1"); //주소
$addr2 = mysql_result($result, 0,   "ADDR2"); //주소
$mphone = mysql_result($result, 0,   "MPHONE"); //전화번호
$poind = mysql_result($result, 0, "poind"); //사용 가능 포인트

?>
<table width=1000 border=0 align=center>
	<tr>
		<td align=center><img src=./photo/mypage.png width=1000></td>
	</tr>
	<tr>
		<td align=right><a href=umodify.php><font size=2>회원정보수정</a></td>
	</tr>
</table>

<table border=1 width=1000 align=center cellspacing=0>
	<tr>
		<td width=100 bgcolor=#A2FFFF><font size=2>이름</td>
		<td width=120><font size=2><? echo $uname; ?></td>
	</tr>
	<tr>
		<td width=80 bgcolor=#A2FFFF><font size=2>휴대전화</td>
		<td width=140><font size=2><? echo $mphone; ?></td>
	</tr>
	<tr>
		<td width=80 bgcolor=#A2FFFF><font size=2>이메일</td>
		<td width=170><font size=2><? echo $email; ?></td></tr>
	</tr>
	<tr>
		<td width=80 bgcolor=#A2FFFF><font size=2>포인트 잔여량</td>
		<td width=170><font size=2><? echo $poind; ?></td>
	</tr>
	<tr>
		<td bgcolor=#A2FFFF><font size=2>주소</td>
		<td><font   size=2><? echo $zip . " " . $addr1 . " " . $addr2;   ?></td>
	</tr>
</table>
<br><br>

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
		$buydate = mysql_result($result, $counter, "buydate");
		$ordernum = mysql_result($result, $counter, "ordernum");
		$status = mysql_result($result, $counter, "status");
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
