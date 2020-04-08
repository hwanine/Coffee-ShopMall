<!--상품 상세 정보-->

<? include ("top.html");?>
<?
echo("<table height=100><tr><td></td></tr></table>");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product where code='$code'", $con);
$total = mysql_num_rows($result);

$name=mysql_result($result,0,"name"); //상품 이름
$content=mysql_result($result,0,"content"); //상품 내용
$content=nl2br($content);
$class =mysql_result($result,0,"class"); 

$price=mysql_result($result,0,"price"); //상품 가격
$userfile=mysql_result($result,0,"userfile"); //상품 정보 이미지
$contentfile=mysql_result($result,0,"contentfile"); //상품 정보 이미지
$price1 = $price /100; //적립될 포인트
// 상품의 조회수를 읽어와서 1 증가시킨 다음 업데이트 쿼리를 적용
$hit=mysql_result($result,0,"hit");
$hit++;

mysql_query("update product set hit=$hit where code='$code'", $con);

echo ("
	<table width=650 border=0 align=center>
    <tr>
		<td width=250 align=center valign=top>
			<a href=# onclick=\"window.open('./photo1/$userfile', '_new', 'width=450, height=450')\"><img src='./photo1/$userfile' width=230 height=230 border=1></a>
		</td>
		<td width=400 valign=top>
			<table border=0 width=100%>
				<tr>
					<td colspan=3 height=50><font size=4>$name</font></td>
				</tr>
				<tr>
					<td colspan=3><hr size=1 color=black></td>
				</tr>
				<tr>
					<td width=180><font size=2>제품</font></td>
					<td width=220><font size=2>$code</td>
					<td rowspan=6 width=250 align=center>					
						<form method=post action=tobag.php?code=$code>
						<input type=text size=3 name=quantity value=1>
						<input type=submit value=담기>
						</form>
						<form method=post action=zzim.php?code=$code>
						<input type=submit value=찜하기>
						</form>
					</td>
				</tr>
				<tr>
					<td><font size=2>상품이름</font></td>
					<td><font size=2>$name</td>
				</tr>
				<tr>
					<td><font size=2>상품가격</font></td>
					<td><font size=2><b>$price&nbsp;원</b></td>
				</tr>
				<tr>
					<td><font size=2>적립금</font></td>
					<td><font size=2>$price1&nbsp;원</td>
				</tr>
				<tr>
					<td><font size=2>브랜드</font></td>
					<td><font size=2>일산커피공장</td>
				</tr>
				<tr>
					<td><font size=2>제조사</font></td>
					<td><font size=2>일산커피공장</td>
				</tr>
				
			</table>
		</td>
	</tr>
	</table>	
	<br>
	<table width=650 border=0 align=center>
		<tr><td><font size=5><hr size=2 color=black>상품 상세 정보</font></td></tr>
		<tr><td><hr size=1></td></tr>
		<tr><td align=center><img src='./photo/shop.png' width=700></td></tr>
		<tr><td align=center><img src='./photo1/$contentfile' width=700></td></tr>
	</table>
");
echo("<table><tr><td><hr size=5></td></tr></table>");
mysql_close($con);

?>
<? include ("bottom.html");?>
