<?
    session_start();
	header('Content-Type: text/html; charset=UTF-8');
?>
<html>
<head>
<title> 
		Фотопроект NewLook 
	</title>
	<link rel="stylesheet" type="text/css" href="../css/style_project.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/buy.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
</head>
<body>

	<? 
	include('../menu.html'); 
	include("../bd.php");
			$label = 'id';
		$id = false;
		if (  !empty( $_GET[ $label ] )  )
			{
			  $id = $_GET[ $label ];
			}
	?>
<br>
<br>
<br>
<h1 class=h1.block_h1 align=center>Выберите локацию</h1>

<script>
	
	function oth(){
		document.getElementById("div1").innerHTML = ('Поиск другой локации по параметрам:<br>Рядом с метро:<br><input type=checkbox>Петроградская<br><input type=checkbox>Нарвская<br><input type=checkbox>Балтийская<br>Тип помещения:<br><input type=checkbox>Кафе<br><input type=checkbox>Бар<<input type=checkbox>Музей<br><input type=checkbox>Набережная<br><input type=checkbox>Парк<br>Окружение: <br><input type=checkbox>Река<br>');
	}

	function stu(){
		document.getElementById("div1").innerHTML = ('Поиск фотостудии по параметрам: <br>Цена в час до: <br><input type="range" min="0" max="100" step="1" value="50"><br>Оборудование:<br><input type=checkbox>Естественный свет (окна) <br><input type=checkbox>Студийный свет <br><input type=checkbox>Вентилятор<br><input type=checkbox>Дым-машина<br>Оснащение:<br><input type=checkbox>Кровать<br><input type=checkbox>Ванна<br><input type=checkbox>Аквазона<br><input type=checkbox>Декорации<br><input type=checkbox>Диван<br><input type=checkbox>Камин<br><input type=checkbox>Кресло<br><input type=checkbox>Пианино/рояль<br><input type=checkbox>Качели<br><input type=checkbox>Сеновал<br><input type=checkbox>Деревянная стена<br><input type=checkbox>Кирпичная стена<br><input type=checkbox>Фактурные стены<br><input type=checkbox>Бумажные фоны<br><input type=checkbox>Фоны из ткани<br>Дополнительные услуги: <br><input type=checkbox>Аренда костюмов<br><input type=checkbox>WiFi<br><input type=checkbox>Парковка рядом со студией<br>Интерьеры:<br><input type=checkbox>Новогодний интерьер<br><input type=checkbox>Детские<br><input type=checkbox>Романтичные<br><input type=checkbox>Имитация квартиры<br><input type=checkbox>Спальня<br><input type=checkbox>Имитация кухни<br><input type=checkbox>Имитация улицы<br><input type=checkbox>Мрачные<br><input type=checkbox>Классические/дворцовые<br><input type=checkbox>Дизайнерские<br><input type=checkbox>Хайтек<br><input type=checkbox>Абстрактные<br><input type=checkbox>Лофт<br><input type=checkbox>Ретро<br><input type=checkbox>Треш<br>');
	}
	function help(){
		<?
		$_SESSION['location']=0;
		?>
	}
</script>
<br>
<h2 style='display:inline-block' onClick=stu()>Студия</h2>
<h2 style='display:inline-block' onClick=oth()>Другое</h2>
<a href='buy_3.php?id=3'><h2 style='display:inline-block' onClick=help()>Нужна помощь в выборе локации</h2></a>
<br>
<div id=div1></div>




</body>
</html>