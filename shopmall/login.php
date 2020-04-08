<!--로그인 페이지-->

<? include("top.html"); ?>
<table height=100><tr><td></td></tr></table>
	<table align=center width=700 height=50>
		<tr height=40>
			<td width=200 align=right><font size=4><b>회원로그인<b></font></td>
			<td width=30></td>
			<td><font size=2>회원으로 로그인 하시면 편리한 쇼핑이 가능합니다.</font></td>
		</tr>
		<tr height=2>
			<td colspan=3 align=center><hr size=3 color=black width=480></td>
		</tr>
	</table>
	<form method=post action=login1.php onsubmit="if(!this.uid.value || !this.upass.value) return   false;">
	<table align=center width=500 >
		<tr>
			<td rowspan=3 width=100 align=right><img src=./photo/login1.png width=100 height=100></td>
			<td width=100 align=center>
				<font size=2>아이디</font>
			</td>
			<td width=170>
				<input type=text name=uid style='width:150; height:25; border:1px solid #B0B0B0;   font-size:8pt;'><br>
			</td>
			<td rowspan=2><input type=image src="./photo/login2.png" width=50 height=50></td>
		</tr>
		<tr>
			<td align=center width=100>
				<font size=2>비밀번호</font>
			</td>
			<td width=170>
				<input type=password name=upass style='width:150; height:25; border:1px solid #B0B0B0;   font-size:8pt;'>
			</td>
		</tr>
		<tr height=80>
			<td colspan=3 align=center>
				<a href='join.html'><img src=./photo/login3.png width=100 height=30></a>  
				<a href='findidpw.php'><img src=./photo/login4.png width=100 height=30></a>
			</td>
		</tr>
	</table>
	</form>
	<table height=100><tr><td></td></tr></table>
<? include ("bottom.html");?>

