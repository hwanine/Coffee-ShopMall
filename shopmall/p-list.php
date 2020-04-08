<!--각 상품 카테고리에 맞는 정보를 보여주는 테이블-->
<!--메인화면에서 각 카테고리를 누르면 그 카테고리에 맞는 상품들만 정렬해서 보여줌-->

 
<? include ("top.html"); ?>

<?	
echo("<table align=center height=100 ><tr><td></td></tr></table>");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	     
if   (!isset($class)) $class=0;

//상품 정보 테이블(product)에서 class정보에 맞는 데이터들을 가져옴
$result = mysql_query("select * from product where class=$class order by hit desc", $con);



$total = mysql_num_rows($result);
	
echo   ("<table border=0 width=900 align=center><tr>");

if (!$total){
	echo ("<td align=center><font color=red>아직 등록된 상품이 없습니다</td>");
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
