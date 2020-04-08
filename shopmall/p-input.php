<!--공지사항 글 작성 페이지(관리자만 접근 가능)-->

<?
	if($UserID != 'donguk'){
	echo("
		<script>
		window.alert('관리자만 작성할 수 있습니다.')
		history.go(-1)
		</script>
	");
	exit;
	}
?>
<?
	include ("top.html");
?>
<table height=100><tr><td></td></tr></table>
<?    

//공지사항 추가 
//form에 적힌 데이터들을 p-process.php로 보냄
echo("
	<table border=1 align=center width=750 cellspacing=0><tr><td>
	<center><h1>고객센터 글쓰기</h1></center>
	<form method=post action=p-process.php  enctype= 'multipart/form-data'>
	
	<table width=700 border=0 align=center>
		<tr>
			<td width=100 align=right>제목 </td>
			<td width=600><input type=text name=topic size=60></td>
		</tr>	
		<tr>
			<td align=right>파일</td>
			<td><input type=file name='filename' size=45 maxlength=80></td>
	
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
				<textarea name=content id='editor1' rows='10' cols='80'>
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
			<td align=center colspan=2>
				<input type=submit value=등록하기>
				<input type=reset value=지우기>
			</td>
		</tr>
	</table>
	</form>
	</td></tr></table>
");

?>
<table height=100><tr><td></td></tr></table>
<?
	include ("bottom.html");
?>
