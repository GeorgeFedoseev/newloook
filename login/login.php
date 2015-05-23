<?
    session_start();
	header('Content-Type: text/html; charset=UTF-8');
?>
<html>
<head>
	<title>Вход на сайт NewLook</title>
	<link rel="stylesheet" type="text/css" href="../css/style_project.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/reg.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body>
	<?
	include("../menu.html");
	if(isset($_SESSION['login']))   { 
				echo ("<p class='reg_success'>Вы уже вошли в систему!</p");	
				echo ("<br><p class='reg_success' style='margin-top: -20px;'><form action='../index.php' class='error_reg'><input class='form_butt' type=submit value='На главную'></form></p>");
				echo ("<br><p class='reg_success' style='margin-top: -40px;'><form action='log_out.php' class='error_reg'><input class='form_butt' type=submit value='Выйти из системы'></form></p>");
			} 
		else {
	echo('
		<div class="come_in">
				<h1 class="form_come_h1">Вход</h1>
				<form action="testreg.php" method="post" class="form_reg">
					<div class="form_div">
						<p class="form_p">
							<label>Логин:<br></label>
							<input name="login" type="text" size="15" maxlength="15"  class="form_text" >
						</p>
						<p class="form_p">
							<label>Пароль:<br></label>
							<input name="password" type="password" size="15" maxlength="15"  class="form_text" >
						</p>
						<p class="form_p">
							<input class="form_butt" type="submit" name="submit" value="Войти">
							<br>
						</p>
					</div>
				</form>
				<p class="form_reg_p"> Если Вы еще не зарегистрированы</p>
				<br>
				<form action="reg.php">
				<input type="submit" name="submit" class="form_butt form_butt_2" value="зарегистрируйтесь">
				</form>
			
			</div>
		');
		}
	
	?>
	</body> 
</html>