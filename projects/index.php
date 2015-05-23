<?
    session_start();
	header('Content-Type: text/html; charset=UTF-8');
?>
<html>
<head>
	<title>Фотопроекты NewLook</title>
	<link rel="stylesheet" type="text/css" href="../css/style_project.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body>

	<?
	include("../menu.html");
	?>
<br>
<h1 class=projects_block_h1>Фотопроекты</h1>
<?
include("../bd.php");
$date_now=date('Y-m-d'); 
$request= "SELECT id_project, name_project, date_start, date_over, about_project, price, name_folder FROM photoproject WHERE (".$date_now."<date_over) ORDER BY id_project";
//$request= "SELECT id_pr, title_pr, day_pr, day_over_pr, about_pr, price_pr,name_folder_pr FROM photoproject WHERE now=1 ORDER BY id_pr";
$result=mysql_query($request);


while($row=mysql_fetch_array($result)){
if($date_now<$row['date_over']){
echo "<a href='project.php?id=".$row['id_project']."'><table class=table_pr border='0' ><tr><td><img class='title_img_pr' src='".$row['name_folder']."/title_photo.jpg'>";
echo "<h1 class=title_pr_h1>Фотопроект ".$row['name_project']."</h1>";
echo "<p class=about_date_pr>".$row['date_start']."-".$row['date_over']."</p>";
echo "<h2 class=about_pr_h2>".$row['about_project']."</h2>";

echo "</tr></table></a>";
}
}

?>	

<a href="others.php"><h2 class="projects_block_h1 a1" style="font-size:25px;">Посмотреть прошедшие фотопроекты</h2></a>
</body>
</html>