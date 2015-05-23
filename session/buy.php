<html>
<head>
<title> 
		Фотопроект NewLook 
	</title>
	<link rel="stylesheet" type="text/css" href="../css/style_project.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/buy.css">
    
    <link rel="stylesheet" href="/lib/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="/lib/ion.rangeSlider-2.0.6/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="/lib/ion.rangeSlider-2.0.6/css/ion.rangeSlider.skinFlat.css">
    
    <script src="/css/js/jquery.js"></script>
    <script src="/lib/onsenui/js/angular/angular.min.js"></script>
    <script src="/lib/onsenui/js/onsenui.js"></script>
    
    <script src="/lib/ion.rangeSlider-2.0.6/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
    
    
    <script src="buy.js"></script>
    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
</head>
    <body ng-app="buy">
        <? 
        include('../menu.html'); 
        include("../bd.php");
        ?>
        
        <ons-page class="b_main_page"  ng-controller="MainCtrl">
            <div class="b_main">
                <div class="b_header">
                    <h2>{{main_title}}</h2>
                    <div class="b_cart">
                        <i class="b_cart_icon fa fa-shopping-cart"></i>
                        <div class="b_cart_cost">{{total_cost}}</div>
                    </div>
                </div>
                <ons-navigator class="b_nav" var="nav" animation="fade">                
                </ons-navigator> 

            </div>
        </ons-page>
        
        
        <ons-template id="Type.html">
            <ons-page ng-controller="BuyTypeCtrl">
                <div class="b_session_types b_page">
                    <div class="b_card" ng-click="select('individual', $event)">
                        <div class="b_card_pic"
                             style="background-image:url(assets/images/session_types/individual.jpg);"                             
                             ></div>
                        <div class="b_card_title">Для одного</div>                    
                    </div>
                    <div class="b_card" ng-click="select('several', $event)">
                        <div class="b_card_pic"
                             style="background-image:url(assets/images/session_types/several.jpg);"                             
                             ></div>
                        <div class="b_card_title">Для нескольких</div>                    
                    </div>
                    <div class="b_card" ng-click="select('lovestory', $event)">
                        <div class="b_card_pic"
                             style="background-image:url(assets/images/session_types/lovestory.jpg);"
                             ></div>
                        <div class="b_card_title">Love story</div>                    
                    </div>
                    <div class="b_card" ng-click="select('family', $event)">
                        <div class="b_card_pic"
                             style="background-image:url(assets/images/session_types/family.jpg);"                             
                             ></div>
                        <div class="b_card_title">Семейная</div>                    
                    </div>
                    
                    <div class="b_select_people_number" ng-hide="!showSelectPeopleNumber">
                        <h3>Укажите количество человек</h3>
                        <div class="b_controls">
                            <button ng-click="decr_people_num()"><i class="fa fa-minus"></i></button>
                            <div class="b_people_number">{{order.people_number}}</div>
                            <button ng-click="incr_people_num()"><i class="fa fa-plus"></i></button>

                        </div>
                    </div>

                    <div class="b_buttons">                    
                        <button class="b_right centered b_nav_button"
                                ng-class="{disabled: !next_button_active}"
                                ng-click="next()">Далее</button>
                    </div>

                </div>    
                
                
            </ons-page>            
        </ons-template>
        
        
        <ons-template id="Style.html">
            <ons-page ng-controller="BuyStyleCtrl">
                <div class="b_styles b_page">
                    <div class="b_card" 
                         ng-repeat="style in styles"
                         ng-click="select(style.id, $event)"
                         >
                        <div class="b_card_title">{{style.name}}</div>
                        <div class="b_card_pic"
                             style="background-image:url(assets/images/session_styles/{{$index+1}}.jpg);"                             
                             ></div>
                        <div class="b_card_desc">{{style.description}}</div>                    
                    </div>
                    
                    <div class="b_buttons">                    
                        <button class="b_left b_nav_button"                                
                                ng-click="back()">Назад</button>
                        <button class="b_right b_nav_button"
                                ng-class="{disabled: !next_button_active}"
                                ng-click="next()">Далее</button>
                    </div>
                </div>
            </ons-page>
        </ons-template>
        
        
        <ons-template id="Location.html">
            <ons-page ng-controller="BuyLocationCtrl">
                <div class="b_location b_page">
                    <div class="b_card" 
                         ng-repeat="location in locations"
                         ng-click="select(location.id_location, $event)"
                         >
                        <div class="b_card_title">{{location.name}}</div>
                        <div class="b_card_pic"
                             style="background-image:url(assets/images/locations/{{location.id_location}}.jpg);"
                             ></div>
                        <div class="b_card_desc"><span>{{location.comment}}</span></div>                    
                    </div>
                    
                    <div class="b_buttons">                    
                        <button class="b_left b_nav_button"                                
                                ng-click="back()">Назад</button>
                        <button class="b_nav_button centered"                                
                                ng-click="other_locations()">Другие локации</button>
                        <button class="b_right b_nav_button"
                                ng-class="{disabled: !next_button_active}"
                                ng-click="next()">Далее</button>
                    </div>
                </div>
            </ons-page>
        </ons-template>
        
        <ons-template id="SearchLocation.html">
            <ons-page ng-controller="BuySearchLocationCtrl">
                <div class="b_search_location b_page">
                    <div class="b_search_select_type">
                        <button class="b_left b_nav_button"                                
                                ng-click="setLocationType(2)"
                                ng-class="{selected: location_type==2}">Фотостудии</button>
                        <button class="b_right b_nav_button"                                
                                ng-click="setLocationType(1)"
                                ng-class="{selected: location_type==1}">Другие локаций</button>
                    </div>
                    
                    <div style="clear: both"></div>
                    
                    <div class="b_search_container">
                        <div class="b_search_left">
                            <div class="b_searchbox">
                                <h3>Поиск</h3>
                                <div class="label">Цена за час</div>
                                <input type="text" id="b_price_range"  value="" />
                                <div class="label">Ближайшее метро</div>
                                <select ng-model="closest_subway" ng-change="search()">
                                    <option selected value="-1">Любое</option>
                                    <option ng-repeat="subway in subways" value="{{subway.id_subway}}">{{subway.name_subway}}</option>
                                </select>
                                <div class="label">Ключевые слова</div>
                                <textarea noresize ng-model="keywords" ng-change="search()">
                                </textarea>
                            </div>  
                            
                            <div class="b_notice">
                            </div>
                        </div>
                        
                        
                        <div class="b_search_results">
                            <div class="b_card" 
                                 ng-repeat="location in locations"
                                 ng-click="select(location.id_location, $event)"
                                 >
                                <div class="b_card_title">{{location.name}}</div>
                                <div class="b_card_pic"
                                     style="background-image:url(assets/images/locations/{{location.id_location}}.jpg);"
                                     ></div>
                                <div class="b_card_desc"><span>{{location.comment}}</span></div>                    
                            </div>
                            <h2 ng-show="locations.length==0">Нет результатов</h2>
                        </div>
                        
                    </div>
                    
                    <div style="clear: both"></div>
                    
                    
                    
                    <div class="b_buttons">                    
                        <button class="b_left b_nav_button"                                
                                ng-click="back()">Назад</button>
                        <button class="b_nav_button centered"                                
                                ng-click="suggested_locations()">Подборка локаций</button>
                        <button class="b_right b_nav_button"
                                ng-class="{disabled: !next_button_active}"
                                ng-click="next()">Далее</button>
                    </div>
                </div>
            </ons-page>
        </ons-template>
        
        
    </body> 
    
    
</html>