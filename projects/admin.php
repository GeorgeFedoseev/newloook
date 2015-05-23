<?
$itog_usr = 'ваш логин';
$itog_pass = 'ваш пароль';
$_GET[$usr];
$_GET[$pass];
if (($usr != '') and ($pass != '')):
{
if (($usr != $itog_usr) or ($pass != $itog_pass)):
{
die("Неверное имя пользователя или пароль");
}
else:
{
echo "Авторизация прошла удачно";
?>
<html>
<head>
<title>Добавление новостей</title>
</head>
<body>
<h3>Добавление новостей</h3>
<form action="createnews.php" method="POST">
Заголовок новости: <input type="text" Size=70 name="title"><br>
Ваше имя: <input type="text" Size=50 name"user"><br>
Текст <textarea name="newstext" cols=60 rows=6>
</textarea>
<br><br>
<CENTER>
<input type="Submit" Value="Ok">
<input type="reset" Value=" Очистить ">
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