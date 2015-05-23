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
		
		$id_photo=$_POST['idphoto'];
		$wayphoto=$_POST['wayphoto'];
		$stylephoto=$_POST['stylephoto'];
		$wayphoto_start=$_POST['wayphoto_start'];
		$stylephoto_start=$_POST['stylephoto_start'];
		

		
		$request2 = "SELECT id_style, style_photo FROM style WHERE id_style=".$stylephoto;	
		$result2=mysql_query($request2);
		
		include("../menu.html");
		include("menu_adm.php");
		
		echo (" 
				<table class='table_port' align=center><tr><td>
				<img src='../session/photo/".$_POST['wayphoto']."' class='photo_port' align=left>
				id_photo:<b>".$_POST['idphoto']."</b>
				<br>
			Название фото: <b> ".$_POST['wayphoto']."</b>
				<br>
				Стиль фото: ");
				
			while($row2=mysql_fetch_array($result2)){
					echo ($row2['style_photo']."<br><br>");
				}
			echo("<b>");
			if($stylephoto_start==$stylephoto && $wayphoto_start==$wayphoto){ 
					echo("Вы ничего не изменили");}
				else if($stylephoto_start!=$stylephoto && $wayphoto_start==$wayphoto){ 
						$req=mysql_query("UPDATE portfolio SET style_photo='".$stylephoto."' WHERE id_photo=".$idphoto);
						if($req==1) echo("Стиль фото изменен!");
						else ("Что-то пошло не так! Попробуйте снова!");
						}
					else if($stylephoto_start==$stylephoto && $wayphoto_start!=$wayphoto){ 
							$req=mysql_query("UPDATE portfolio SET way_photo='".$wayphoto."' WHERE id_photo=".$idphoto);	
							if($req==1) echo("Путь к фото изменен!");
							else ("Что-то пошло не так! Попробуйте снова!");
							}
							else { 
								$req=mysql_query("UPDATE portfolio SET way_photo='".$wayphoto."', style_photo='".$stylephoto."' WHERE id_photo=".$idphoto);	
								if($req==1) echo ("Данные изменены!");
								else ("Что-то пошло не так! Попробуйте снова!");
								}
			echo("</b>");

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