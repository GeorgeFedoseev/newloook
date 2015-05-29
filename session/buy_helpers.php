<?

function calculateCost($order){
    if(isset($order->id_order)){
        // это формат БД, надо ковертировать
        $order->people_number = $order->amount_people;
        $order->hours = $order->amount_hours;
        $order->location = $order->id_location;
        $order->visagist = $order->amount_makeup;
        $order->stylist = $order->amount_hairstylist;
        $order->florist = $order->amount_florist;
    }
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
        
    $main_service_price = $order->hours*$order->people_number * 500;
    
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


function photo_location($location_id){
    $res = mysql_fetch_assoc(mysql_query(
        "SELECT name FROM location WHERE id_location = $location_id"
    ));
    return $res["name"];
}


function photo_style($style_id){
    $res = mysql_fetch_assoc(mysql_query(
        "SELECT name FROM photosession_style WHERE id = $style_id"
    ));
    return $res["name"];
}

function photo_type($type_name){
    switch($type_name){
        case "individual":
                return "Для одного";
            break;
        case "lovestory":
                return "Love story";
            break;
        case "several":
                return "Для нескольких";
            break;
        case "family":
                return "Семейная";
            break;
    }
    
    return "Неизвестный тип фотосессии";
}

function getOrderDescription($order){
    $cost = calculateCost($order);
    
    $out = "";
    $out .= photo_type($order->type);
    $out .= ", в стиле ";
    $out .= photo_style($order->id_style);
    $out .= " Локация: ";
    $out .= photo_location($order->id_location);
    $out .= " Визажист: ";
    $out .= $order->amount_makeup;
    $out .= ", стилист: ";
    $out .= $order->amount_hairstylist;
    $out .= " Сумма: ";
    $out .= $cost["total"]."р.";
    $out .= " ".$order->name;
    $out .= " тел. ".$order->tel;
    
    
    return $out;                                 
}

function getOrderSummary($order){
    $cost = calculateCost($order);
    
    $out = "";
    $out .= photo_type($order->type);
    $out .= ", в стиле ";
    $out .= photo_style($order->id_style);
    $out .= " Локация: ";
    $out .= photo_location($order->id_location);    
    $out .= " Сумма: ";
    $out .= $cost["total"]."р.";    
    
    
    return $out;                                 
}


?>