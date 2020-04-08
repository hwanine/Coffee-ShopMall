<!--상품 찾기 페이지-->
<!--메인화면에서 상품 찾기를 눌렀을 때 나오는 페이지(입력된 정보에 맞는 상품이 나옴)-->

<? include ("top.html"); ?>

<?	
echo("<table align=center height=100 ><tr><td></td></tr></table>");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	     
if   (!isset($class)) $class=0;


$result = mysql_query("select * from product where name like '%$key%' order by hit desc", $con);


$total = mysql_num_rows($result);
echo("<table width=900 align=center>
		<tr>
			<td><b>$key</b>로 검색한 물품은 총 <b>$total</b> 개 입니다.</td>
		</tr>
		<tr>
			<td><hr size=2 width=100% color=black></td>
		</tr>
	</table>");
echo   ("<br><table border=0 width=900 align=center><tr>");

if (!$total){
	echo ("<td align=center><font color=red>상품이 없습니다</td>");
} else {

	$counter = 0;
	while ($counter < $total &&   $counter < 15) :

		if ($counter > 0 && ($counter % 5) == 0) echo ("</tr><tr><td colspan=5><hr size=1   color=black width=100%></td></tr><tr>");

		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price=mysql_result($result,$counter,"price");

		switch(strlen($price)) {
			case 6: 
			   $price = substr($price, 0, 3) . "," . substr($price, 3,   3);
			   break;
			case 5:
			   $price = substr($price, 0, 2) . "," . substr($price, 2,   3);
			   break;
			case 4:
			   $price = substr($price, 0, 1) . "," . substr($price, 1,   3);
			   break;	   
		}
		
		echo ("<td width=225  align=center><a href=p-show.php?code=$code> <img src='./photo1/$userfile' width=150 height=150 border=0><br><font color=blue style='text- decoration:none;   font-size:10pt;'>$name</a></font><br>");
		echo ("<font color=red   size=2>$price&nbsp;원</font></td>");

		$counter++;
	endwhile;
}
echo ("</tr></table>");
mysql_close($con);
echo("<table align=center height=100 ><tr><td></td></tr></table>");
?>

</td></tr>
</table>
<? include ("bottom.html");   ?>
