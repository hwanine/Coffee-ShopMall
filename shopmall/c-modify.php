<!--상품을 수정하는 페이지(c-adminlist.php에서 수정을 눌렀을 ? 들어와짐)-->

<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

//c-adminlist.php에서 받은 코드 변수를 이용해 상품 정보 테이블(product)에서 코드에 맞는 정보를 가져옴
$result = mysql_query("select * from product where code='$code'", $con);

$class=mysql_result($result,0,"class");
$name=mysql_result($result,0,"name");
$price=mysql_result($result,0,"price");
$content=mysql_result($result,0,"content");
$userfile=mysql_result($result,0,"userfile");
$contentfile=mysql_result($result,0,"contentfile");


//form에 입력된 정보를 c-modify2로 보냄
echo ("
    <table align=center border=0 width=650>     
	<form method=post action=c-modify2.php?code=$code enctype='multipart/form-data'>
		<tr>
			<td width=100 align=center>상품코드</td>
			<td width=550><b>$code</b></td>
		</tr>
		<tr>
			<td align=center>상품분류</td>
			<td><select name=class>");

switch($class) {
    case 1:
		echo ("<option value=1 selected>프리미엄원두</option>
			<option value=2>핸드드립</option>
            <option value=3>콜드브루</option>
			<option value=4>차&디저트</option>
			<option value=5>관련용품</option>");
		break;
	case 2:
		echo ("<option value=1>프리미엄원두</option>
			<option value=2 selected>핸드드립</option>
            <option value=3>콜드브루</option>
			<option value=4>차&디저트</option>
			<option value=5>관련용품</option>");
		break;
	case 3:
		echo ("<option value=1>프리미엄원두</option>
			<option value=2>핸드드립</option>
            <option value=3 selected>콜드브루</option>
			<option value=4>차&디저트</option>
			<option value=5>관련용품</option>");
		break;
	case 4:
		echo ("<option value=1>프리미엄원두</option>
			<option value=2>핸드드립</option>
            <option value=3>콜드브루</option>
			<option value=4 selected>차&디저트</option>
			<option value=5>관련용품</option>");
		break;
	case 5:
		echo ("<option value=1>프리미엄원두</option>
			<option value=2>핸드드립</option>
            <option value=3>콜드브루</option>
			<option value=4>차&디저트</option>
			<option value=5 selected>관련용품</option>");
		break;
}

echo ("</select></td></tr>
	<tr><td align=center>상품이름</td><td><input type=text name=name size=70 value='$name'></td></tr>
	<tr><td align=center>상품설명</td>
		<td>
		<head>
			<meta charset='ANSI'>
			<title>A Simple Page with CKEditor</title>
			<!-- Make sure the path to CKEditor is correct. -->
			<script src='//cdn.ckeditor.com/4.10.1/standard/ckeditor.js'></script>
    </head>
    <body>
    
            <textarea name=content id='editor1' rows='10' cols='80'>$content
            </textarea> 
			<script>
                // Replace the <textarea id='editor1'> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
			</script>
            
    </body>
	
		</td></tr>
	<tr><td align=center>설명사진</td><td><input type=file size=30 name=contentfile><-- $contentfile</td></tr>
	<tr><td align=center>상품가격</td><td><input type=text name=price size=15 value=$price>원</td></tr>
	<tr><td align=center>상품사진</td><td><input type=file size=30 name=userfile><-- $userfile</td></tr>
	<tr><td align=center colspan=2><input type=submit value=수정완료></tr>
	</form>
	</table>");

mysql_close($con);

?>
