<!--로그아웃 페이지-->

<?

 $con = mysql_connect("localhost", "root", "apmsetup");
 mysql_select_db("shopmall", $con);
	
 mysql_query("delete from shoppingbag where id='$UserID'", $con);
 mysql_close($con);
	
 SetCookie("UserID", "", time());
 SetCookie("UserName", "", time());

 SetCookie("Session", "", time());
	 
echo ("<meta http-equiv='Refresh' content='0; url=main.html'>");

?>
