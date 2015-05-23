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
	?>
	<h1 class=projects_block_h1>Количество часов</h1>
	<h2 align=center>Количество часов и </h2>
	<form align=center action='buy_4.php' method=post>
		<div id=people></div>
		<select>
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
		<h2 align=center onClick=next()>Далее</h2>
		<?
		echo(" Стиль фото: ".$_SESSION['style_photo']);
		echo(" Количество людей: ".$_SESSION['people']);
		echo(" Количество визажистов: ".$_POST['make']);
		echo(" Количество стилистов: ".$_POST['style']);
		?>
	</form>
	
	

</body>
</html>