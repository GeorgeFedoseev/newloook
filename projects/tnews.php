<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
</head>
<?
$server="localhost";
$user="root";
$pass="";
$DB="";
mysql_connect($server,$user,$pass) or die("Нет коннекта!");
mysql_select_db($DB);
$request= "SELECT ntext, ntitle, ndate, nuser FROM news ORDER BY news_id DESC LIMIT 15";
$result=mysql_query($request);
while($row=mysql_fetch_array($result)){
echo "<table align='center' width=98% border='0' cellpadding=3 cellspacing=1 bgcolor=#FDFEFF>";
echo "<tr><td bgcolor=#FFFFFF>".$row['ntitle']."   Дата ".$row['ndate']."   Aiaaaee ".$row['nuser']."</td></tr>";
echo "<tr><td bgcolor=#FFFFFF>".$row['ntext']."</td></tr>";
echo "<tr><td bgcolor=#F4F4F4> </td></tr></table><br>";
}
?>