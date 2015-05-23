<?
    session_start();
	header('Content-Type: text/html; charset=UTF-8');
?>

<html>
<head>
	<title> 
		Фотопроект NewLook 
	</title>
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
		include("../menu.html");
		include("menu_adm.php");
		$label = 'id';
		$id = false;
		if (  !empty( $_GET[ $label ] )  )
			{
			  $id = $_GET[ $label ];
			}

		include("../bd.php");
		$request= "SELECT id_pr,title_pr,name_folder_pr,day_pr,day_over_pr,about_pr,price_pr,makeup_pr,hairdresser_pr,florist_pr,id_location,adr_location,now,color_pr,color_butt_txt_pr,color_butt FROM photoproject WHERE id_pr=".$id;
		$result=mysql_query($request);

		while($row=mysql_fetch_array($result)){

		echo ("<table align=center border='0' style=' width: 600px;'><tr><td><img class='title_img_pr' src='../projects/".$row['name_folder_pr']."/top_photo.jpg'>
		<form method='POST' action='proj_form.php'>
					id проекта:	<b><input name=id_pr type=hidden name=id_pr value='".$row['id_pr']."'>".$row['id_pr']."</b>
					<br>
					Название проекта: <b><input name=title_pr type=text style='width: 100px' value='".$row['title_pr']."'></b>
					<br>
					Название папки проекта: <b><input name=name_folder_pr type=text style='width: 100px' value='".$row['name_folder_pr']."'></b>
					<br> 
					Дата начала: <input type=text name=day_pr value=' ".$row['day_pr']."'>
					<br>
					Дата окончания:  <input type=text name=day_over_pr value='".$row['day_over_pr']."'>
					<br>
					О проекте: <br><textarea cols=70 rows=5 name=about_pr>".$row['about_pr']."</textarea>
					<br>
					Цена проекта:  <input type=text name=price_pr value='".$row['price_pr']."'>
					<br>
					В проект включены: <br>");
					if($row['makeup_pr']==1) {echo ("<input type=checkbox name=makeup_pr value='1' checked>Визажист<br>");}
						else {echo ("<input type=checkbox name=makeup_pr value='1'>Визажист<br>");}
					if($row['hairdresser_pr']==1) {echo ("<input type=checkbox name=hairdresser_pr value='1' checked>Стилист<br>");}
						else {echo ("<input type=checkbox name=hairdresser_pr value='1'>Стилист<br>");}
					if($row['florist_pr']==1) {echo ("<input type=checkbox name=florist_pr value='1' checked>Флорист<br>");}
						else {echo ("<input type=checkbox name=florist_pr value='1'>Флорист<br>");}
					echo("	
					id локации: <input type=text name=id_location value=".$row['id_location'].">
					<br>
					Адрес локации: (при отсутствии id): <input type=text name=adr_location value='".$row['adr_location']."'>
					<br>
					Идет ли запись сейчас? ");
					if($row['now']==1) { echo ("<input type=checkbox name=now checked value='1'> Да "); }
						else { echo ("<input type=checkbox name=now  value='1'> Да "); }
					echo("
					<br>
					Цвет надписи сверху: <input type=text name=color_pr value='".$row['color_pr']."'>
					<br>
					Цвет текста на кнопке:<input type=text name=color_butt_txt_pr value='".$row['color_butt_txt_pr']."'>
					<br>
					Цвет кнопки: <input type=text name=color_butt value='".$row['color_butt']."'>
					
					<br><br>
					<input type=submit id='".$row['id_pr']."' value='изменить' class='button_change'>
					</form>");
		}
	}
				else { 
				echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 0); </script>";
				}
?>
</body>
</html>