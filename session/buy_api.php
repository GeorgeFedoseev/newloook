<?php

require_once("../bd.php"); 
require_once("buy_helpers.php"); 
require_once("../lib/Google/autoload.php");
require_once("../lib/Google/Client.php");
require_once("../lib/Google/Service/Calendar.php");

error_reporting(E_ERROR );
      
session_start();

if(isset($_GET["req"])){
    switch($_GET["req"]){
        case "calculate_cost":
            if(isset($_POST["order"])){
                $order = json_decode($_POST["order"]);
                echo json_encode(array("error" => false, 
                                      "cost" => calculateCost($order)));
            }else{
                echo json_encode(array("error" => "no order data"));
            }
            break;
        case "styles": 
                echo json_encode(array("error" => false, 
                                      "styles" => getStyles()));
            break;
        case "suggested_locations": 
            if(isset($_POST["order"])){
                $order = json_decode($_POST["order"]);
                echo json_encode(array("error" => false, 
                                      "locations" => getSuggestedLocations($order)));
            }else{
                echo json_encode(array("error" => "no order data"));
            }
               
            break;
        case "get_location_price_edges":
            if(isset($_GET["type"])){
                $location_type = $_GET["type"];
                echo json_encode(array("error" => false, 
                                      "edges" => getLocationPriceEdges($location_type)));
            }else{
                echo json_encode(array("error" => "need location type"));
            }            
            break;
        case "get_subways":
            echo json_encode(array("error" => false, 
                                      "subways" => getSubways()));
            break;
        
        case "search_locations":
                if(isset($_POST["query"])){
                    $query = json_decode($_POST["query"]);                    
                    echo json_encode(array("error" => false, 
                                      "locations" => searchLocations($query)));
                }else{
                    echo json_encode(array("error" => "no query"));
                }
            break;
        case "events":
                 echo json_encode(array("error" => false, 
                                      "events" => getEvents()));
            break;
        case "add_order":
                if(isset($_POST["order"])){
                    $order = json_decode($_POST["order"]);
                    echo json_encode(array("error" => addOrder($order)));
                }else{
                    echo json_encode(array("error" => "no order data"));
                }
            break;
        case "remove_order":
            $error = removeOrder($_GET["order"]);
            if(!$error){
                echo "<script>history.back();</script>";
            }else{
                echo $error;
            }
            break;
         case "approve_order":
            $error = approveOrder($_GET["order"]);
            if(!$error){
                echo "<script>history.back();</script>";
            }else{
                echo $error;
            }
            break;
        case "done_order":
            $error = doneOrder($_GET["order"]);
            if(!$error){
                echo "<script>history.back();</script>";
            }else{
                echo $error;
            }
            break;
        default: 
            echo json_encode(array("error" => "Unknown request ".$_GET["req"]));
    }
    
}else{
    echo "no request";
}


function approveOrder($id){
    if(!isset($_SESSION['login'])){
        return "Need auth";
    }
       
    $user = mysql_fetch_assoc(
        mysql_query("SELECT * FROM users WHERE login = '".mysql_escape_string($_SESSION['login'])."'")
    );
    
    if(!$user){
        return "Need auth (bad login) ";
    }
    
    $user = (object) $user;
    
    $order = mysql_fetch_assoc(
        mysql_query("SELECT * FROM order_photosession WHERE id_order = '".mysql_escape_string($id)."'")
    );
    
    if(!$order){
        return "No such order";
    }
    
    $order = (object) $order;
    
    if($user->role != 10){
        return "No premission";
    }
    
    mysql_query("UPDATE order_photosession SET approved = 1 WHERE id_order = $id");
    
    addToGoogleCalendar($order);
    
}

function addToGoogleCalendar($order){    
    // Service Account info
    $client_id = '292457922795-ekl932r6gb8feqhjl4tuhrke14fp5d6h.apps.googleusercontent.com';
    $service_account_name = '292457922795-ekl932r6gb8feqhjl4tuhrke14fp5d6h@developer.gserviceaccount.com';
    $key_file_location = $_SERVER['DOCUMENT_ROOT'].'/lib/newlookcal-cd82dde912b9.json';

    // Calendar id
    $calName = 'csel1ho0fodfqidbejg51tm9h8@group.calendar.google.com'; // DEBUG!


    $client = new Google_Client();
    $client->setApplicationName("Calendar test");

    $service = new Google_Service_Calendar($client);

    $data = json_decode(file_get_contents($key_file_location));
    
    $cred = new Google_Auth_AssertionCredentials(
     $service_account_name,
     array('https://www.googleapis.com/auth/calendar'),
     $data->private_key
    );

    $client->setAssertionCredentials($cred);
    
    $description = getOrderDescription($order);
    $summary = getOrderSummary($order);
    //print_r($summary);
    
    date_default_timezone_set("Europe/Moscow");
    
    $event = new Google_Service_Calendar_Event();
    $event->setDescription($description);
    $event->setSummary($description);
    $start = new Google_Service_Calendar_EventDateTime();
    $startDateTime = new DateTime($order->date_order.' '.$order->time_order);
    $start->setDateTime($startDateTime->format("c"));    
    //print_r($startDateTime->format("c"));
    $event->setStart($start);
    $end = new Google_Service_Calendar_EventDateTime();
    $endDateTime = $startDateTime->add(new DateInterval('PT' . $order->amount_hours . 'H'));
    $end->setDateTime($endDateTime->format("c"));
    $event->setEnd($end);    

    $createdEvent = $service->events->insert($calName, $event);

    
}

