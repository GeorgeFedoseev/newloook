<?
    session_start();
	header('Content-Type: text/html; charset=UTF-8');
?>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Админка NewLook</title>
		<link rel="stylesheet" type="text/css" href="../css/reg.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/adm.css">
		<link rel="stylesheet" type="text/css" href="../css/style_project.css">

</head>
<body>

<?php
	if($_SESSION['role']=='10')   {
		include("../menu.html");
		include("menu_adm.php");
		
		include("../bd.php");
		$request= "SELECT * FROM studio ORDER BY id_pr";
		$result=mysql_query($request);
			?>
		<form action="studio_form.php" method=POST>
		Новая студия: 
		<br>
		Название:
		<input type=text name=name_stud>
		<br>
		Район:
		<br>
		<input type=text name=id_district>
		<br>
		Цена в час от: 
		<input type=text id=ot value=350 name=price_from>
		<br>
		Цена в час до: 
		<input type=text name=price_to>
		<br>
		<br>
		Оборудование:
		<br>
		<input type=checkbox name=window value=1>Естественный свет (окна) <br>
		<input type=checkbox  name=prof_light value=1>Студийный свет <br>
		<input type=checkbox  name=fan  value=1>Вентилятор<br>
		<input type=checkbox  name=smoke  value=1>Дым-машина<br>
		Оснащение:<br>
		<input type=checkbox  name=bed  value=1>Кровать<br>
		<input type=checkbox  name=bath  value=1>Ванна<br>
		<input type=checkbox  name=aqua  value=1>Аквазона<br>
		<input type=checkbox  name=decor  value=1>Декорации<br>
		<input type=checkbox  name=sofa  value=1>Диван<br>
		<input type=checkbox  name=fireplace  value=1>Камин<br>
		<input type=checkbox  name=chair  value=1>Кресло<br>
		<input type=checkbox  name=piano  value=1>Пианино/рояль<br>
		<input type=checkbox  name=swing  value=1>Качели<br>
		<input type=checkbox  name=hayloft  value=1>Сеновал<br>
		<input type=checkbox  name=wooden_wall  value=1>Деревянная стена<br>
		<input type=checkbox  name=brick_wall  value=1>Кирпичная стена<br>
		<input type=checkbox  name=textured_wall  value=1>Фактурные стены<br>
		<input type=checkbox  name=paper_backg value=1>Бумажные фоны<br>
		<input type=checkbox  name=fabric_backg  value=1>Фоны из ткани<br>
		Дополнительные услуги: <br>
		<input type=checkbox name=rent_costum value=1>Аренда костюмов<br>
		<input type=checkbox name=wifi value=1>WiFi<br>
		<input type=checkbox name=parking value=1>Парковка рядом со студией<br>
		Интерьеры:<br>
		<input type=checkbox name=new_y_int value=1>Новогодний интерьер<br>
		<input type=checkbox name=chikd_int value=1>Детские<br>
		<input type=checkbox name=romant_int value=1>Романтичные<br>
		<input type=checkbox name=room_int value=1>Имитация квартиры<br>
		<input type=checkbox name=bedroom_int value=1>Спальня<br>
		<input type=checkbox name=kitc_int value=1>Имитация кухни<br>
		<input type=checkbox name=street_int value=1>Имитация улицы<br>
		<input type=checkbox name=gloomy_int value=1>Мрачные<br>
		<input type=checkbox name=classic_int value=1>Классические/дворцовые<br>
		<input type=checkbox name=design_int value=1>Дизайнерские<br>
		<input type=checkbox name=tech_int value=1>Хайтек<br>
		<input type=checkbox name=abstract_int value=1>Абстрактные<br>
		<input type=checkbox name=loft_int value=1>Лофт<br>
		<input type=checkbox name=retro_int value=1>Ретро<br>
		<input type=checkbox name=trash_int value=1>Треш<br>
		<input type=submit value="Добавить">
		</form>
	<? }	?>

</body>
</html>