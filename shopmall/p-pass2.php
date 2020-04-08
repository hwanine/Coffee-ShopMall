<?
switch ($mode) {
    case 0:          // 수정 프로그램 호출
        echo("<meta   http-equiv='Refresh' content='0; url=p-modify.php?id=$id'>");
			break;
    case 1:          // 삭제 프로그램 호출
        echo("<meta   http-equiv='Refresh' content='0; url=p-delete.php?id=$id'>");
            break;
}   	   
  
mysql_close($con);

?>
