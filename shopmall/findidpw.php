<? include("top.html"); ?>
<table height=100><tr><td></td></tr></table>
<center><font size=3><b>����� ID ã��</b></center>
<table align=center border=0 width=400>
<!--���̵� ã��, text�� ���� ������ findid.php�� ����-->
<form method=post action=findid.php onsubmit="if(!this.uname.value ||   !this.email.value) return false;">
	<tr>
		<td align=right><font size=2>�̸�(�Ǹ�)</td>
		<td align=left><input type=text   size=20 name=uname></td><!--uname ������ ����-->
	</tr>
	<tr>
		<td align=right><font size=2>�̸����ּ�</td>
		<td align=left><input type=text   size=40 name=email></td><!--email ������ ����-->
	</tr>
	<tr>
		<td align=center colspan=2><input type=submit value='���̵� Ȯ��'>
	</tr>
</form>
</table>
<br><br>
<!--��й�ȣ ã��, text�� ���� ������ findpw.php�� ����-->
<center><font size=3><b>����� ��й�ȣ ã��</b></center>
<table align=center border=0 width=400>
<form method=post action=findpw.php onsubmit="if(!this.uid.value ||   !this.uname.value || !this.email.value) return false;">
	<tr>
		<td align=right><font size=2>�����ID</td>
		<td align=left><input type=text size=20 name=uid></td> <!--uid ������ ����-->
	</tr>
	<tr>
		<td align=right><font size=2>�̸�(�Ǹ�)</td>
		<td align=left><input type=text size=20 name=uname></td><!--uname ������ ����-->
	</tr>
	<tr>
		<td   align=right><font style='font-size:10pt; font-family:Tahoma;'>�̸����ּ�</td>
		<td align=left><input type=text size=40 name=email></td>
	</tr>
	<tr>
		<td align=center colspan=2><input type=submit value='��й�ȣ Ȯ��'>
	</tr>
</form>
</table>
	<table height=100><tr><td></td></tr></table>
<? include ("bottom.html");?>