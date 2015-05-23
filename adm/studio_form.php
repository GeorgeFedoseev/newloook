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
	
			$req=mysql_query("INSERT INTO district 
							(name_stud,id_district,price_from,price_to,window,prof_light,fan,smoke,bed,bath,aqua,decor,sofa,fireplace,chair,piano,swing,hayloft,wooden_wall,brick_wall,textured_wall,paper_backg,fabric_backg,rent_costum,wifi,parking,new_y_int,chikd_int,romant_int,room_int,bedroom_int,kitc_int,street_int,gloomy_int,classic_int,design_int,tech_int,abstract_int,loft_int,retro_int,trash_int)
							VALUES ('".$_POST['name_stud']."','".$_POST['id_district']."','".$_POST['price_from']."','".$_POST['price_to']."','".$_POST['window']."','".$_POST['prof_light']."','".$_POST['fan']."','".$_POST['smoke']."','".$_POST['bed']."','".$_POST['bath']."','".$_POST['aqua']."','".$_POST['decor']."','".$_POST['sofa']."','".$_POST['fireplace']."','".$_POST['chair']."','".$_POST['piano']."','".$_POST['swing']."','".$_POST['hayloft']."','".$_POST['wooden_wall']."','".$_POST['brick_wall']."','".$_POST['textured_wall']."','".$_POST['paper_backg']."','".$_POST['fabric_backg']."','".$_POST['rent_costum']."','".$_POST['wifi']."','".$_POST['parking']."','".$_POST['new_y_int']."','".$_POST['chikd_int']."','".$_POST['romant_int']."','".$_POST['room_int']."','".$_POST['bedroom_int']."','".$_POST['kitc_int']."','".$_POST['street_int']."','".$_POST['gloomy_int']."','".$_POST['classic_int']."','".$_POST['design_int']."','".$_POST['tech_int']."','".$_POST['abstract_int']."','".$_POST['loft_int']."','".$_POST['retro_int']."','".$_POST['trash_int']."')
							");
											
				if($req==1) echo("Данные изменены!");
					else echo("Что-то пошло не так! Попробуйте снова!");
		}
			else { 
				echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 0); </script>";
			}
?>
</body>
</html>