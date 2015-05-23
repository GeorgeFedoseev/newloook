<html>
<head>
	<title>Регистрация на сайте NewLook</title>
	<link rel="stylesheet" type="text/css" href="../css/style_project.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/reg.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body>
	<?
	include("../menu.html");
	?>
<div class="come_in" align=center>
	<h1 class="form_reg_h1"> Регистрация</h1>
		<form action="save_user.php" method="post" class="form_reg" >
			<div class="form_div">
				<p class="form_p">
					<label>Логин:<br></label>
					<input name="login" class="form_text" type="text" size="15" maxlength="15">
				</p>
				<p class="form_p">
					<label>Пароль:<br></label>
					<input name="password" class="form_text" type="password" size="15" maxlength="15">
				</p>
				<p class="form_p">
					<input type="submit" name="submit" class="form_butt" value="Зарегистрироваться">
				</p>
			</div>
	</form>
		<p class="form_reg_p"> Если Вы уже регистрировались</p>
		<br>
		<form action="login.php">
		<input type="submit" name="submit" class="form_butt form_butt_2" value="Войдите в систему">
		</form>
</div>
</body>
</html>