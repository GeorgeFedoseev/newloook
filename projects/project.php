<?
    session_start();
	header('Content-Type: text/html; charset=UTF-8');
?>

<html>
<head>
	<title> 
		Фотопроект NewLook 
	</title>
	<link rel="stylesheet" type="text/css" href="../css/style_project.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/slider.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function()
	{
		$(".slider").each(function ()
		{
			var obj = $(this);
			$(obj).append("<div class='nav'></div>");

			$(obj).find("li").each(function ()
			{
				$(obj).find(".nav").append("<span rel='"+$(this).index()+"'></span>");
				$(this).addClass("slider"+$(this).index());
			});

			$(obj).find("span").first().addClass("on");
		});
	});

	function sliderJS (obj, sl) // slider function
	{
		var ul = $(sl).find("ul");
		var bl = $(sl).find("li.slider"+obj);
		var step = $(bl).width();
		$(ul).animate({marginLeft: "-"+step*obj}, 500);
	}

	$(document).on("click", ".slider .nav span", function() // slider click navigate
	{
		var sl = $(this).closest(".slider");
		$(sl).find("span").removeClass("on");
		$(this).addClass("on");
		var obj = $(this).attr("rel");
		sliderJS(obj, sl);
		return false;
	});
</script>
</head>
<body>
	<?
		include("../menu.html");
		$label = 'id';
		$id = false;
		if (  !empty( $_GET[ $label ] )  )
			{
			  $id = $_GET[ $label ];
			}
			
		include("../bd.php");
		$request= "SELECT id_project, name_folder, name_project, date_start, date_over, about_project, price, makeup, hairstylist, florist, id_location, color, color_butt, color_butt_txt FROM photoproject WHERE id_project=".$id;
		$result=mysql_query($request);
	
	while($row=mysql_fetch_array($result)){		
			if($row['color']==NULL){ $color='000000';}
				 else($color=$row['color']);
			if($row['color_butt_txt']==NULL) $color_butt_txt='FFFFFF';
				else($color_butt_txt=$row['color_butt_txt']);
			if($row['color_butt']==NULL) $color_butt=$row['color'];
				else($color_butt=$row['color_butt']);
			echo "<img class='top_photo' src='".$row['name_folder']."/top_photo.jpg'>";
			echo "<h1 class='project_h1' style='color:#".$color.";'>Фотопроект <font class='project_p'> ".$row['date_start']."</font></h1>";	
			echo "<h2 class='project_h2' style='color:#".$color.";'>".$row['name_project']."</h2>";
			echo "<img src='../css/white_img.jpg' class='white_photo'>";
			echo "<div class='project_part_2'>";
			echo "<div class='slider'><ul>";
			$slide = $row['name_folder'].'/slide1.jpg';
				if(file_exists($slide)==1) echo "<li><img src='".$row['name_folder']."/slide1.jpg' class='photo_sl' /></li>";
			$slide = $row['name_folder'].'/slide2.jpg';
				if(file_exists($slide)==1) echo "<li><img src='".$row['name_folder']."/slide2.jpg' class='photo_sl' /></li>";
			$slide = $row['name_folder'].'/slide3.jpg';
				if(file_exists($slide)==1) echo "<li><img src='".$row['name_folder']."/slide3.jpg' class='photo_sl' /></li>";
			$slide = $row['name_folder'].'/slide4.jpg';
				if(file_exists($slide)==1) echo "<li><img src='".$row['name_folder']."/slide4.jpg' class='photo_sl'/></li>";
			$slide = $row['name_folder'].'/slide5.jpg';
				if(file_exists($slide)==1) echo "<li><img src='".$row['name_folder']."/slide5.jpg' class='photo_sl' /></li>";
			echo "</ul></div>";
			echo "<div class='project_txt'>";
			echo "<h1 class='project_txt_h1'>Фотопроект '".$row['name_project']."'</h1> ";
			echo "<p>".$row['about_project']."</p>";
			echo "<p><b>Стоимость:</b> ".$row['price']."</p>";
			echo "<p><b>Что входит в стоимость?</b>
					<br>
					-1-2 часа работы фотографа <br>";
			if($row['makeup']=='1') echo ("-Работа визажиста <br>");
			if($row['hairstylist']=='1') echo("-Работа стилиста <br>");
			if($row['florist']=='1') echo ("-Работа флориста <br>");				
			echo "</p>";
			echo "<p><b>Когда будет проходить? </b><br>";
			echo "Проходить будет: ".$row['date_start']."</p>";
			echo "<p><b>Где будет проходить?  </b><br>";
			echo "Место проведения: ".$row['id_location']."</p><br>";
			echo "<input type='submit' class='project_button' style='color: #".$color_butt_txt."; background-color:#".$color_butt."' value='Записаться'>";
			echo "</div></div>";
	}
	
?>
</body>
</html>