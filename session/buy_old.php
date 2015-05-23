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

<br>
<br>
<br>
<h1 class=h1.block_h1 align=center>Выберите стиль фотосессии</h1>
<br>
		<?
			$request= "SELECT id_style, style_photo FROM style ORDER BY id_style";
			$result=mysql_query($request);


			while($row=mysql_fetch_array($result)){

			echo "<a href='buy_2.php?id=".$row['id_style']."'><table class=table_pr border='0' style='width:24%;' onClick=func".$row['id_style']."()><tr><td>
			<img class='title_img_pr'  src='buy/".$row['id_style'].".jpg'>
			<h1>".$row['style_photo']."</h1>
			</tr></table></a>";
			}
			?>
<div id=divv></div>
	<script>
		divv=document.getElementById("divv");
		function func1(){<? $_SESSION['style_photo']=1; ?>}
		function func2(){<? $_SESSION['style_photo']=2; ?>}
		function func3(){<? $_SESSION['style_photo']=3; ?>}
		function func4(){<? $_SESSION['style_photo']=4; ?>}
		
			<!--		divv.innerHTML = "<table class=table_pr border='0'><tr><td><img class='title_img_pr' src=buy/2.jpg><h1>Студия</h1></td></tr></table>";
			<!--		divv.innerHTML += "<table class=table_pr border='0'><tr><td><img class='title_img_pr' src=buy/2.jpg><h1>Улица</h1></td></tr></table>";
			<!--		divv.innerHTML += "<table class=table_pr border='0'><tr><td><img class='title_img_pr' src=buy/2.jpg><h1>Другое помещение</h1></td></tr></table>";
		
	</script>
	</body>
</html>