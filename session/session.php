<?
    session_start();
	header('Content-Type: text/html; charset=UTF-8');
?>
<html>
<head>
	<title>Фотосессии NewLook</title>
	<link rel="stylesheet" type="text/css" href="../css/style_project.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body>
	<?
		include("../menu.html");
	?>
	<h1 class=block_h1_session>Фотосессии</h1>
	<?	
	include("session_menu.php"); 
	?>
<br><br><br><br><br><br><br><br><br>
<?
		$label = 'id'; 
		$id = false;
		if (  !empty( $_GET[ $label ] )  )
			{
			  $id = $_GET[ $label ];
			}
 include("../bd.php");
$request= "SELECT id_photo,way_photo,style_photo FROM portfolio WHERE style_photo=".$id." ORDER BY id_photo";
$result=mysql_query($request);


while($row=mysql_fetch_array($result)){
echo "<table class=table_pr border='0' style='margin-top: 20px;'><tr><td><img class='title_img_pr' src=photo/".$row['way_photo'].">";
echo "</tr></table>";
}
?>	
</body>
</html>
</body>
</html>