<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled 1</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<style>
		div#weather{
	border:1px #999999 solid;
	padding:10px;
	text-align:center;
	width:100%;
	margin-right:auto;
	margin-left:auto
}
	body{
	text-align:center;font-family:Tahoma;font-size:12px;
}	
	a{
	color:#993333;
	text-decoration:none
}
	a:hover{
	color:#990033
}
	</style>

	<script>
	$(document).ready(function(){	
		//$xml for mashhad: http://rss.wunderground.com/auto/rss_full/global/stations/40745.xml
		$("#weather").load("weather.php?xml=http://rss.wunderground.com/auto/rss_full/global/stations/40745.xml");
		$(".optcity").live('change',function(){			
			xml = $(this).attr('value');			
			changecity(xml);		
		})
	})
		function changecity(xml){
			$("#weather").html('<img src="img/loading.gif"/>');
			$("#weather").load("weather.php?xml="+xml);
		}
	</script>
<link rel="stylesheet" type="text/css" href="samplecss.css" />
</head>

<body>
	<div style="width:200px;margin-right:auto;margin-left:auto">
	
		<div id="weather">
			<img src="img/loading.gif"/>
		</div>
		<select style="width:200px;" class='optcity'> 
		<?php 
		
			$cit = file_get_contents("cities.txt");
			$cot = explode("\n",$cit);
			foreach($cot as $city){				
				$city = explode(":",$city);
				$name = $city[0];
				$xml = $city[1].":".$city[2];

				//$xml dar cod haye js bala estefade mishavad,agar $xml ra baraye shahre digari mikhahid ba cod zir $xml marbut b shahre morede nazar khod ra daryaft konid v dar js az an estefade konid.
				// dikte name shahr (masalan mashhad ya mashad) ra ba file cities.txt check konid
				/*if($name=='mashhad'){
					$xml = $city[1].":".$city[2];	
					echo $xml ;
				}*/
				?>
					<option id="city" value="<?php echo $xml ;?>"> <?php echo $name ;?></option>
				<?php			
			}
			echo $m;	
		?>
		</select> 
		</div>
</body>

</html>
