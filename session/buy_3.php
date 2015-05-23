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
	<script>
		var peoples=0;
		var make=0,style=0,flor=0; 
		var make11=0, make22=0,make33=0,make44=0,make55=0,make66=0,make77=0,make88=0;
		var style11=0, style22=0,style33=0,style44=0,style55=0,style66=0,style77=0,style88=0;
		<?php
		$_SESSION['make']=0;
		$_SESSION['style']=0;
		$_SESSION['people']=0;
		?>
		function add_people(){
			if(peoples<9){
			peoples++;
			people.innerHTML+=("<h2 align=center>"+peoples+" <input type=checkbox onClick='make"+peoples+"()'>Визажист  <input type=checkbox  onClick='style"+peoples+"()'>Стилист</h2>");
			about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}}
		function make1(){
			if(make11==0){ make++; make11=1;}
			else if(make11==1){ make--; make11=0;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}		
		function make2(){
			if(make22==0){make++; make22++;}
			else if(make22==1){ make--; make22--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function make3(){
			if(make33==0){ make++; make33++;}
			else if(make33==1){ make--; make33--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function make4(){
			if(make44==0){make++; make44++;}
			else if(make44==1){ make--; make44--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function make5(){
			if(make55==0){ make++; make55++;}
			else if(make55==1){ make--; make55--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function make6(){
			if(make66==0){make++; make66++;}
			else if(make66==1){ make--; make66--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function make7(){
			if(make77==0){ make++; make77++;}
			else if(make77==1){ make--; make77--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function make8(){
			if(make88==0){ make++; make88++;}
			else if(make88==1){ make--; make88--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function style1(){
			if(style11==0){ style++; style11++;}
			else if(style11==1){ style--; style11--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function style2(){
			if(style22==0){ style++;  style22++;}
			else if(style22==1){ style--; style22--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function style3(){
			if(style33==0){ style++;  style33++;}
			else if(style33==1){ style--;style33--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function style4(){
			if(style44==0){ style++; style44++;}
			else if(style44==1){ style--; style44--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function style5(){
			if(style55==0){ style++;  style55++;}
			else if(style55==1){ style--; style55--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function style6(){
			if(style66==0){ style++;  style66++;}
			else if(style66==1){ style--; style66--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function style7(){
			if(style77==0){ style++;  style77++;}
			else if(style77==1){ style--; style77--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}
		function style8(){
			if(style88==0){ style++;  style88++;}
			else if(style88==1){style--;  style88--;}
			 about.innerHTML='Людей '+peoples+' Визажистов '+make+' Стилистов '+style;
		}

	</script>
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
	<br><br><br>
	<h1 class=projects_block_h1>Количество человек и услуги</h1>
	<h2 align=center>Сначала добавтье необходимое количество человек, затем услуг для каждого</h2>
	<form align=center action='buy_4.php' method=post>
		<div id=people></div>
		<div id=about></div>
		<h2 align=center onClick=add_people()>Добавить человека</h2>
		<input type=submit align=center value=Далее>
	</form>
	
	
	<script>
		people=document.getElementById("people");
		about=document.getElementById("about");
	</script>

</body>
</html>