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
<?



	if($_SESSION['role']=='10')    {
		
		include("../bd.php");
		
		$id_pr=$_POST['id_pr'];
		$title_pr=$_POST['title_pr'];
		$name_folder_pr=$_POST['name_folder_pr'];
		$day_pr=$_POST['day_pr'];
		$day_over_pr=$_POST['day_over_pr'];
		$about_pr=$_POST['about_pr'];
		$price_pr=$_POST['price_pr'];
		$makeup_pr=$_POST['makeup_pr'];
		$hairdresser_pr=$_POST['hairdresser_pr'];
		$florist_pr=$_POST['florist_pr'];
		$id_location=$_POST['id_location'];
		$adr_location=$_POST['adr_location'];
		$now=$_POST['now'];
		$color_pr=$_POST['color_pr'];
		$color_butt_txt_pr=$_POST['color_butt_txt_pr'];
		$color_butt=$_POST['color_butt'];
		

		
		$request= "SELECT id_pr,title_pr,name_folder_pr,day_pr,day_over_pr,about_pr,price_pr,makeup_pr,hairdresser_pr,florist_pr,id_location,adr_location,now,color_pr,color_butt_txt_pr,color_butt FROM photoproject WHERE id_pr=".$id;
		$result=mysql_query($request);
		
		include("../menu.html");
		include("menu_adm.php");
		
		echo (" <table align=center border='0' style=' width: 600px;'><tr><td><img class='title_img_pr' src='../projects/".$name_folder_pr."/top_photo.jpg'>
		<form action='adm_projects.php'>
				id проекта:	<b>".$id_pr."</b>
					<br>
					Название проекта: <b>".$title_pr."</b>
					<br>
					Название папки проекта: <b>".$name_folder_pr."</b>
					<br> 
					Дата начала:<b>".$day_pr."</b>
					<br>
					Дата окончания: <b>".$day_over_pr."</b>
					<br>
					О проекте: <br><b>".$about_pr."</b>
					<br>
					Цена проекта: <b>".$price_pr."</b>
					<br>
					В проект включены: <br>");
					if($makeup_pr=='1') {echo ("<input type=checkbox name=makeup_pr value='true' disabled checked>Визажист<br>");}
						else {echo ("<input type=checkbox disabled name=makeup_pr value='true'>Визажист<br>");}
					if($hairdresser_pr=='1') {echo ("<input type=checkbox disabled name=hairdresser_pr value='true' checked>Стилист<br>");}
						else {echo ("<input type=checkbox disabled name=hairdresser_pr value='true'>Стилист<br>");}
					if($florist_pr=='1') {echo ("<input type=checkbox disabled name=florist_pr value='true' checked>Флорист<br>");}
						else {echo ("<input type=checkbox disabled name=florist_pr value='true'>Флорист<br>");}
				echo("	
					id локации: ".$id_location."
					<br>
					Адрес локации: (при отсутствии id): ".$adr_location."
					<br>
					Идет ли запись сейчас? ");
					
					if($now=='1') { echo ("<input type=checkbox checked disabled value='true'> Да "); }
						else { echo ("<input type=checkbox disabled value='true'> Да "); }
					echo("
					<br>
					Цвет надписи сверху: ".$color_pr."
					<br>
					Цвет текста на кнопке:".$color_butt_txt_pr."
					<br>
					Цвет кнопки:".$color_butt."
					
				<br>
				</td></tr></table>
				
					<input type=submit class='form_butt' value='Назад' >
				</form>
				");
			$req=mysql_query("UPDATE photoproject SET 
											title_pr='".$title_pr."',
											name_folder_pr='".$name_folder_pr."',
											day_pr='".$day_pr."',
											day_over_pr='".$day_over_pr."',
											about_pr='".$about_pr."',
											price_pr='".$price_pr."',
											makeup_pr='".$makeup_pr."',
											hairdresser_pr='".$hairdresser_pr."',
											florist_pr='".$florist_pr."',
											id_location='".$id_location."',
											adr_location='".$adr_location."',
											now='".$now."',
											color_pr='".$color_pr."',
											color_butt_txt_pr='".$color_butt_txt_pr."',
											color_butt='".$color_butt."' 
							WHERE id_pr=".$id_pr);	
				if($req==1) echo("Данные изменены!");
					else echo("Что-то пошло не так! Попробуйте снова!");
		}
			else { 
				echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 0); </script>";
			}
?>
</body>
</html>