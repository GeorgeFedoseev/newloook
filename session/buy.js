var app = angular.module('buy', ['onsen']); 


app.directive('unbindable', function(){
    return { scope: true };
});

app.controller("MainCtrl", function($scope, $rootScope){    
   setTimeout(function(){
       nav.pushPage("Type.html");  
   }, 500);
   
    $rootScope.order = {
        type: "individual",
        people_number: 1,
        style: 9,
        location: 2,
        stylist: 0,
        visagist: 0,
        florist: 0,
        date: "2015-05-25",
        time: "9:00",
        hours: 1,
        name: "",
        tel: ""
        
    };
    
    $rootScope.ruType = {
        "individual": "Индивидуальная",
        "several": "Несколько человек",
        "lovestory": "Love story",
        "family": "Семейная"
    };
    
    $rootScope.ruStyle = [
        "Портрет",
        "Гламур",
        "Fashion",
        "Casual",
        "Pin up",
        "Ретро",
        "Треш",
        "Рок",
        "Не задан"
    ];
    
    $rootScope.selectedLocationRu = "Las Vegas";
    
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
            
            console.log(data.cost);
            $rootScope.cost = data.cost;
            $rootScope.total_cost = data.cost.total;
            
            if ($scope.$root.$$phase != '$apply' && $scope.$root.$$phase != '$digest') {
                $scope.$apply();
            }
        });
    }
    
    
    $(".b_cart").webuiPopover({
        title:'Корзина',
        placement: 'bottom-left',
        width: 400
    });
    
    $scope.showCartContents = function(){
        $(".webui-popover-content").html($("#cart_popover_content").html());        
        if(!$rootScope.cost){
            $(".b_cart").webuiPopover("hide");
        }
    }
});

