<?php
	function return_img($con){
		$con = explode(":",$con);
		$con = $con[1];
		$con = str_replace(" ","",$con);
		switch($con){
			case "Clear";
			$img = "img/fair.png";
			break;
			
			case "PartlyCloudy";
			$img = "img/pcloudy.png";
			break;

			case "MostlyCloudy";
			$img = "img/cloudy.png";
			break;
			
			case "Haze";
			$img = "img/fog.png";
			break;
			
			case "ScatteredClouds";
			$img = "img/cloudy.png";
			break;
			
			case "Mist";
			$img = "img/fog.png";
			break;
			
			case "Fog";
			$img = "img/fog.png";
			break;
			
			case "Overcast";
			$img = "img/cloudy.png";
			break;
			
			case "LightSnow";
			$img = "img/flurries.png";
			break;
			
			case "LightSnowShowers";
			$img = "img/rainsnow.png";
			break;
			
			case "LightSnowMist";
			$img = "img/fog.png";
			break;
			
			case "HeavySnow";
			$img = "img/snowshow.png";
			break;
			
			case "HeavySnowMist";
			$img = "img/snowshow.png";
			break;
			
			case "LightSnowMist";
			$img = "img/flurries.png";
			break;
			
			case "SnowMist";
			$img = "img/snowshow.png";
			break;
			
			case "LightSnow";
			$img = "img/flurries.png";
			break;
			
			case "FreezingFog";
			$img = "img/fog.png";
			break;
			
			case "LightRainSnow";
			$img = "img/rainsnow.png";
			break;
			
			case "Rain";
			$img = "img/lshowers.png";
			break;
			
			case "ShallowFog";
			$img = "img/fog.png";
			break;
			
			case "PatchesFogMist";
			$img = "img/fog.png";
			break;
			
			case "IceCrystals";
			$img = "img/flurries.png";
			break;
			
			case "HeavyRainShowers";
			$img = "img/lshowers.png";
			break;
			
			case "FunnelCloud";
			$img = "img/cloudy.png";
			break;
			
			default :
			$img = "img/unknown.png";
			break;
		}
		return $img ;
	}
	function chkweather($label=true,$lang='fa',$dama=0,$rotubat=0,$feshar=0,$jahat_bad=0,$sorat_bad=0){
		global $mt ;
		if(!empty($_GET[xml])){
			$src = file_get_contents($_GET[xml]);
			preg_match_all('@<description[^>]*?>.*?</description>@siu',  $src , $matches );
			$mt = $matches[0][1] ;
			if(!empty($mt)){
				$mt=str_replace("<description><![CDATA[","",$mt);
				$mt=str_replace("]]></description>","",$mt);
				$mt = explode("<img",$mt);
				$mt = $mt[0];

				if($label){
					if($lang=='fa'){
						$mt = str_replace("Temperature","دمای کنونی",$mt);
						$mt = str_replace("Humidity","رطوبت هوا",$mt);
						$mt = str_replace("Wind Direction","جهت باد",$mt);
						$mt = str_replace("Wind Speed","سرعت باد",$mt);
						$mt = str_replace("Pressure","فشار هوا",$mt);
						$mt = str_replace("(Steady)","(ثابت)",$mt);
					}
				}else{
					$mt = str_replace("Temperature","",$mt);
					$mt = str_replace("Humidity:","",$mt);
					$mt = str_replace("Wind Direction:","",$mt);
					$mt = str_replace("Wind Speed:","",$mt);
					$mt = str_replace("Pressure:","ا",$mt);
					$mt = str_replace("(Steady)","",$mt);
				}
				$mt = explode("|",$mt);
				$mt[0]=explode("/",$mt[0]);
				$mt[0] = ($label ? "دمای کنونی: ".$mt[0][1] : $mt[0][1]);

				$html=show_info($dama,$rotubat,$feshar,$jahat_bad,$sorat_bad);
			}else	$html.="اطلاعاتی در دست نمی باشد." ;
		}else	$html.="اطلاعاتی در دست نمی باشد.";
		return $html ;
	}
	function show_info($dama,$rotubat,$feshar,$jahat_bad,$sorat_bad){
		global $mt ;
		$img=return_img( $mt[3]);
		$html.="<table align='center' style='width:100%;' dir='rtl'>
		<tr>
			<td id='img'>
				<img src=".$img." align='middle' />
			</td>
		</tr>";
		if($dama)		$html.="<tr><td>".$mt[0]."</td></tr>";// dama
		if($rotubat)	$html.="<tr><td>".$mt[1]."</td></tr>";// rotubat
		if($feshar)		$html.="<tr><td>".$mt[2]."</td></tr>";// feshar hava
		if($jahat_bad)	$html.="<tr><td>".$mt[4]."</td></tr>";// jahat bad
		if($sorat_bad)	$html.="<tr><td>".$mt[5]."</td></tr>";// sor@ bad
		$html.="</table>" ;
		return $html ;
	}

//chkweather function 
echo chkweather(true,'fa',1,1,1,1,1);
?>

 