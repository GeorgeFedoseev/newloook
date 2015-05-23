<?
    session_start();
	header('Content-Type: text/html; charset=UTF-8');
?>
<html>
<head>
	<title>Агенство имиджевой фтографии NewLook</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<?
	include("menu.html");
	?>
	<div id=slider>
		<img src="photo/slider.jpg" class=slider>
		<h1 class=slider_h1>Фотопроект</h1>
		<img class=slider_sea src="photo/sea.png">
		
		<p class=slider_text_photosession>Закажите <b> сейчас </b> и получите фотосессию <br> всего за <strike>7000р</strike> 4000р!</p>
		
		<form class="form1 slider_input_name" name="testForm" method="post">
			<button class="button orange" name="sended" value="УЗНАТЬ БОЛЬШЕ" alt="Узнать больше"  formaction="projects/project.php?id=2">УЗНАТЬ БОЛЬШЕ</button> 
			<button class="button orange" name="sended" value="ЗАКАЗАТЬ" alt="Заказать">ЗАКАЗАТЬ</button>
		</form>
		
	</div>
	<div class=block_deals>
		<h1 class=block_h1>Наши предложения</h1>
		<table align=center cellpadding=10 border=0><tr>
			<td align=center>
				<img class="block_deals_img bdi1" src="photo/deals1.jpg">
				<h2 class=table_deals_h2>Фотопроекты</h2>
				<p class=table_deals_p>"Все включено"<br>по привлекательной цене</p>
			</td>
			<td align=center>
				<img class="block_deals_img bdi2" src="photo/deals2.jpg">
				<h2 class=table_deals_h2>Фотосессии</h2>
				<p class=table_deals_p>В каком образе<br>вы еще не побывали?</p>
			</td>
			<td align=center>
				<img class="block_deals_img bdi3" src="photo/deals3.jpg">
				<h2 class=table_deals_h2>Сертификаты</h2>
				<p class=table_deals_p>Порадуйте близких<br>эксклюзивным подарком</p>
			</td>
		</tr></table>
	</div>
	<div class=blocl_benefits>
		<h1 class=block_h1>Наши преимущества</h1>
		<table align=center cellpadding=10 border=0 width=999px>
			<tr>
				<td align=center width=333px>
					<img class="block_benef_img bdi1" src="photo/location.png">
					<h2 class=table_benef_h2>Более 500 съемок</h2>
					<p class=table_benef_p>Уже более 4х лет мы занимаемся своим делом,<br>за нашими плечами уже более 500 съемок!<br>Мы - профессионалы!</p>
				</td>
				<td align=center width=333px>
					<img class="block_benef_img bdi2" src="photo/choise.png">
					<h2 class=table_benef_h2>Выберите фотосессию по вкусу</h2>
					<p class=table_benef_p>Выберите любой стиль, который захотите,<br>услуги визажиста, флориста, стилиста,<br>любую локацию на Ваш вкус!</p>
				</td>
				<td align=center width=333px>
					<img class="block_benef_img bdi3" src="photo/help.png">
					<h2 class=table_benef_h2>Помощь на съемке</h2>
					<p class=table_benef_p>Не важно модель Вы или нет!<br>Мы поможем Вам расслабиться и получить<br>прекрасные фотографии в итоге!</p>
				</td>
			</tr>
			<tr>
				<td align=center width=333px>
					<img class="block_benef_img_2 bdi1" src="photo/help.png">
					<h2 class=table_benef_h2>Любые локации</h2>
					<p class=table_benef_p>Выберите локацию по различным параметрам<br>из нашей базы или предложите свою!<br>Студии, парки, улицы, музеи.. Все что захотите!</p>
				</td>
				<td align=center width=333px>
					<img class="block_benef_img_2 bdi2" src="photo/location.png">
					<h2 class=table_benef_h2>Помощь в выборе образа</h2>
					<p class=table_benef_p>Не можете определиться что взять с собой на<br>фотосессию? Мы с удовольствием поможем<br>Вам выбрать подходящий стиль!</p>
				</td>
				<td align=center width=333px>
					<img class="block_benef_img_2 bdi3" src="photo/choise.png">
					<h2 class=table_benef_h2>Обработка фотографий за 2 недели!</h2>
					<p class=table_benef_p>Фотосессия будет у Вас в течении 2 недель!<br>Отдадим ее Вам любым удобным способом!<br>30-40 фотографий с цветокоррекцикй и 10 с ретушью!</p>
				</td>
			</tr>
		</table>
	</div>
</html>