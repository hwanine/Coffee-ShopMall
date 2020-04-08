<!--상품 후기 수정 페이지-->

<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result=mysql_query("select * from comment where id=$id",$con);

// 수정하고자 하는 원본 게시물에서 수정 가능한 항목을 추출함
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");


echo("<center><h1>게시판</h1></center>
	<form method=post action=m-mprocess.php?id=$id>
	<table width=700 border=0>
		<tr>
			<td width=100 align=right>이름 </td>
			<td width=600><input type=text name=writer size=20 value='$writer'></td>
		</tr>
		<tr>
			<td align=right>제목 </td>
			<td><input type=text name=topic size=60 value='$topic'></td>
		</tr>
		<tr>
			<td align=right>내용 </td>
			<td>
					<head>
						<meta charset='ANSI'>
						<title>A Simple Page with CKEditor</title>
						<!-- Make sure the path to CKEditor is correct. -->
						<script src='//cdn.ckeditor.com/4.10.1/standard/ckeditor.js'></script>
					</head>
				<body>
					<form>
						<textarea name=content id='editor1' rows='10' cols='80'>$content
						</textarea> 
						<script>
							// Replace the <textarea id='editor1'> with a CKEditor
							// instance, using default configuration.
							CKEDITOR.replace( 'editor1' );
						</script>
					
					</form>
				</body>
			
			</td>
		</tr>
		<tr>
			<td align=right>암호 </td>
			<td><input type=password name=passwd size=15></td>
		</tr>
		<tr>
			<td align=center colspan=2>
				<input type=submit value=수정완료>
				<input type=reset value=지우기></td>
		</tr>
	</table>
	</form>");

mysql_close($con);

?>
