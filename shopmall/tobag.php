<!--쇼핑백에 상품을 추가하는 페이지-->

<?

if (!$UserID) {
	echo ("<script>
		window.alert('로그인 사용자만 구매 가능합니다')
		</script>"
		);
	echo ("<meta http-equiv='Refresh' content='0; url=login.php'>"); 
      exit;
} 

if (!isset($quantity)) $quantity = 1; //동일한 물건이 담겼는지 확인하는 코드

$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 이미 쇼핑백에 담은 물건이면 수량만 보탬 
$result = mysql_query("select * from shoppingbag where session='$Session' and pcode='$code'", $con);
$total = mysql_num_rows($result);

if ($total) $oldnum = mysql_result($result, 0, "quantity");

if ($oldnum) {
     $quantity = $oldnum + $quantity;
	 
	 //추가하려는 상품이 있을 경우 기존의 상품에서 수량만 더해서 업데이트함
     mysql_query("update shoppingbag set quantity=$quantity where   session='$Session' and pcode='$code'", $con);
} else {
	
	//추가하려는 상품이 없을 경우 새로운 데이터를 쇼핑백에 추가함
     mysql_query("insert into shoppingbag(id, session, pcode, quantity) values ('$UserID','$Session', '$code', $quantity)", $con);
}

mysql_close($con);	//데이터베이스 연결해제

echo ("<meta http-equiv='Refresh' content='0; url=showbag.php'>");

?>