app.controller("BuyTypeCtrl", function($scope, $rootScope, $element){    
    nav.on("postpop", function(){        
        if(nav.getCurrentPage().name == "Type.html"){
            $rootScope.main_title = "Выберите тип фотосессии";                
            $scope.$apply();                        
        }
    });
    
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
    
    nav.on("postpop", function(){        
        if(nav.getCurrentPage().name == "Style.html"){
            $rootScope.main_title = "Выберите стиль фотосессии";                
            $scope.$apply();                        
        }
    });
    
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
    nav.on("postpop", function(){        
        if(nav.getCurrentPage().name == "Location.html"){
            $rootScope.main_title = "Выберите локацию";                
            $scope.$apply();
                        
        }
    });
    
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
    
    $scope.select = function(location_id, $event, locationRu){
        $card = $($event.target).closest(".b_card");
        
        
        $element.find(".b_card").removeClass("selected");       
        $card.addClass("selected");       
        
        $rootScope.order.location = parseInt(location_id);
        $rootScope.selectedLocationRu = locationRu;
        $scope.next_button_active = true;
        
        console.log($rootScope.order); 
        $rootScope.recalculateCost();
    }
    
    $scope.next = function(){
        nav.pushPage("AdditionalServices.html");
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
    nav.on("postpop", function(){        
        if(nav.getCurrentPage().name == "SearchLocation.html"){
            $rootScope.main_title = "Другие локации";                
            $scope.$apply();
        }
    });
    
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
    
    $scope.select = function(location_id, $event, locationRu){
        $card = $($event.target).closest(".b_card");
        
        
        $element.find(".b_card").removeClass("selected");       
        $card.addClass("selected");       
        
        $rootScope.order.location = parseInt(location_id);
        $rootScope.selectedLocationRu = locationRu;
        $scope.next_button_active = true;
        
        console.log($rootScope.order); 
        $rootScope.recalculateCost();
    }
    
    $scope.next = function(){
        nav.pushPage("AdditionalServices.html");
    }
    
    $scope.suggested_locations = function(){
        nav.popPage();
    }
    
    $scope.back = function(){
        nav.popPage();
    }
    
});

app.controller("BuyAdditionalServicesCtrl", function($scope, $rootScope, $element){    
    $rootScope.main_title = "Выберите дополнительные услуги";
    nav.on("postpop", function(){        
        if(nav.getCurrentPage().name == "AdditionalServices.html"){
            $rootScope.main_title = "Выберите дополнительные услуги";                
            $scope.$apply();
        }
    });
    
    $scope.next_button_active = true;
    
    $scope.incr_visagist = function(){
        $rootScope.order.visagist++;
        $rootScope.recalculateCost();
    }
    
    $scope.decr_visagist = function(){
        if($rootScope.order.visagist > 0){
            $rootScope.order.visagist--;            
        }        
        $rootScope.recalculateCost();
    }
    
    $scope.incr_stylist = function(){
        $rootScope.order.stylist++;
        $rootScope.recalculateCost();
    }
    
    $scope.decr_stylist = function(){
        if($rootScope.order.stylist > 0){
            $rootScope.order.stylist--;            
        }
        
        $rootScope.recalculateCost();
    }
    
    $scope.next = function(){
        nav.pushPage("Time.html");
    }

    
    $scope.back = function(){
        nav.popPage();
    }
});

app.controller("BuyTimeCtrl", function($scope, $rootScope, $element){    
    $rootScope.main_title = "Выберите удобное время";
    nav.on("postpop", function(){        
        if(nav.getCurrentPage().name == "Time.html"){
            $rootScope.main_title = "Выберите удобное время";                
            $scope.$apply();
                        
        }
    });
    
    nav.on("postpush", function(){
        if(nav.getCurrentPage().name == "Time.html"){
            $('#fullcalendar').fullCalendar('render');
        }
    });
    
    $scope.next_button_active = false;    
    
    var userCreatedEvent = [];
    
    
    $('#fullcalendar').fullCalendar({
        height: 450,
        lang: "ru",
        timeFormat: 'H(:mm)',
        axisFormat: "H:mm",
        editable: false,
        allDaySlot: false,
        columnFormat: "ddd D MMM",
        defaultView: "agendaWeek",
        snapDuration: '01:00:00',
        slotEventOverlap: false,
        eventColor: '#ff5d5d',
        
        googleCalendarApiKey: 'AIzaSyBpRA0TVvVzxUyNQUFchpklIAgYcBEFWy8',
        eventSources: [{
             googleCalendarId: 'vljoi4qf5id2d8l03te1km7fd4@group.calendar.google.com', 
             eventDataTransform : function(event){
                 console.log("transform event");
                 console.log(event);
                 
                 event.start = moment(event.start).parseZone();
                 event.end = moment(event.end).parseZone();
                 
                 event.start = event.start.add(-event.start.zone(), 'minutes').zone(0);
                 event.end = event.end.add(-event.end.zone(), 'minutes').zone(0);
                 
                 console.log(event.start.zone());
                 
                 return {
                    title: "Забронировано",
                    own: false,
                    start: event.start,
                    end: event.end
                 };
             }
        }],


        selectConstraint: {
            start: '00:00', 
            end: '24:00'
        },
        
        selectable: true,
        selectOverlap: false,
        select: function(start, end, jsEvent, view) {

            var hours = moment(end).diff(moment(start), 'hours');            

            var currentEvents = $('#fullcalendar').fullCalendar('clientEvents');    
            console.log("Current events");
            console.log(currentEvents);
            console.log(start);
            console.log(end);
            for(var k in currentEvents){
                var event = currentEvents[k];                
                
                if(!event.own){
                    console.log(end.format());
                    console.log(event.start.format());
                    console.log(moment(event.start).diff(moment(end), 'hours'));
                    var diff_to_event_start = moment(event.start).diff(moment(end), 'hours');                    
                    if(diff_to_event_start >= 0 && diff_to_event_start < 1){
                        alert("Это время слишком близко к занятому времени");
                        $('#fullcalendar').fullCalendar('unselect')
                        return;
                    }

                    var diff_to_event_end = moment(start).diff(moment(event.end), 'hours');
                    if(diff_to_event_end >= 0 && diff_to_event_end < 1){
                        alert("Это время слишком близко к занятому времени");
                        $('#fullcalendar').fullCalendar('unselect')
                        return;
                    }  
                }                
                  
            }
            
            var diff_to_now = moment(start).diff(moment(new Date()), 'weeks');
            console.log("weeks to event: "+diff_to_now);
            if(diff_to_now > 3){
                alert("Пожалуйста, выберите дату не далее 3х недель от сегодяшней.");
                $('#fullcalendar').fullCalendar('unselect')
                return;
            }  
            
            var diff_to_now_days = moment(start).diff(moment(new Date()).startOf("day"), 'days');
            console.log("days to event: "+diff_to_now_days);
            if(diff_to_now_days < 1){
                alert("Пожалуйста, выберите дату, начиная с завтрашнего дня.");
                $('#fullcalendar').fullCalendar('unselect')
                return;
            }


            if(userCreatedEvent.length != 0){
                $('#fullcalendar').fullCalendar('removeEventSource', userCreatedEvent);
            }

            userCreatedEvent = [
                {
                    title: 'Ваша фотосессия',
                    own: true,
                    start: start,
                    end: end,
                    color: '#006bba'
                }
            ];

            $rootScope.order.date = start.format('YYYY-MM-DD');
            $rootScope.order.time = start.format("H:mm");
            $rootScope.order.hours = hours;

            console.log($rootScope.order);

            $('#fullcalendar').fullCalendar('addEventSource', userCreatedEvent);

            $scope.next_button_active = true; 

            $rootScope.recalculateCost();

             if ($scope.$root.$$phase != '$apply' && $scope.$root.$$phase != '$digest') {
                $scope.$apply();
            }
        }       
    }); // fullcalendar

    /*$.get("buy_api.php?req=events", function(data){
        data = JSON.parse(data);
        var fc_events = [];
        for(var k in data.events){
            var event = data.events[k];
            var start = moment(event.date_order).add(moment.duration(event.time_order)).zone(0);
            var end = start.clone().add(event.amount_hours, 'hours').zone(0);

            console.log("ADD EVENT: "+start.format()+" - "+end.format());
            fc_events.push({
                title: "Забронировано",
                own: false,
                start: start,
                end: end
            });
        }

        $('#fullcalendar').fullCalendar('addEventSource', fc_events);

        console.log(data);
    });*/
    
    
    $scope.next = function(){
        nav.pushPage("NameTel.html");
    }    
    
    $scope.back = function(){
        nav.popPage();
    }
    
});


app.controller("BuyNameTelCtrl", function($scope, $rootScope, $element){    
    $rootScope.main_title = "Введите Ваши данные";
    
    nav.on("postpop", function(){        
        if(nav.getCurrentPage().name == "NameTel.html"){
            $rootScope.main_title = "Введите Ваши данные";                
            $scope.$apply();                        
        }
    });
    
    $scope.next_button_active = false;
    
    
    
    $scope.change = function(){
        $scope.next_button_active = false;
        $scope.goodName = false;
        $scope.goodNumber = false;
        
        if($rootScope.order.tel != undefined){
            if($rootScope.order.tel.match(/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/)){
                $scope.wrongNumber = false;
                console.log("good number");   
                if($rootScope.order.tel.length >= 7){
                    $scope.goodNumber = true;
                }
            }else{
                $scope.wrongNumber = true;
                console.log("wrong number");                
            }
        }
        
        
        if($rootScope.order.name != undefined){
            if($rootScope.order.name.match(/^[А-яA-z\s]+$/)){
                $scope.wrongName = false;
                console.log("good name");
                if($rootScope.order.name.length > 3){
                    $scope.goodName = true;
                }
            }else{
                $scope.wrongName = true;
                console.log("wrong name");                 
            }
        }
        
        
        
        if($rootScope.order.name
           && $rootScope.order.tel
           && $rootScope.order.name.length > 3
           && $rootScope.order.tel.length >= 7
           && !$scope.wrongName && !$scope.wrongNumber){
            $scope.next_button_active = true;
        }
        
        
        
        if ($scope.$root.$$phase != '$apply' && $scope.$root.$$phase != '$digest') {
            $scope.$apply();
        }
    }
    
    $scope.next = function(){
        nav.pushPage("Check.html");
    }
    
    $scope.back = function(){
        nav.popPage();
    }
    
});

app.controller("BuyCheckCtrl", function($scope, $rootScope, $element){    
    $rootScope.main_title = "Проверьте выбранные данные";
    
    nav.on("postpop", function(){        
        if(nav.getCurrentPage().name == "Check.html"){
            $rootScope.main_title = "Проверьте выбранные данные";                
            $scope.$apply();                        
        }
    });
    
    $rootScope.recalculateCost();
    
    $scope.dateFormatted = moment($rootScope.order.date).format("D.MM.YYYY");
    console.log($scope.dateFormatted);
    
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
    
    $scope.incr_visagist = function(){
        $rootScope.order.visagist++;
        $rootScope.recalculateCost();
    }
    
    $scope.decr_visagist = function(){
        if($rootScope.order.visagist > 0){
            $rootScope.order.visagist--;            
        }        
        $rootScope.recalculateCost();
    }
    
    $scope.incr_stylist = function(){
        $rootScope.order.stylist++;
        $rootScope.recalculateCost();
    }
    
    $scope.decr_stylist = function(){
        if($rootScope.order.stylist > 0){
            $rootScope.order.stylist--;            
        }
        
        $rootScope.recalculateCost();
    }
    
    $scope.incr_hours = function(){
        $rootScope.order.hours++;
        $rootScope.recalculateCost();
    }
    
    $scope.decr_hours = function(){
        if($rootScope.order.hours > 1){
            $rootScope.order.hours--;            
        }
        
        $rootScope.recalculateCost();
    }

    $scope.back = function(){
        nav.popPage();
    }
    
    $scope.done = function(){
        $.post("buy_api.php?req=add_order", {
            order: JSON.stringify($rootScope.order)
        }, function(data){
            data = JSON.parse(data);
            console.log(data);
            
            if(!data.error){
                nav.resetToPage("Done.html");
            }
        });
    }

});


app.controller("BuyDoneCtrl", function($scope, $rootScope, $element){    
    $rootScope.main_title = "Готово!";
    
    $(".b_cart").hide();
    
    $scope.toMainPage = function(){
        location.href = "/"
    }
    
});










