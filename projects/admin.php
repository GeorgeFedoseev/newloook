<?
$itog_usr = '��� �����';
$itog_pass = '��� ������';
$_GET[$usr];
$_GET[$pass];
if (($usr != '') and ($pass != '')):
{
if (($usr != $itog_usr) or ($pass != $itog_pass)):
{
die("�������� ��� ������������ ��� ������");
}
else:
{
echo "����������� ������ ������";
?>
<html>
<head>
<title>���������� ��������</title>
</head>
<body>
<h3>���������� ��������</h3>
<form action="createnews.php" method="POST">
��������� �������: <input type="text" Size=70 name="title"><br>
���� ���: <input type="text" Size=50 name"user"><br>
����� <textarea name="newstext" cols=60 rows=6>
</textarea>
<br><br>
<CENTER>
<input type="Submit" Value="Ok">
<input type="reset" Value=" �������� ">
</CENTER>
</form>
</body>
</html>
<?
}
endif;
}
else:
{
echo "<form method='post'>
Login:<br>
<input type='text' name='usr' value=''><br>
Password:<br>
<input type='password' name='pass' value=''><br>
<input type='submit' value='LogIN'>
</form>";
}
endif;
?>