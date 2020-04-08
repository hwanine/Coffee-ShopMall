<!--모든 상품을 보여주는 테이블(여기서 수정과 삭제가 가능함)-->

<?include("top.html");?> <!--top.html을 가져옴-->
<table height=100><tr><td></td></tr></table>
<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

//프리미엄 원두
echo("<table height=50 width=690 align=center><tr><td><font size=5><b>프리미엄 원두</b></font></td></tr></table>");

//데이터베이스에서 프리미엄 원두(class=1)의 정보만 가져옴
$result = mysql_query("select * from product where class=1 order by code", $con);
$total = mysql_num_rows($result);

echo ("<table border=1 width=690 align=center cellspacing=0 id=t1>
	<tr bgcolor=#D4F4FA id=t1><td id=t1 align=center><font size=2>상품코드</td>
	<td id=t1 colspan=2 align=center><font size=2>상품명</td>
	<td id=t1 align=center><font size=2>판매가격</td>
	<td id=t1 align=center><font size=2>수정/삭제</td></tr>");
						
//데이터 베이스에서 가져온 데이터들을 테이블에 넣어줌						
if (!$total) {
  echo("<tr id=t1><td id=t1 colspan=6 align=center>아직 등록된 상품이 없습니다</td></tr>");
} else {
	$counter = 0;
	while ($counter < $total):
	
		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price=mysql_result($result,$counter,"price");
		
		echo ("
		   <tr id=t1><td id=t1 width=100 align=center><font size=2>$code</td>
			 <td id=t1 align=center width=30><img src=./photo1/$userfile width=40 height=40 border=0></td>
			   <td id=t1 width=350 align=left><a href=p-show.php?code=$code><font size=2>$name</a></td>
			   <td id=t1 align=right width=70><font size=2>$price&nbsp;원</td>
			   <td id=t1 width=70 align=center><font size=2><a href=c-modify.php?code=$code>수정</a>/<a href=c-delete.php?code=$code>삭제</a></td></tr>");

		$counter++;
	endwhile;
}
echo ("</table>");

//핸드드립
echo("<table height=50 width=690 align=center ><tr><td><font size=5><b>핸드드립</b></font></td></tr></table>");

//데이터베이스에서 핸드드립(class=2)의 정보만 가져옴
$result = mysql_query("select * from product where class=2 order by code", $con);
$total = mysql_num_rows($result);

echo ("<table border=1 width=690 align=center cellspacing=0 id=t1>
	<tr bgcolor=#D4F4FA id=t1><td id=t1 align=center><font size=2>상품코드</td>
	<td colspan=2 align=center id=t1><font size=2>상품명</td>
	<td align=center id=t1><font size=2>판매가격</td>
	<td align=center id=t1><font size=2>수정/삭제</td></tr>");
						

//데이터 베이스에서 가져온 데이터들을 테이블에 넣어줌						
if (!$total) {
  echo("<tr id=t1><td id=t1 colspan=6 align=center>아직 등록된 상품이 없습니다</td></tr>");
} else {
	$counter = 0;
	while ($counter < $total):
	
		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price=mysql_result($result,$counter,"price");
		
		echo ("
		   <tr id=t1><td id=t1 width=100 align=center><font size=2>$code</td>
			 <td id=t1 align=center width=30><img src=./photo1/$userfile width=40 height=40 border=0></td>
			   <td id=t1 width=350 align=left><a href=p-show.php?code=$code><font size=2>$name</a></td>
			   <td id=t1 align=right width=70><font size=2>$price&nbsp;원</td>
			   <td id=t1 width=70 align=center><font size=2><a href=c-modify.php?code=$code>수정</a>/<a href=c-delete.php?code=$code>삭제</a></td></tr>");

		$counter++;
	endwhile;
}

echo ("</table>");
	    
//콜드브루
echo("<table id=t1 height=50 width=690 align=center><tr><td><font size=5><b>콜드브루</b></font></td></tr></table>");
//데이터베이스에서 콜드브루(class=3)의 정보만 가져옴
$result = mysql_query("select * from product where class=3 order by code", $con);
$total = mysql_num_rows($result);

echo ("<table id=t1 border=1 width=690 align=center cellspacing=0>
	<tr id=t1 bgcolor=#D4F4FA><td id=t1 align=center><font size=2>상품코드</td>
	<td id=t1 colspan=2 align=center><font size=2>상품명</td>
	<td id=t1 align=center><font size=2>판매가격</td>
	<td id=t1 align=center><font size=2>수정/삭제</td></tr>");
							
							
//데이터 베이스에서 가져온 데이터들을 테이블에 넣어줌
if (!$total) {
  echo("<tr id=t1><td id=t1 colspan=6 align=center>아직 등록된 상품이 없습니다</td></tr>");
} else {
	$counter = 0;
	while ($counter < $total):
	
		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price=mysql_result($result,$counter,"price");
		
		echo ("
		   <tr id=t1><td id=t1 width=100 align=center><font size=2>$code</td>
			 <td id=t1 align=center width=30><img src=./photo1/$userfile width=40 height=40 border=0></td>
			   <td id=t1 width=350 align=left><a href=p-show.php?code=$code><font size=2>$name</a></td>
			   <td id=t1 align=right width=70><font size=2>$price&nbsp;원</td>
			   <td id=t1 width=70 align=center><font size=2><a href=c-modify.php?code=$code>수정</a>/<a href=c-delete.php?code=$code>삭제</a></td></tr>");

		$counter++;
	endwhile;
}

//차&디저트
echo("<table height=50 width=690 align=center id=t1><tr id=t1><td id=t1><font size=5><b>차&디저트</b></font></td></tr></table>");
//데이터베이스에서 차,디저트(class=4)의 정보만 가져옴
$result = mysql_query("select * from product where class=4 order by code", $con);
$total = mysql_num_rows($result);

echo ("<table border=1 width=690 align=center cellspacing=0 id=t1>
	<tr bgcolor=#D4F4FA><td align=center id=t1><font size=2>상품코드</td>
	<td colspan=2 align=center id=t1><font size=2>상품명</td>
	<td align=center id=t1><font size=2>판매가격</td>
	<td align=center id=t1><font size=2>수정/삭제</td></tr>");
	
//데이터 베이스에서 가져온 데이터들을 테이블에 넣어줌							
if (!$total) {
  echo("<tr id=t1><td id=t1 colspan=6 align=center>아직 등록된 상품이 없습니다</td></tr>");
} else {
	$counter = 0;
	while ($counter < $total):
	
		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price=mysql_result($result,$counter,"price");
		
		echo ("
		   <tr id=t1><td id=t1 width=100 align=center><font size=2>$code</td>
			 <td id=t1 align=center width=30><img src=./photo1/$userfile width=40 height=40 border=0></td>
			   <td id=t1 width=350 align=left><a href=p-show.php?code=$code><font size=2>$name</a></td>
			   <td id=t1 align=right width=70><font size=2>$price&nbsp;원</td>
			   <td id=t1 width=70 align=center><font size=2><a href=c-modify.php?code=$code>수정</a>/<a href=c-delete.php?code=$code>삭제</a></td></tr>");

		$counter++;
	endwhile;
}

echo ("</table>");


//관련용품
echo("<table height=50 width=690 align=center><tr><td><font size=5><b>관련용품</b></font></td></tr></table>");
//데이터베이스에서 관련용품(class=5)의 정보만 가져옴
$result = mysql_query("select * from product where class=5 order by code", $con);
$total = mysql_num_rows($result);

echo ("<table id=t1 border=1 width=690 align=center cellspacing=0>
	<tr id=t1 bgcolor=#D4F4FA><td align=center><font size=2>상품코드</td>
	<td id=t1 colspan=2 align=center><font size=2>상품명</td>
	<td id=t1 align=center><font size=2>판매가격</td>
	<td id=t1 align=center><font size=2>수정/삭제</td></tr>");
							
if (!$total) {
  echo("<tr id=t1><td id=t1 colspan=6 align=center>아직 등록된 상품이 없습니다</td></tr>");
} else {
	$counter = 0;
	while ($counter < $total):
	
		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price=mysql_result($result,$counter,"price");
		
		echo ("
		   <tr id=t1><td id=t1 width=100 align=center><font size=2>$code</td>
			 <td id=t1 align=center width=30><img src=./photo1/$userfile width=40 height=40 border=0></td>
			   <td id=t1 width=350 align=left><a href=p-show.php?code=$code><font size=2>$name</a></td>
			   <td id=t1 align=right width=70><font size=2>$price&nbsp;원</td>
			   <td id=t1 width=70 align=center><font size=2><a href=c-modify.php?code=$code>수정</a>/<a href=c-delete.php?code=$code>삭제</a></td></tr>");

		$counter++;
	endwhile;
}

echo ("</table>");
echo ("</table>");
mysql_close($con);

?>
<table height=100><tr><td></td></tr></table>
<?include("bottom.html");?>

