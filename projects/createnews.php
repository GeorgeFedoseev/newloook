<?
$server="localhost";
$user="";
$pass="";
$DB="mynews";
$ntitle=$title;
$ntext=$newstext;
$nuser=$user;
$now = date(" H : i : s d - m - Y "); // ���� ����� ���������� � ������� "�����, ����"
mysql_connect($server,$user,$pass) or die("��� ��������!");
mysql_select_db($DB);
mysql_query("Insert INTO news(ntitle,ntext,ndate,nuser) VALUES('".addslashes($ntitle)."','".addslashes($ntext)."','".addslashes($now)."',
'".addslashes($nuser)."')");
mysql_close();
echo "������� ���������!";
?>