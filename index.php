<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/index.css" />
		<title>Météo</title>
	</head>

	<body>
		<header>
			<h1>La météo en direct</h1>
			<input type="text" name="ville" id="ville" placeholder="Rechercher par ville" />
			<button id="submit">Rechercher</button>
		</header>

		<div id="corp_texte">
			<div id="result" style="display: none">
				<div id="icon">
				</div>
				<div id="under" class="toMove">
				</div>
				<div id="town_name" class="toMove">
				</div>
				<div id="temp" class="toMove">
				</div>
				<div id="main" class="toMove">
					<div id="min">
					</div>
					<div id="max">
					</div>
				</div>
				<div id="descript" class="toMove">
				</div>
				<div id="other">
					<div class="other toMove">
						<div id="sunrise">
						</div>
						<div id="sunset">
						</div>
					</div>
					<div class="other toMove">
						<div id="pressure">
						</div>
						<div id="humidity">
						</div>
					</div>
					<div class="other toMove">
						<div id="wind_speed">
						</div>
						<div id="feels_like">
						</div>
					</div>
					<div class="other toMove">
						<div id="visibility">
						</div>
						<div id="date">
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			
			var submit = document.getElementById('submit');

			submit.addEventListener('click', getWeather);

			var div = document.getElementById('result');
			var town = document.getElementById('town_name');
			var temp = document.getElementById('temp');
			var min = document.getElementById('min');
			var max = document.getElementById('max');
			var descript = document.getElementById('descript');
			var sunrise = document.getElementById('sunrise');
			var sunset = document.getElementById('sunset');
			var pressure = document.getElementById('pressure');
			var humidity = document.getElementById('humidity');
			var wind = document.getElementById('wind_speed');
			var feels = document.getElementById('feels_like');
			var visibility = document.getElementById('visibility');
			var date = document.getElementById('date');
			var icon = document.getElementById('icon');
			var under = document.getElementById('under');
			var request;

			

			var request = new XMLHttpRequest();

			function getWeather(event)
				{
					event.preventDefault();
					var ville = document.getElementById('ville').value;
					var requestURL = 'http://api.openweathermap.org/data/2.5/weather?q='+ ville +'&lang=fr&units=metric&APPID=0daa73693633a36ca4d67071e6c5ef84';
					request.open('GET', requestURL);
					request.responseType = 'json';
					request.send();

					request.onload = function() {

					div.style.display = "flex";
					var result = request.response;
					var hour = <?php print date('H'); ?> + 2;
					var dt = hour + ':<?php print date('i:s');?>';//heure de chargement au format hh:mm:ss
					var speed = result['wind']['speed'] * 3.6;
					
					

					town.innerHTML = 'la météo de <strong>' + result['name'] + '</strong> à ' + dt;

					under.innerHTML = result['weather']['0']['description'];

					temp.innerHTML = '<u><i>Température actuelle</i></u> : ' + Math.floor(result['main']['temp']) + '°C';

					min.innerHTML = '<u><i>Min</i></u> : ' + Math.floor(result['main']['temp_min']) + '°C';

					max.innerHTML = '<u><i>Max</i></u> : ' + Math.floor(result['main']['temp_max']) + '°C';

					descript.innerHTML = "<u><i>Aujourd'hui</i></u> : "+result['weather']['0']['description']+" avec une température ressenti de " + Math.floor(result['main']['feels_like']) + "°C, un minimum prevu de " + Math.floor(result['main']['temp_min']) + "°C, et un maximal de " + Math.floor(result['main']['temp_max']) + "°C.";

					pressure.innerHTML = '<u><i>Pression</i></u> : ' + result['main']['pressure'] + '<i>hPA</i>';

					humidity.innerHTML = '<u><i>Humidité</i></u> : ' + result['main']['humidity'] + '%';

					wind.innerHTML = '<u><i>Vitesse vent</i></u> : ' + Math.floor(speed) + ' <i>Km/H</i>';

					feels.innerHTML = '<u><i>Température ressentie</i></u> : ' + Math.floor(result['main']['feels_like']) + '°C';

					visibility.innerHTML = '<u><i>Visibilité</i></u> : ' + result['visibility']/1000 + '<i>Km</i>';

					if (result['weather']['0']['description'] == 'ciel dégagé' || result['weather']['0']['description'].match('soleil'))
						{	
							icon.innerHTML = '<?php include('icon/soleil.php'); ?>';
						}

					else if (result['weather']['0']['description'].match('pluie'))
						{	
							icon.innerHTML = '<?php include('icon/pluie.php'); ?>';
						}

					else if (result['weather']['0']['description'].match('orage'))
						{	
							icon.innerHTML = '<?php include('icon/tempete.php'); ?>';
						}

					else if (result['weather']['0']['description'].match('nuage'))
						{	
							icon.innerHTML = '<?php include('icon/nuageux.php'); ?>';
						}

					else if (result['weather']['0']['description'].match('couvert'))
						{	
							icon.innerHTML = '<?php include('icon/couvert.php'); ?>';
						}

					else if (result['weather']['0']['description'].match('neige'))
						{	
							icon.innerHTML = '<?php include('icon/neige.php'); ?>';
						}


					}


				}

		</script>
	</body>