<!--사용 후기를 보여주는 페이지-->

<? include("top.html");?>
<table height=100><tr><td></td></tr></table>
<?
$pid = $id;
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

//상품 후기 테이블(comment)에서 정보를 읽음
$result=mysql_query("select * from comment where id=$id",$con);

// 각 필드에 해당하는 데이터를 뽑아 내는 과정
$id=mysql_result($result,0,"id");
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$hit=mysql_result($result,0,"hit");

$hit = $hit +1;   //조회수를 하나 증가
mysql_query("update comment set hit=$hit where id=$id",$con);

$wdate=mysql_result($result,0,"wdate");
$content=mysql_result($result,0,"content");

// 테이블로부터 읽은 내용을 화면에 디스플레이
echo("
	<table border=0 width=1000 align=center>
	<tr><td><img src=./photo/review.png width=1000></td></tr>
	</table>

	<table border=1 width=1000 align=center cellpading=0 cellspacing=0>
		<tr>
			<td width=100 bgcolor=#F6F6F6 align=center>제목</td>
			<td colspan=5>$topic</td>
		</tr>
		<tr>
			<td width=150 align=center bgcolor=#F6F6F6>글쓴이</td>
			<td width=150 align=center>$writer</td>
			<td width=200 align=center bgcolor=#F6F6F6>등록일</td>
			<td width=200 align=center>$wdate</td>
			<td width=150 align=center bgcolor=#F6F6F6>조회</td>
			<td width=150 align=center>$hit</td>
		</tr>	
		<tr>
			<td colspan=6><pre>$content</pre></td>
			</tr>
	</table>

	<table border=0 width=1000 align=center>
		<tr>
			<td align=right>
				<a href=m-pass.php?id=$id&mode=0><img src=./photo/write2.png width=50 height=25></a>
				<a href=m-pass.php?id=$id&mode=1><img src=./photo/delete1.png width=50 height=25></a>
				
			</td>
		</tr>
	</table>
");

?>


<?
 
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

//상품 후기(comment) 테이블에서 작성 번호(id)를 오름차순으로 가져옴
$result = mysql_query("select * from comment order by id desc", $con);
$total = mysql_num_rows($result);

echo("
	<table border=0 width=1000 align=center >
	
		<tr>
			<td><font size=2><b>자료수</b></font><font color=red size=2> $total</font><font size=2><b> 개</b></font></td>
		</tr>
	</table>
	<table width=1000 align=center>
		<tr bgcolor=#CFCFCF>
			<td align=center width=50><b>번호</b></td>
			<td align=center width=500><b>제목</b></td>
			<td align=center width=100><b>글쓴이</b></td>
			<td align=center width=150><b>날짜</b></td>
			<td align=center width=50><b>조회</b></td>
		</tr>
");

if (!$total){
	echo("
		<tr><td colspan=5 align=center>아직 등록된 글이 없습니다.</td></tr>
	");
} else {

	if   ($cpage=='') $cpage=1;    // $cpage -  현재 페이지 번호
	$pagesize = 10;                // $pagesize - 한 페이지에 출력할 목록 개수

	$totalpage = (int)($total/$pagesize);
	if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

	$counter=0;

	while($counter<$pagesize):
		$newcounter=($cpage-1)*$pagesize+$counter;
		if ($newcounter == $total) break;
		
		$id = mysql_result($result,$counter,"id"); //작성 번호
		$code = mysql_result($result,$counter,"code"); 
		$topic =  mysql_result($result,$counter,"topic"); //제목
		$content = mysql_result($result,$counter,"content"); //내용
		$wdate = mysql_result($result,$counter,"wdate"); //날짜
		$writer = mysql_result($result,$counter,"writer"); //글쓴이
		$hit = mysql_result($result,$counter,"hit"); //조회수
		if($id==$pid){
		echo("
		<tr height=45 bgcolor=#F6F6F6>
			<td width=200 align=center>$id</td>
			<td width=600><a href=m-content.php?id=$id>
				<table>
					<tr>
						<td rowspan=2 width=30><img src='./photo3/$code' width=45 height=45></td>
						<td><b>$topic</b></td>
					<tr>
						<td>$content</td>
					</tr>
				</table></a>
			</td>
			<td width=50 align=center>$writer</td>
			<td width=50 align=center>$wdate</td>
			<td width=50 align=center>$hit</td>
		</tr>
		<tr height=5>
			<td colspan=5><hr size=1 color=#A6A6A6 width=100%></td>
			
		</tr>
		");
		}else{
		echo("
		<tr height=45>
			<td width=200 align=center>$id</td>
			<td width=600><a href=m-content.php?id=$id>
				<table>
					<tr>
						<td rowspan=2 width=30><img src='./photo3/$code' width=45 height=45></td>
						<td><b>$topic</b></td>
					<tr>
						<td>$content</td>
					</tr>
				</table></a>
			</td>
			<td width=50 align=center>$writer</td>
			<td width=50 align=center>$wdate</td>
			<td width=50 align=center>$hit</td>
		</tr>
		<tr height=5>
			<td colspan=5><hr size=1 color=#A6A6A6 width=100%></td>
			
		</tr>
		");
		}
		$counter = $counter + 1;

	endwhile;

	echo("</table>");

	echo ("<table border=0 width=1000 align=center>
		  <tr><td>");
		   
	// 화면 하단에 페이지 번호 출력
	if ($cblock=='') $cblock=1;   // $cblock - 현재 페이지 블록값
	$blocksize = 5;             // $blocksize - 화면상에 출력할 페이지 번호 개수

	$pblock = $cblock - 1;      // 이전 블록은 현재 블록 - 1
	$nblock = $cblock + 1;     // 다음 블록은 현재 블록 + 1
		
	// 현재 블록의 첫 페이지 번호
	$startpage = ($cblock - 1) * $blocksize + 1;	

	$pstartpage = $startpage - 1;  // 이전 블록의 마지막 페이지 번호
	$nstartpage = $startpage + $blocksize;  // 다음 블록의 첫 페이지 번호

	if ($pblock > 0)        // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
		echo ("[<a href=m-content.php?cblock=$pblock&cpage=$pstartpage&id=$pid>이전블록</a>] ");

	// 현재 블록에 속한 페이지 번호를 출력	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
	   echo ("[<a href=m-content.php?cblock=$cblock&cpage=$i&id=$pid>$i</a>]");
	   $i = $i + 1;
	endwhile;
	 
	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
	if ($nstartpage <= $totalpage)   
		echo ("[<a href=m-content.php?cblock=$nblock&cpage=$nstartpage&id=$pid>다음블록</a>] ");

	echo ("</td>
			<td align=right><a href=m-input.php><img src=./photo/write.png width=50></a></td>
		</tr></table>");
}
	
mysql_close($con);
?>



<table height=100><tr><td></td></tr></table>
<? include("bottom.html");?>

