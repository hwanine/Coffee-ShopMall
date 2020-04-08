<!--필요없는 페이지입니다-->
<!--테스트용도로 만들어봄-->

<?	

echo("
	<table width=500 border=1 align=center>
		<tr>
			<td><hr size=2 width=100%></td>
			<td><fontsize>베스트상품</td>
			<td><hr size=2 width=100%></td>
		</tr>
	</table>");
echo("<table height=100 align=center><tr><td></td></tr></table>");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	     
$count = 1;
$counter = 0;

while($count<4) :
$result = mysql_query("select * from product where class=$count order by hit desc", $con);
$total = mysql_num_rows($result);
$counter = 0;
echo ("<table border=0 width=900 align=center><tr></tr><tr><td colspan=4><hr size=1   color=black width=100%></td></tr><tr>");
while ($counter < 4) :

	
	
	
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
	$count++;
endwhile;
echo ("</tr></table>");
mysql_close($con);
echo("<table align=center height=100 ><tr><td></td></tr></table>");
?>