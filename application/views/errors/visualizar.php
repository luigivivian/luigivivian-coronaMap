<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Google maps</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<style>
	#map {
		height: 93%;
	}
	/* Optional: Makes the sample page fill the window. */
	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
		background-color: #bdc3c7;
	}

</style>
<body>

<div class="row container-fluid input-group mt-2 mb-2 menuzin">
	<div class="input-group-prepend">
		<span class="input-group-text" id="">Digite um endereço:</span>
		<input class="form-control" id="endereco" name="endereco" type="text" placeholder="Localização ?" required>
		<input class="form-control" id="end" name="end" type="text" hidden>
	</div>


	<div class="mr-2 ml-2">
		<select class="custom-select" name="cars" id="opcoes">
			<option value="#81ecec" disabled selected>Selecione uma opcao !</option>
			<option value="#0984e3">Dengue</option>
			<option value="#fd79a8">Ebola</option>
			<option value="#d63031">Febre amarela</option>
		</select>
	</div>

	<div class="">
		<input type="button" id="btnEndereco" name="btnEndereco" value="Mostrar no mapa" class="btn btn-success"/>
	</div>



</div>

<div class="container">

	<form id="cadastro"  method="POST" action="<?= base_url('api/mapa')?>">
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" name="nome" class="form-control" id="nome" aria-describedby="nomeHelp" placeholder="Digite seu nome...">
			<small id="nomeHELP" class="form-text text-muted">campo obrigatório</small>
		</div>
		<div class="form-group">
			<label for="sobrenome">Sobrenome</label>
			<input type="text" name="sobrenome" class="form-control" id="sobrenome" aria-describedby="sobrenomeHelp" placeholder="Digite seu sobrenome...">
			<small id="sobrenomeHELP" class="form-text text-muted">campo obrigatório</small>
		</div>

		<div class="form-group">
			<label for="datanascimento">Data de nascimento</label>
			<input type="date" name="datanascimento" class="form-control" id="datanascimento" aria-describedby="datanascimentoHelp">
			<small id="datanascimentoHELP" class="form-text text-muted">campo obrigatório</small>
		</div>

		<div class="form-group">
			<label for="senha">Telefone</label>
			<input type="text"  name="telefone" class="form-control" id="telefone" aria-describedby="telefoneHelp" placeholder="Digite seu telefone">
			<small id="telHELP" class="form-text text-muted">campo obrigatório</small>
		</div>
		<input type="hidden" id="lat" name="lat" value="-28.2587812" required>
		<input type="hidden" id="lng" name="lng" value="-52.416003899999964" required>
	</form>
</div>


<!--mapa-->
<div id="map">
</div>

<div class="row">

	<button type="submit" form="cadastro" class="btn btn-block btn-success">Cadastrar</button>
	<button type="button" class="btn btn-block btn-danger" data-dismiss="modal">Cancelar</button>
</div>
<!--Modall-->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script >
	var geocoder;
	var corPino = '';
	var pinos = new Array();
	var pinQtd = 0;
	var map;
	var address = null;
	function initMap() {
		//local do mapa
		var inicial = {lat: -28.715051, lng: -51.931089};
		//criando mapa
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 15,
			center: inicial
		});
		geocoder = new google.maps.Geocoder();



		//evento de clique no mapa
		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(event.latLng, $('#opcoes').val());
		});
//funcao para adicionar marker no mapa
		function placeMarker(location, cor) {
			var marker = new google.maps.Marker({
				position: location,
				map: map,
				icon: pinSymbol(cor)
			});
			//pegando latitude e longitudo do ponto clicado

			var newPino = new Array();
			newPino[0] = pinQtd;
			newPino[1] = marker.getPosition().lat();
			newPino[2] = marker.getPosition().lng();
			pinos.push(newPino);
			pinQtd++;
			console.log(pinos);
			getEndereco(marker.getPosition().lat(), marker.getPosition().lng());
			$('#lat').val(marker.getPosition().lat());
			$('#lng').val(marker.getPosition().lat());

		}
		//criando icone do pino
		function pinSymbol(color) {
			return {
				path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
				fillColor: color,
				fillOpacity: 1,
				strokeColor: '#000',
				strokeWeight: 2,
				scale: 1
			};
		}
	}
	$(document).ready(function() {
		$('#opcoes').css('border-color',corPino);
		$('#opcoes').css('border-width',3);
		$('#opcoes').change(function() {
			var current = $('#opcoes').val();
			if (current != 'null') {
				corPino = current;
				$('#opcoes').css('border-color',corPino);
				$('#opcoes').css('border-width',3);
			} else {
				corPino = current;
				$('#opcoes').css('border-color',corPino);
				$('#opcoes').css('border-width',3);
			}
		});
	})

	$("#btnEndereco").click(function() {
		if($(this).val() != "")
			carregarNoMapa($("#endereco").val());
	});

	$("#endereco").blur(function() {
		if($(this).val() != "")
			carregarNoMapa($(this).val());
	});
	function carregarNoMapa(endereco)
	{
		geocoder.geocode({ 'address': endereco + ', Brasil', 'region': 'BR' }, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if(results[0]) {
					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();

					$('#endereco').val(results[0].formatted_address);
					$('#lat').val(latitude);
					$('#lng').val(longitude);

					var location = new google.maps.LatLng(latitude, longitude);
					//marker.setPosition(location);
					map.setCenter(location);
					map.setZoom(16);
				}
			}
		});
	}

	$("#endereco").autocomplete({
		source: function (request, response) {
			geocoder.geocode({ 'address': request.term + ', Brasil', 'region': 'BR' }, function (results, status) {
				response($.map(results, function (item) {
					return {
						label: item.formatted_address,
						value: item.formatted_address,
						latitude: item.geometry.location.lat(),
						longitude: item.geometry.location.lng()
					}
				}));
			})
		},
		select: function (event, ui) {
			$("#lat").val(ui.item.latitude);
			$("#lng").val(ui.item.longitude);
			var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
			//marker.setPosition(location);
			map.setCenter(location);
			map.setZoom(16);
		}
	});
	$("#endereco").autocomplete({

		messages: {
			noResults: '',
			results: function() {}
		}
	});


	function getEndereco(latt, longg){
		var lat = latt;
		var long = longg;
		var me = this;
		var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+long+"&sensor=false";
		$.get(url).success(function(data) {
			var loc1 = data.results[0];
			me.teste(loc1);
		});

	}

	function teste(loc){
		$("#end").val(loc["formatted_address"]);
		console.log(loc["formatted_address"]);
		address = loc["formatted_address"];
		alert(loc["formatted_address"]);
	}


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxVfaJlXlVCKTWkpIllZYl4UnV3Z7gNkA&callback=initMap"
		async defer></script>
</body>
</html>
