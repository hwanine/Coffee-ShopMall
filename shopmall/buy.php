<!--zipcode2.php를 가져오는 함수-->
<script language='Javascript'>
	function go_zip(){
		window.open('zipcode2.php', 'zipcode',   'width=470, height=180, scrollbars=yes');
	}
</script>
<?include ("top.html")?> <!--top.html 내용을 불러옴-->
<table height=100><tr><td></td></tr></table>

<table width=1000 align=center>
<tr><td align=center><font size=3><img src=./photo/buy.png width=1000></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>님의 현재 쇼핑 카트 내용</td>
</table>

<?
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

// 위에서 읽은 쇼핑백 정보를 테이블에 넣는다.
echo ("
	<table border=1 width=1000 align=center id=t1 cellspacing=0>
		<tr bgcolor=#F6F6F6 id=t1>
			<td width=100 align=center id=t1><font size=2>상품사진</td>
			<td width=300 align=center id=t1><font size=2>상품이름</td>
			<td width=90 align=center id=t1><font size=2>가격(단가)</td>
			<td width=50 align=center id=t1><font size=2>수량</td>
			<td width=100 align=center id=t1><font size=2>품목별합계</td>
		</tr>
");

if (!$total) {
	//상품이 아무것도 없을 시 nopick.png 이미지 파일 출력
     echo("<tr id=t1><td id=t1 colspan=6 align=center><font size=2><img src=./photo/nopick.png width=1000></td></tr></table>");
} else {

    $counter=0;      //쇼핑백의 정보를 순서대로 가져오기 위한 변수
    $totalprice=0;    // 총 구매 금액  

	
	//counter에 맞는 쇼핑백의 정보를 변수안에 선언하고 테이블안에 넣어줌
    while ($counter < $total) :
       $pcode = mysql_result($result, $counter, "pcode");
       $quantity = mysql_result($result, $counter, "quantity");
   
       $subresult = mysql_query("select * from product where code='$pcode'", $con);
       $userfile = mysql_result($subresult, 0, "userfile");
       $pname = mysql_result($subresult, 0, "name");

       $price = mysql_result($subresult, 0, "price");
       
       $subtotalprice = $quantity * $price;
       $totalprice = $totalprice + $subtotalprice; 

		echo ("
			<tr id=t1>
				<td align=center id=t1>
					<a href=# onclick=\"window.open('./photo1/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo1/$userfile' width=50   border=0></a></td>
				<td align=center id=t1 width=700><font size=2><a   href=p-show.php?code=$pcode>$pname </a></td>
				<td align=center id=t1><font size=2>$price&nbsp;원</td>
				<td align=center id=t1>
					$quantity
				</td>
				<td align=center id=t1 width=100><font size=2>$subtotalprice&nbsp;원</td>
	
			</tr>");

		$counter++;
    endwhile;
 	$poind = $totalprice / 100;  //적립될 포인트
    echo("<tr id=t1 bgcolor=#F6F6F6 border=1>
				<td colspan=2 align=right id=t1></td>
				<td id=t1 colspan=2><font size=2>적립금</font>:<font size=2 color=red> $poind</font> <font size=2>원</font></td>
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
					<td align=center><font color=red>$totalprice</font></td>
					");
					
	//최종금액이 3만원 이상이면 배송비(delivery) 안나옴
	if($totalprice>=30000){
		$delivery='무료배송';
		$total1=$totalprice;
	}else{   //3만원 미만일 경우 배송비 2500원
		$delivery=2500;
		$total1=$delivery + $totalprice;
	}
	
	$usepoint = mysql_result($result, 0, "usepoint");   //사용 가능 포인트
	echo("
					<td bgcolor=#F6F6F6 align=center>배송비</td>
					<td align=center><font color=#1DDB16>$delivery</font></td>
					<td bgcolor=#F6F6F6 align=center>포인트</td>
					<td align=center>
						<form method=post action=usepoint.php><input type=text name=usepoint size=3 value=$usepoint>&nbsp;<input type=submit value=변경>
					</td></form>
	");
	
	$total1 = $total1-$usepoint;  // 포인트를 ?고 난 뒤 최종 금액
	echo("
					<td bgcolor=#F6F6F6 align=center>총금액</td>
					<td align=center><font color=red>$total1</font></td>
				</tr>");
}

mysql_close($con);	//데이터베이스 연결해제


echo("<table height=50><tr><td></td></tr></table>
	<table width=1000 align=center>
		<tr>
			<td><img src=./photo/buy1.png></td>
			<td align=right><a href=showbag.php><img src=./photo/privious.png></a></td>
		</tr>
	</table>");
	
echo("<table width=1000 align=center border=0>
		<tr>
			<td colspan=2><hr size=2 width=1000 color=#EAEAEA></td>
		</tr>
		<tr>
			<td width=150><img src=./photo/plus.png width=10><font size=2>결제수단선택</font></td>
			<td><font size=2>계좌이체</td>
		</tr>
		<tr>
			<td width=150><img src=./photo/plus.png width=10><font size=2>입금하실 계좌</font></td>
			<td>
				<font size=2>입금 계좌: <b>경남은행 544-22-0643411 (예금주: 김동욱)</b></font>
				<font size=2 color=#008100>
				<br>- 구입하신 물품은 입금 확인후 배송되며, 주문 진행 상황은 My Page에서 확인하실 수 있습니다.
				<br>- 물품 배송 이전에 주문 취소를 원하시면 My Page에서 직접 주문 취소 요청을 하시면 됩니다.
				<br>- 물품을 배송 받으신 후에 구매 취소를 원하시면 고객센터(전화:010-5509-0020)로 연락주세요.</font>
			</td>
		</tr>
		<tr>
			<td colspan=2><hr size=2 width=1000 color=#EAEAEA></td>
		</tr>
		<form method=post action=endshopping.php?total=$totalprice name=buy>
		<tr>	
			<td><img src=./photo/plus.png width=10><font size=2><font size=2>배송 고객성명</td>
			<td><input type=text name=receiver size=10></td>
		</tr>
		<tr>
			<td><img src=./photo/plus.png width=10><font size=2><font size=2>전화번호</td>
			<td><input type=text name=phone   size=20></td>
		</tr>
		<tr>
			<td height=30><img src=./photo/plus.png width=10><font size=2><font size=2>배송주소</td>
			<td align=left><input type=text size=6 name=zip readonly=readonly>
				<font size=2>[<a href='javascript:go_zip()'>우편번호검색</a>]<br> 
				<input type=text size=55 name=addr1 readonly=readonly style='font-size:10pt; font-family:Tahoma;'>
				<input type=text size=30 name=addr2   style='font-size:10pt; font-family:Tahoma;'>
			</td>
		</tr>
		<tr>
			<td><img src=./photo/plus.png width=10><font size=2><font size=2>주문요구사항</td>
			<td><textarea name=message rows=3 cols=65></textarea></td>
		</tr>
		<tr>
			<td colspan=2><hr size=2 width=1000 color=#EAEAEA></td>
		</tr>
		<tr>
			<td align=center colspan=2>
				<input type='image' src='./photo/buysuccess.png' width=200>
			</td>
		</tr>
	</table>
	</form>
	");


?>
<table height=100><tr><td></td></tr></table>
<?include ("bottom.html")?>
