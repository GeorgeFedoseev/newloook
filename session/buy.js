var app = angular.module('buy', ['onsen']); 

app.controller("MainCtrl", function($scope, $rootScope){    
   setTimeout(function(){
       nav.pushPage("Type.html");  
   }, 500);
   
    $rootScope.order = {
        type: "individual",
        people_number: 1,
        style: 1,
        location: 1
        
    };
    
    $rootScope.total_cost = 0;
    
    $rootScope.recalculateCost = function(){
        $.post("buy_api.php?req=calculate_cost", {
            order: JSON.stringify($rootScope.order)
        }, function(data){
            data = JSON.parse(data);
            if(data.error){
                console.log(data.error);
                return;
            }
            
            $rootScope.total_cost = data.cost;
            
            if ($scope.$root.$$phase != '$apply' && $scope.$root.$$phase != '$digest') {
                $scope.$apply();
            }
        });
    }
    
});

app.controller("BuyTypeCtrl", function($scope, $rootScope, $element){    
    $rootScope.main_title = "Выберите тип фотосессии";
    
    $scope.next_button_active = false;
    
    $scope.select = function(type, $event){
        $card = $($event.target).closest(".b_card");
        
        
        $element.find(".b_card").removeClass("selected");       
        $card.addClass("selected");       
        
        $scope.showSelectPeopleNumber = false;
        
        $rootScope.order.type = type;
        if(type == "several" || type == "family"){
            $rootScope.order.people_number = 2;
            $scope.showSelectPeopleNumber = true;            
        }else if(type == "lovestory") {            
            $rootScope.order.people_number = 2;
        }else{
            $rootScope.order.people_number = 1;
        }
        
        $scope.next_button_active = true;
        
        console.log($rootScope.order); 
        $rootScope.recalculateCost();
    }
    
    $scope.incr_people_num = function(){
        $rootScope.order.people_number++;
        $rootScope.recalculateCost();
    }
    
    $scope.decr_people_num = function(){
        if($rootScope.order.people_number > 1){
            $rootScope.order.people_number--;            
        }
        
        $rootScope.recalculateCost();
    }
    
    
    $scope.next = function(){
        nav.pushPage("Style.html");
    }
});


app.controller("BuyStyleCtrl", function($scope, $rootScope, $element){    
    $rootScope.main_title = "Выберите стиль фотосессии";
    $scope.next_button_active = false;
    
    $.get("buy_api.php?req=styles", function(data){
        data = JSON.parse(data);
        
        $scope.styles = data.styles;
        
        if ($scope.$root.$$phase != '$apply' && $scope.$root.$$phase != '$digest') {
            $scope.$apply();
        }
    });
    
    $scope.select = function(style_id, $event){
        $card = $($event.target).closest(".b_card");
        
        
        $element.find(".b_card").removeClass("selected");       
        $card.addClass("selected");       
        
        $rootScope.order.style = parseInt(style_id);
        
        $scope.next_button_active = true;
        
        console.log($rootScope.order); 
        $rootScope.recalculateCost();
    }
    
    $scope.next = function(){
        nav.pushPage("Location.html");
    }
    
    $scope.back = function(){
        nav.popPage();
    }
    
});


app.controller("BuyLocationCtrl", function($scope, $rootScope, $element){    
    $rootScope.main_title = "Выберите локацию";
    $scope.next_button_active = false;
    
    $.post("buy_api.php?req=suggested_locations", {
        order: JSON.stringify($rootScope.order)
    }, function(data){
        data = JSON.parse(data);        
        console.log(data);
        
        $scope.locations = data.locations;
        
        if ($scope.$root.$$phase != '$apply' && $scope.$root.$$phase != '$digest') {
            $scope.$apply();
        }
    });
    
    $scope.select = function(location_id, $event){
        $card = $($event.target).closest(".b_card");
        
        
        $element.find(".b_card").removeClass("selected");       
        $card.addClass("selected");       
        
        $rootScope.order.location = parseInt(location_id);
        
        $scope.next_button_active = true;
        
        console.log($rootScope.order); 
        $rootScope.recalculateCost();
    }
    
    $scope.next = function(){
        
    }
    
    $scope.other_locations = function(){
        nav.pushPage("SearchLocation.html");
    }
    
    $scope.back = function(){
        nav.popPage();
    }
    
});


app.controller("BuySearchLocationCtrl", function($scope, $rootScope, $element){    
    $rootScope.main_title = "Другие локации";
    $scope.next_button_active = false;
    
    
    
    $scope.location_type = 2; // studio
    $scope.closest_subway = -1;
    $scope.keywords = "";
    
    $scope.updateSearchBox = function(callback){
        $.get("buy_api.php?req=get_location_price_edges&type="+$scope.location_type, function(data){
            data = JSON.parse(data);
            console.log(data);
            
            
            if($scope.price_slider != undefined){
                $scope.price_slider.destroy();
            }
            
            $("#b_price_range").ionRangeSlider({
                type: "double",
                max: data.edges.max>0?data.edges.max:100,
                min: data.edges.min,
                onFinish : function (data) {
                    $scope.search();
                }
            });
            
            $scope.price_slider = $("#b_price_range").data("ionRangeSlider");
            
            $.get("buy_api.php?req=get_subways", function(data){
                data = JSON.parse(data);
                $scope.subways = data.subways;
                
                $scope.search();
                
                if ($scope.$root.$$phase != '$apply' && $scope.$root.$$phase != '$digest') {
                    $scope.$apply();
                }
            });
        });
        
        
        
    }
    
    $scope.updateSearchBox();
    
    $scope.setLocationType = function(type){
        $scope.location_type = type;
        $scope.updateSearchBox();
    }
    
    
    
    $scope.search = function(){
        console.log($scope.price_slider.result.from);
        var query = {
                location_type: $scope.location_type,
                closest_subway: $scope.closest_subway,
                keywords: $scope.keywords,
                max_price: $scope.price_slider.result.to,
                min_price: $scope.price_slider.result.from,
            };
        console.log(query);
        $.post("buy_api.php?req=search_locations", {
            query: JSON.stringify(query)                    
        }, function(data){
            data = JSON.parse(data);        
            console.log(data);
            
            $scope.locations = data.locations;

            

            if ($scope.$root.$$phase != '$apply' && $scope.$root.$$phase != '$digest') {
                $scope.$apply();
            }
        });
    }
    
    $scope.select = function(location_id, $event){
        $card = $($event.target).closest(".b_card");
        
        
        $element.find(".b_card").removeClass("selected");       
        $card.addClass("selected");       
        
        $rootScope.order.location = parseInt(location_id);
        
        $scope.next_button_active = true;
        
        console.log($rootScope.order); 
        $rootScope.recalculateCost();
    }
    
    $scope.next = function(){
        
    }
    
    $scope.suggested_locations = function(){
        nav.popPage();
    }
    
    $scope.back = function(){
        nav.popPage();
    }
    
});














