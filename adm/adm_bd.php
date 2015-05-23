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
</head>
<body>

<?php
	if($_SESSION['role']=='10')    {
		include("../menu.html");
		include("menu_adm.php");
		include("../bd.php");
		$request= "SELECT id_photo,way_photo,style_photo FROM portfolio ORDER BY style_photo";
		$result=mysql_query($request);

			echo("
				<table class='table_inline table_port' align=center><tr><td>
		");
		}
		
				
			else { 
				echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 0); </script>";
				}
	
	?>
	<h2><p><b>Загрузить фото в портфолио</b></p></h2>
<form action=upload.php method=post enctype=multipart/form-data>
<input type=file name=uploadfile>
<input type=submit value=Загрузить></form>
	<?php
echo("</td></tr></table>");
?>
	</body>
	</html>