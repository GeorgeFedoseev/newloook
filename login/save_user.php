<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Успешная регистрация на NewLook</title>
		<link rel="stylesheet" type="text/css" href="../css/reg.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	
</head>
<body>

<?php

    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }

    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
    if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {

        include("../menu.html");
        echo ("<p class='reg_success'> Вы ввели не всю информацию, вернитесь назад и заполните все поля.</p>");
        echo ("<br><p class='reg_success' style='margin-top: -30px;'><a href='login.php' class='href_reg'>Назад</a></p>");
	    exit();
	}

    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
 //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
 // подключаемся к базе
    require_once ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 // проверка на существование пользователя с таким же логином
    $result = mysql_query("SELECT id_user FROM users WHERE login='$login'",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id_user'])) {
	   include("../menu.html");
        exit ("<p class='reg_success'>Извините, введённый вами логин уже зарегистрирован. Введите другой логин или войдите.</p><br><form action='reg.php' class='error_reg'><input class='form_butt' type=submit value='Зарегестрироваться'></form><br><form action='login.php' class='error_reg'><input class='form_butt' type=submit value='Войти'></form>");
    }
 // если такого нет, то сохраняем данные
    $result2 = mysql_query ("INSERT INTO users (login,password_md5) VALUES('$login','".md5($password)."')");
    // Проверяем, есть ли ошибки
	include("../menu.html");
    if ($result2=='TRUE')
    {
        echo "<p class='reg_success'>Вы успешно зарегистрированы! Вы будете перенаправлены на главную страницу через несколько секунд <br> <a href='../index.php' class='href_reg'>Главная страница</a></p>";
	   echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 2000); </script>";
	}else {
	   include("../menu.html");
	   echo "<p class='reg_success'>Произошла ошибка! К сожалению, Вы не зарегистрированы. Попробуйте снова!</p><br><form action='reg.php' class='error_reg'><input class='form_butt' type=submit value='Зарегестрироваться'></form>";    
    }
?>
</body>
</html>