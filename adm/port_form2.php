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
<?



	if($_SESSION['role']=='10')    {
		
		include("../bd.php");
		
		$idphoto=$_POST['id_photo'];
		
		$request2 = "SELECT id_style, way_photo, style_photo FROM portfolio WHERE id_photo=".$idphoto;	
		$result2=mysql_query($request2);
		
		include("../menu.html");
		include("menu_adm.php");
		echo (" 
				<table class='table_port' align=center><tr><td>
				<img src='../session/photo/".$_POST['wayphoto']."' class='photo_port' align=left>
				id_photo:<b>".$_POST['id_photo']."</b>
				<br>
				");
			echo("<b>");
			$request3 = "DELETE FROM portfolio WHERE id_photo=".$idphoto;	
			$result3=mysql_query($request3);
			echo("Фото удалено! </b>");

			echo("
				<br>
				</td></tr></table>
				<form action='adm_port.php' style='text-align: center;' >
					<input type=submit class='form_butt' value='Назад' >
				</form>
				");
			
	}
			else { 
				echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 0); </script>";
			}
?>
</body>
</html>