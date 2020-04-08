<!--상품 후기 페이지-->
<!--m.pass.php에서 받은 암호가 맞으면 수정 및 삭제할 수 있으며 암호가 틀렸을 시 기존의 페이지로 되돌아감-->
<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select passwd from comment where id=$id",$con);
$passwd=mysql_result($result,0,"passwd");

if ($pass != $passwd) {            // 암호가 일치하지 않는 경우
	echo   ("<script>
		window.alert('입력 암호가 일치하지 않네요');
		history.go(-1);
		</script>");
	exit;		
} else {                  // 암호가 일치하는 경우
    switch ($mode) {
        case 0:          // 수정 프로그램 호출
            echo("<meta   http-equiv='Refresh' content='0; url=m-modify.php?id=$id'>");
            break;
        case 1:          // 삭제 프로그램 호출
            echo("<meta   http-equiv='Refresh' content='0; url=m-delete.php?id=$id'>");
            break;
    }   	   
}  

mysql_close($con);

?>
