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

    <div class="adm_ordes_container">
<?php
	if($_SESSION['role']=='10')    {
		include("../menu.html");
		include("menu_adm.php");
		include("../bd.php");
        
        if(!isset($_SESSION['id_user'])){
            $_SESSION["after_login"] = "/cabinet.php";
            ?>
            <meta http-equiv="refresh" content="0; url=/login/login.php" />
            <?
            exit();
        }
        
        require_once("../session/buy_helpers.php");
        
        $query_user_orders = mysql_query("SELECT * FROM order_photosession ORDER BY date_order, time_order");
        if($query_user_orders){
            ?>
            <h1>Заказы</h1>
            <div class="adm_orders">
            <?
    
    
    
            while($order = mysql_fetch_assoc($query_user_orders)){
                $order = (object) $order; 
                $cost = calculateCost($order);
                ?>

                <div class="adm_order">
                    <div class="title">Заказ #<?echo $order->id_order;?></div>
                    <div class="desc">
                        <b><?echo photo_type($order->type);?>,
                            в стиле <?echo photo_style($order->id_style);?>. </b>
                        <br>
                        Локация: <b><?echo photo_location($order->id_location);?>.</b>
                        <br>
                        Визажист: <?echo $order->amount_makeup;?>,                 
                        стилист: <?echo $order->amount_hairstylist ;?>.
                        <br>
                        Дата: <b><?echo date("d/m/Y", strtotime($order->date_order)) ;?>.</b>
                        Время: <b><?echo date("H:i", strtotime($order->time_order));?>.</b>
                        Часов: <b><?echo $order->amount_hours;?>.</b>
                        <br>
                        Сумма: <b><?echo $cost["total"];?>р.</b>
                        <br>
                        <?echo $order->name;?>, тел. <?echo $order->tel;?>
                    </div>
                    <div class="status">
                        <b>Статус заказа:</b><br>  <?echo $order->done?"Выполнено":($order->approved?"Одобрено":"Создан");?>
                        <br><br>
                        <?if(!$order->approved){?>
                            <a href="/session/buy_api.php?req=approve_order&order=<?echo $order->id_order;?>">Одобрить заказ</a><br>
                        <?}else if(!$order->done){?>
                            <a href="/session/buy_api.php?req=done_order&order=<?echo $order->id_order;?>">Отметить выполненным</a><br>
                        <?}?>
                        <br>
                        <a href="/session/buy_api.php?req=remove_order&order=<?echo $order->id_order;?>">Удалить заказ</a><br>
                    </div>
                    <div style="clear:both;"></div>
                </div>        
                <?

            }
            ?>
            </div>
            <?
        }else{
            ?>
            <h1>У Вас пока нет заказов</h1>
            <?
        }
    
		
    }else { 
        echo "<script Language=\"JavaScript\"> setTimeout(\"document.location='../index.php'\", 0); </script>";
    }
	
	?>
	</div>
</body>
</html>