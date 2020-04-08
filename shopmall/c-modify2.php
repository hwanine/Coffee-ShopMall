<!--상품 정보를 수정하는 테이블(c-modify에 이어서..)-->
<?

if (!$name){
	echo("
		<script>
		window.alert('상품명이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$price){
	echo("
		<script>
		window.alert('가격이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	
// 기존 상품 이미지를 그대로 사용하는 경우
if (!$userfile & !$contentfile){
	$result = mysql_query("update product set class=$class, name='$name', content='$content', price=$price where code='$code'", $con);

}
if($userfile & !$contentfile) {

     // 기존 상품 이미지 파일을 삭제
	$tmp = mysql_query("select userfile from product where code='$code'", $con);
	$fname = mysql_result($tmp, 0, "userfile");
    $savedir = "./photo";
	unlink("$savedir/$fname");
	
    // 새로이 첨부한 이미지 파일을 저장	
    $temp = $userfile_name;
    if (file_exists("$savedir/$temp")) {
         echo (" 
             <script>
             window.alert('동일한 화일 이름이 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile, "$savedir/$temp");
         unlink($userfile);
    }
	$result = mysql_query("update product set class=$class, name='$name', content='$content', price=$price, userfile='$userfile_name' where code='$code'", $con);
}
if(!$userfile & $contentfile) {
	     // 기존 상품 이미지 파일을 삭제
	$tmp = mysql_query("select contentfile from product where code='$code'", $con);
	$fname = mysql_result($tmp, 0, "contentfile");
    $savedir = "./photo";
	unlink("$savedir/$fname");
	
    // 새로이 첨부한 이미지 파일을 저장	
    $temp = $contentfile_name;
    if (file_exists("$savedir/$temp")) {
         echo (" 
             <script>
             window.alert('동일한 화일 이름이 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($contentfile, "$savedir/$temp");
         unlink($contentfile);
    }
	$result = mysql_query("update product set class=$class, name='$name', content='$content', price=$price, contentfile='$contentfile_name' where code='$code'", $con);
}
if($userfile & $contentfile){
		     // 기존 상품 이미지 파일을 삭제
	$tmp = mysql_query("select * from product where code='$code'", $con);
	$fname = mysql_result($tmp, 0, "contentfile");
	$fname1 = mysql_result($tmp, 0, "userfile");
	
    $savedir = "./photo1";
	unlink("$savedir/$fname");
	unlink("$savedir/$fname1");
    // 새로이 첨부한 이미지 파일을 저장	
    $temp = $contentfile_name;
	$temp1 = $userfile_name;
    copy($contentfile, "$savedir/$temp");
	copy($userfile, "$savedir/$temp1");
    unlink($contentfile);
	unlink($userfile);
    
	$result = mysql_query("update product set class=$class, name='$name', content='$content', price=$price, userfile='$userfile_name', contentfile='$contentfile_name' where code='$code'", $con);
}
	
if (!$result) {
	echo("
      <script>
      window.alert('상품 수정에 실패했습니다')
      </script>
    ");
    exit;
} else {
	echo("
      <script>
      window.alert('상품 수정이 완료되었습니다')
      </script>
   ");
} 

mysql_close($con);		//데이터베이스 연결해제

echo ("<meta http-equiv='Refresh' content='0; url=c-adminlist.php'>");

?>

