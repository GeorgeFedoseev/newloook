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
		if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
			if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
			//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
		if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
			{
			include("../menu.html");
			echo ("<p class='reg_success'> Вы ввели не всю информацию, вернитесь назад и заполните все поля!</p>");
			echo ("<br><p class='reg_success' style='margin-top: -30px;'><a href='login.php' class='href_reg'>Назад</a></p>");
			exit();
			}
			//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
			$login = stripslashes($login);
			$login = htmlspecialchars($login);
		$password = stripslashes($password);
			$password = htmlspecialchars($password);
		//удаляем лишние пробелы
			$login = trim($login);
			$password = trim($password);
		// подключаемся к базе
			include ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
		 
		$result = mysql_query("SELECT * FROM users WHERE login='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
			$myrow = mysql_fetch_array($result);
			if (empty($myrow['password_md5']))
			{
			//если пользователя с введенным логином не существует
				 include("../menu.html");
			echo ("<p class='reg_success'>Извините,  такого логина не существует</p>");
			echo ("<br><p class='reg_success' style='margin-top: -30px;'><a href='login.php' class='href_reg'>Назад</a></p>");
			exit();
			}
			else {
			//если существует, то сверяем пароли
			if ($myrow['password_md5']==md5($password)) {
			//если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
			$_SESSION['login']=$myrow['login']; 
			$_SESSION['id_user']=$myrow['id_user'];
			$_SESSION['role']=$myrow['role'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
			include("../menu.html");
			
                if(!isset($_SESSION["after_login"])){
                    echo "<p class='reg_success'>Вы успешно вошли на сайт! Вы будете перенаправлены на главную страницу через несколько секунд <br> <a href='../index.php' class='href_reg'>Главная страница</a></p>";
                    echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 2000); </script>";        
                }else{
                    echo "<p class='reg_success'>Вы успешно вошли на сайт! Вы будете перенаправлены на запрошенную страницу через несколько секунд <br> <a href='../index.php' class='href_reg'>Главная страница</a></p>";
                    echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='".$_SESSION["after_login"]."'\", 2000); </script>";        
                    unset($_SESSION["after_login"]);
                }
			
			}
		 else {
			//если пароли не сошлись
			 include("../menu.html");
			echo ("<p class='reg_success'>Извините, введённый вами логин или пароль неверный.</p>");
			echo ("<br><p class='reg_success' style='margin-top: -30px;'><a href='login.php' class='href_reg'>Назад</a></p>");
			exit();
			}
			}
    ?>
	</body>
</html>