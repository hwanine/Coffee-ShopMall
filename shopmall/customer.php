<!--공지사항 페이지-->

<style>
	#t2 {border-left:none; border-right:none; border-style:thin;}
	a {text-decoration:none}
	

</style>
<?
	include ("top.html");
?>
<table height=100><tr><td></td></tr></table>
<?
 
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from customer order by id desc", $con);
$total = mysql_num_rows($result);

echo("
	<table border=0 width=1000 align=center >
		<tr>
			<td align=center><img src=./photo/list1.png width=1000></td>
		</tr>
		<tr> ");
//			<td align=center>
//				<form method=post action=p-search.php?board=$board>
//				<select name=field>
//					<option value=writer>글쓴이</option>
//					<option value=topic>제목</option>
//					<option value=content>내용</option>
//				</select>
//				검색어<input type=text name=key size=13>
//				<input type=submit value=찾기>
//			</td>
//				</form>
echo("
			<td><font size=2><b>자료수 $total 개</b></font></td>
		</tr>
	</table>
	<table border=1 width=1000 align=center cellspacing=0 id=t1>
		<tr id=t1 bgcolor=#4ABFD3>
			<td id=t1 align=center width=100><b>번호</b></td>
			<td id=t1 align=center width=600><b>제목</b></td>
			<td id=t1 align=center width=100><b>글쓴이</b></td>
			<td id=t1 align=center width=150><b>날짜</b></td>
			<td id=t1 align=center width=50><b>조회</b></td>
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

		$id=mysql_result($result,$newcounter,"id");
		$content=mysql_result($result,$newcounter,"content");
		$topic=mysql_result($result,$newcounter,"topic");
		$hit=mysql_result($result,$newcounter,"hit");
		$wdate=mysql_result($result,$newcounter,"wdate");

		echo("
			<tr id=t1>
				<td id=t1 align=center>$id</td>
				<td id=t1 align=left><a href=p-content.php?id=$id><font color=black><b>$topic</font></a></td>
				<td id=t1 align=center>관리자</td>
				<td id=t1 align=center>$wdate</td>
				<td id=t1 align=center>$hit</td>
			</tr>
		");

		$counter = $counter + 1;

	endwhile;

	echo("
		</table>
		<table border=0 width=1000 align=center><tr><td>");
		   
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
		echo ("[<a href=customer.php?board=$board&cblock=$pblock&cpage=$pstartpage>이전블록</a>] ");

	// 현재 블록에 속한 페이지 번호를 출력	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
	   echo ("[<a href=customer.php&cblock=$cblock&cpage=$i>$i</a>]");
	   $i = $i + 1;
	endwhile;
	 
	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
	if ($nstartpage <= $totalpage)   
		echo ("[<a href=customer.php?board=$board&cblock=$nblock&cpage=$nstartpage>다음블록</a>] ");

	echo ("</td>
				<td align=right colspan=5><a href=p-input.php><img src=./photo/write.png width=50></a></td>
			</tr></table>");
}
	
mysql_close($con);

?>
<table height=100><tr><td></td></tr></table>
<?
	include ("bottom.html");
?>
