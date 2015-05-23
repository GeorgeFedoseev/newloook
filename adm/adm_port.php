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

		while($row=mysql_fetch_array($result)){
			echo("
				<table class='table_inline table_port' align=center valign=top><tr><td>
				<img src='../session/photo/".$row['way_photo']."' class='photo_port' align=left>
				<form method='POST' action='port_form.php' >
					id фото: 
						<b><input type=hidden name=idphoto value='".$row['id_photo']."'>".$row['id_photo']."</b>			
						<input type=hidden name=wayphoto_start value='".$row['way_photo']."'>
						<input type=hidden name=wayphoto value='".$row['way_photo']."'>
					<br>
					Стиль фото: 
						<input type=hidden name=stylephoto_start value=".$row['style_photo'].">

					
				");
		$request2 = "SELECT id_style, style_photo FROM style ORDER BY id_style";	
		$result2=mysql_query($request2);
				 	while($row2=mysql_fetch_array($result2)){
					if($row['style_photo']==$row2['id_style'])	{echo ("<br><input type=radio name='stylephoto' checked  value='".$row2['id_style']."'> ". $row2['style_photo'] ."</input>");}
							else echo ("<br><input type=radio name='stylephoto'  value='".$row2['id_style']."' >". $row2['style_photo'] ."</input>");
					}
						echo("
					<br><br>
					<input type=submit id='".$row['id_photo']."' value='изменить' class='button_change'>
					</form>
					<form method='POST' action='port_form2.php'>
					<input type=hidden name=id_photo value='".$row['id_photo']."'>
					<input type=submit id='".$row['id_photo']."' value='удалить' class='button_change'>
					<input type=hidden name=wayphoto value='".$row['way_photo']."'>
					</form>
						<br><br><br>
				</td></tr></table>
			
		");
		}
		
				}
			else { 
				echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 0); </script>";
				}
	
	?>
	<br>
<form action=upload.php method=post enctype=multipart/form-data align=center>
<h2>Загрузить новую работу в порфтолио</h2>
<br>
<input type=file name=uploadfile>
<input type=submit value=Загрузить>
<?php 
	$result2=mysql_query($request2);
		while($row2=mysql_fetch_array($result2)){
		echo "<br><input type=radio name='stylephoto'  value='".$row2['id_style']."' >". $row2['style_photo'] ."</input>";
					}
?>
</form>
	</body>
	</html>