<?php

require_once("../bd.php"); 

error_reporting(E_ERROR );
      


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
        default: 
            echo json_encode(array("error" => "Unknown request ".$_GET["req"]));
    }
    
}else{
    echo "no request";
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

function calculateCost($order){
    /*
        type: ["individual"|"several"|"lovestory"|"family"],
        people_number: 1,
        style: [1-8],
        location: 1,
        stylist: 0,
        visagist: 0,
        florist: 0,
        date: "2015-05-25",
        time: "9:00",
        hours: 1
    */
    
    $total_price = 0;
        
    $main_service_price = $order->people_number * 500;
    
    $location_price = 0;
    
    $location = getLocation($order->location);

    if($location->id_type_location == 2){
        // studio - per hour price
        $location_price = $order->hours * $location->price;
    }else{
        // simple location - pay only for entrance
        $location_price = (int)$location->price;
    }
    
    $visagist_price = $order->visagist*800;
    $stylist_price = $order->stylist*700;
    $florist_price = $order->florist*500;
    
    $total_price = $main_service_price 
                + $location_price
                + $visagist_price
                + $stylist_price
                + $florist_price;
    
    
    return array(
        "main_service_price" => $main_service_price,
        "location_price" => $location_price,
        "visagist_price" => $visagist_price,
        "stylist_price" => $stylist_price,
        "florist_price" => $florist_price,
        "total" => $total_price
    );   
}

function getLocation($loc_id){
    $loc_id = (int) $loc_id;
    $query = mysql_query("SELECT price, id_type_location FROM location WHERE id_location = $loc_id");
    return (object)mysql_fetch_assoc($query);
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