function fmt_gdate( $gdate ) {
  if ($val = $gdate->getDateTime()) {
    return (new DateTime($val))->format( 'd/m/Y H:i' );
  } else if ($val = $gdate->getDate()) {
    return (new DateTime($val))->format( 'd/m/Y' ) . ' (all day)';
  }
}

function doneOrder($id){
    if(!isset($_SESSION['login'])){
        return "Need auth";
    }
       
    $user = mysql_fetch_assoc(
        mysql_query("SELECT * FROM users WHERE login = '".mysql_escape_string($_SESSION['login'])."'")
    );
    
    if(!$user){
        return "Need auth (bad login) ";
    }
    
    $user = (object) $user;
    
    $order = mysql_fetch_assoc(
        mysql_query("SELECT * FROM order_photosession WHERE id_order = '".mysql_escape_string($id)."'")
    );
    
    if(!$order){
        return "No such order";
    }
    
    $order = (object) $order;
    
    if($user->role != 10){
        return "No premission";
    }
    
    mysql_query("UPDATE order_photosession SET done = 1 WHERE id_order = $id");
    
}

function removeOrder($id){
    if(!isset($_SESSION['login'])){
        return "Need auth";
    }
       
    $user = mysql_fetch_assoc(
        mysql_query("SELECT * FROM users WHERE login = '".mysql_escape_string($_SESSION['login'])."'")
    );
    
    if(!$user){
        return "Need auth (bad login) ";
    }
    
    $user = (object) $user;
    
    $order = mysql_fetch_assoc(
        mysql_query("SELECT * FROM order_photosession WHERE id_order = '".mysql_escape_string($id)."'")
    );
    
    if(!$order){
        return "No such order";
    }
    
    $order = (object) $order;
    
    if($user->role != 10 && $user->id_user != $order->id_order){
        return "No premission";
    }
    
    mysql_query("DELETE FROM order_photosession WHERE id_order = $id");
    return false;    
}

function addOrder($order){
    if(!isset($_SESSION['login'])){
        return "Need auth";
    }
       
    $user = mysql_fetch_assoc(
        mysql_query("SELECT * FROM users WHERE login = '".mysql_escape_string($_SESSION['login'])."'")
    );
    
    if(!$user){
        return "Need auth (bad login) ";
    }
       
    $user = (object) $user;
       
    mysql_query("
        INSERT INTO order_photosession (id_user, name, tel, date_order, time_order, amount_hours, type, id_style,
                                        id_location, amount_people, amount_makeup, amount_hairstylist,
                                        amount_florist)
            VALUES(
                 $user->id_user,
                 '$order->name',
                 '$order->tel',
                 '$order->date',
                 '$order->time',
                 $order->hours,
                 '$order->type',
                 $order->style,
                 $order->location,
                 '$order->people_number',
                 $order->visagist,
                 $order->stylist,
                 $order->florist                 
            )
    ");
       
    if(mysql_error()){
       return "mysql_error";
    }
       
    return false;
}


function getEvents($approved = true){
    $approved = (bool)$approved;
    $result = array();
    $query = mysql_query("SELECT date_order, time_order, amount_hours FROM order_photosession
                    WHERE approved = $approved");
    while ($row = mysql_fetch_assoc($query)){
        $result[] = $row;
    }
    
    return $result;
}





function searchLocations($query){
    $result = array();
    
    $mysql_query = null;
    
    if($query->closest_subway != -1){
        
        $mysql_query = mysql_query("SELECT * FROM location WHERE 
                                    id_subway = $query->closest_subway
                                AND id_type_location = $query->location_type
                                AND price >= $query->min_price
                                AND price <= $query->max_price
                                AND keywords LIKE '%$query->keywords%'");
    }else{
        
        $mysql_query = mysql_query("SELECT * FROM location WHERE 
                                    id_type_location = $query->location_type
                                AND price >= $query->min_price
                                AND price <= $query->max_price
                                AND keywords LIKE '%$query->keywords%'");
    }

    
    
    while ($row = mysql_fetch_assoc($mysql_query)){
        $result[] = $row;
    }
    
    return $result;
}


function getSubways(){
    $result = array();
    $query = mysql_query("SELECT * FROM subway");
    while ($row = mysql_fetch_assoc($query)){
        $result[] = $row;
    }
    
    return $result;
}


function getLocationPriceEdges($location_type){
    $query = null;
    if($location_type == 2){        
        $query = mysql_query("SELECT max(price) as max, min(price) as min FROM location WHERE id_type_location = 2");
    }else{
        $query = mysql_query("SELECT max(price) as max, min(price) as min FROM location WHERE id_type_location = 1");        
    } 
    
    return mysql_fetch_assoc($query);
}

function getSuggestedLocations($order){
    $style_id = (int)$order->style;
    $result = array();
    $query = mysql_query("SELECT location.* FROM location 
                LEFT JOIN location_and_style ON location.id_location = location_and_style.location
                LEFT JOIN photosession_style ON photosession_style.id = location_and_style.style
                WHERE photosession_style.id = $style_id");
    while ($row = mysql_fetch_assoc($query)){
        $result[] = $row;
    }
    
    return $result;
}

function getStyles(){
    $result = array();
    $query = mysql_query("SELECT * FROM photosession_style");
    while ($row = mysql_fetch_assoc($query)){
        $result[] = $row;
    }
    
    return $result;    
}


      
?>