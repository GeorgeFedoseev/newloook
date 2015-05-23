<html><head>	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../css/style_session.css">
</head>

<body>
<div class="session_menu">
<?
include("../bd.php");
$request= "SELECT id_style,style_photo FROM style ORDER BY id_style";
$result=mysql_query($request);
while($row=mysql_fetch_array($result)){
$str=ucfirst($row['style_photo']);

echo "<a href='session.php?id=".$row['id_style']."' class='punkt_menu_session ps'> ".$str." </a>";
}
?>
</div>
</body></html>