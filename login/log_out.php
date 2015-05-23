<?
    session_start();
	header('Content-Type: text/html; charset=UTF-8');
?>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Вход на NewLook</title>
		<link rel="stylesheet" type="text/css" href="../css/reg.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<?
	include("../menu.html");
	if(isset($_SESSION['login']))    {
				 unset($_SESSION['userid']);
				 session_destroy();
					 
    echo ("<p class='reg_success'>Вы вышли из системы</p>");
	echo ("<br><p class='reg_success' style='margin-top: -30px;'><form action='../index.php' class='error_reg'><input class='form_butt' type=submit value='На главную'></form></p>");
	echo ("<br><p class='reg_success' style='margin-top: -40px;'><form action='login.php' class='error_reg'><input class='form_butt' type=submit value='Войти заново'></form></p>");
	echo ("<br><p class='reg_success' style='margin-top: -40px;'><form action='reg.php' class='error_reg'><input class='form_butt' type=submit value='Зарегистрироваться'></form></p>");
			}
			else { 
				echo ("<p class='reg_success'>Вы уже вышли из системы</p");	
				echo ("<br><p class='reg_success' style='margin-top: -30px;'><form action='../index.php' class='error_reg'><input class='form_butt' type=submit value='На главную'></form></p>");
				echo ("<br><p class='reg_success' style='margin-top: -40px;'><form action='login.php' class='error_reg'><input class='form_butt' type=submit value='Войти в систему'></form></p>");
				echo ("<br><p class='reg_success' style='margin-top: -40px;'><form action='reg.php' class='error_reg'><input class='form_butt' type=submit value='Зарегистрироваться'></form></p>");
	
			}
?>


</body>
</html>