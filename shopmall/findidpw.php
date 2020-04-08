<? include("top.html"); ?>
<table height=100><tr><td></td></tr></table>
<center><font size=3><b>사용자 ID 찾기</b></center>
<table align=center border=0 width=400>
<!--아이디 찾기, text에 적은 정보를 findid.php로 보냄-->
<form method=post action=findid.php onsubmit="if(!this.uname.value ||   !this.email.value) return false;">
	<tr>
		<td align=right><font size=2>이름(실명)</td>
		<td align=left><input type=text   size=20 name=uname></td><!--uname 변수를 보냄-->
	</tr>
	<tr>
		<td align=right><font size=2>이메일주소</td>
		<td align=left><input type=text   size=40 name=email></td><!--email 변수를 보냄-->
	</tr>
	<tr>
		<td align=center colspan=2><input type=submit value='아이디 확인'>
	</tr>
</form>
</table>
<br><br>
<!--비밀번호 찾기, text에 적은 정보를 findpw.php로 보냄-->
<center><font size=3><b>사용자 비밀번호 찾기</b></center>
<table align=center border=0 width=400>
<form method=post action=findpw.php onsubmit="if(!this.uid.value ||   !this.uname.value || !this.email.value) return false;">
	<tr>
		<td align=right><font size=2>사용자ID</td>
		<td align=left><input type=text size=20 name=uid></td> <!--uid 변수를 보냄-->
	</tr>
	<tr>
		<td align=right><font size=2>이름(실명)</td>
		<td align=left><input type=text size=20 name=uname></td><!--uname 변수를 보냄-->
	</tr>
	<tr>
		<td   align=right><font style='font-size:10pt; font-family:Tahoma;'>이메일주소</td>
		<td align=left><input type=text size=40 name=email></td>
	</tr>
	<tr>
		<td align=center colspan=2><input type=submit value='비밀번호 확인'>
	</tr>
</form>
</table>
	<table height=100><tr><td></td></tr></table>
<? include ("bottom.html");?>
