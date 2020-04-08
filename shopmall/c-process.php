<!--상품 등록할 수 있는 페이지(c-input.php이어서....)-->

<?

if (!$code){
	echo("
		<script>
		window.alert('상품코드명이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

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

if (!$userfile){
	echo("
		<script>
        window.alert('상품 사진을 선택해 주세요')
        history.go(-1)
        </script>
    ");
    exit;
} else {
    $savedir = "./photo1";
    $temp = $userfile_name;
    if (file_exists("$savedir/$temp")) {
         echo (" 
             <script>
             window.alert('동일한 화일 이름이 이미 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile, "$savedir/$temp");
         unlink($userfile);
    }
	$temp1 = $contentfile_name;
	if (file_exists("$savedir/$temp1")) {
         echo (" 
             <script>
             window.alert('동일한 상품설명이 이미 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($contentfile, "$savedir/$temp1");
         unlink($contentfile);
    }
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

//c-input에서 받은 변수들을 이용해 상품 정보 테이블(product)에 정보를 넣어줌
$result = mysql_query("insert into product(class, code, name, content, contentfile, price, userfile, hit) values ($class, '$code', '$name', '$content', '$contentfile_name', '$price', '$userfile_name', 0)", $con);

mysql_close($con);		

if (!$result) {
   echo("
      <script>
      window.alert('이미 사용중인 상품 코드입니다')
      history.go(-1)
      </script>
   ");
   exit;
} else {
   echo("
      <script>
      window.alert('상품 등록이 완료되었습니다')
      </script>
   ");
}
echo ("<meta http-equiv='Refresh' content='0; url=c-adminlist.php'>");

?>
