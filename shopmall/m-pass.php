<!--후기 수정(암호 입력) 페이지-->
<!--후기 작성할 때 수정할 수 있게 암호데이터를 넣어주었음-->
<?
echo ("
   <form method=post   action=m-pass2.php?id=$id&mode=$mode>
   <table border=0 width=400 align=center>
   <tr><td align=center>암호를 입력하세요</td></tr>
   <tr><td align=center>암호: <input type=password size=15 name='pass'>
   <input type=submit value=입력></td></tr>
   </form>
   </table>
");
?>
