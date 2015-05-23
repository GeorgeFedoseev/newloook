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

// Каталог, в который мы будем принимать файл:
$uploaddir = '../session/photo/';
$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
$request2="SELECT * FROM portfolio";
$result2=mysql_query($request2); 
while($row=mysql_fetch_array($result2))
		if($_FILES['uploadfile']['name']==$row['way_photo'])$namefile=0; else $namefile=1;
	if($namefile==1) {
					
// Копируем файл из каталога для временного хранения файлов:
if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
{
echo "<h2 align=center>Файл успешно загружен на сервер</h2>";
}
else { echo "<h2 align=center>Ошибка! Не удалось загрузить файл на сервер!</h2>"; exit; }
	$request="INSERT INTO portfolio (way_photo, style_photo) values('".$_FILES['uploadfile']['name']."','".$_POST['stylephoto']."')";
	$result=mysql_query($request);
				}
				if($namefile==0) echo "<h2 align=center>Файл с таким именем уже существует</h2>";
			}else { 
				echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 0); </script>";
				}
	
	?>

	</body>
	</html>