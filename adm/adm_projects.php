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

<?php
	if($_SESSION['role']=='10')    {
		include("../menu.html");
		include("menu_adm.php");
		
		include("../bd.php");
		$request= "SELECT * FROM photoproject ORDER BY id_project";
		$result=mysql_query($request);


		while($row=mysql_fetch_array($result)){

		echo ("<a href='adm_project.php?id=".$row['id_project']."'><table class=table_pr border='0'><tr><td><img class='title_img_pr' src='../projects/".$row['name_folder']."/title_photo.jpg'>
		<h1 class=title_pr_h1>Фотопроект ".$row['name_project']."</h1>
		<p class=about_date_pr>".$row['date_start']."-".$row['date_over']."</p>
		<div class=about_date_pr>Сейчас идет?");
			if($row['now']==1) { echo ("<input type=checkbox disabled checked value='true'> Да "); }
				else { echo ("<input type=checkbox disabled value='true'> Да "); }
		echo("
		</div></tr></table></a>");
		}
		
				}
			else { 
				echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 0); </script>";
				}
	
	?>
	</body>
	</html>