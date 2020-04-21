<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?= base_url('assets/imgs/favicon.ico');?>" type="image/x-icon">
	<title>INICIO</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('/assets/css/vendors.bundle.css');?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/app.bundle.css');?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/fontawesome-all.css');?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/fa-solid.css');?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/toastr/toastr.css');?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/toastr/toastr.css.map');?>">
</head>
<style>

	#map {
		height: 98vmin;
		width: 100%;
	}
	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
		background-color: #bdc3c7;
	}
	#conteudo{ position: relative; }
	#boxMenu {
		position: absolute; top: 1.4%; left: 65%; z-index: 99;
		background-color: #f8f9fa;
		height: auto;
        width: 30%;
        border: 1px solid #D0D0D0;
        transition: all .5s linear;
	}
	#optionsBox{
		position: absolute; bottom: 2%; z-index: 99;
        background: transparent;
	}
	#itensBox{
		background-color: transparent;
	}
	#condicao{
		width: 80%;
	}

</style>
<body>



<div class="container-fluid" id="conteudo">
	<!--mapa-->

    <?php if($is_mobile == false): ?>

        <div id="map">
        </div>
	<div id="boxMenu" class="text-center">
        <div id="boxContent">
            <h3>Selecione uma condição:</h3>
            <div>
                <select class="form-control ml-xl-5" id="condicao">
                    <option value="0" selected>Todas as condições</option>
                </select>
            </div>
            <div class="legendasDoencas text-left ml-xl-2 mt-2">
                <?php
                $cont = 0;
                ?>
                <div class="row">
                    <?php if(!empty($condicoes)):?>
                        <?php foreach($condicoes as $c){ ?>
                            <div class="col col-sm-6">
                                <p style="font-size: 15px;"><b><i class="fas fa-virus" style="color: <?= $c['cor']?>"></i>  <?=$c['nome']?></b></p>
                            </div>
                        <?php  }?>
                    <?php else:?>
                        <div class="ml-3">
                            <p style="font-size: 15px;"><i class="fa fa-circle" style="color: black"></i>Nenhuma condição cadastrada</p>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <div>
            <?php if($this->session->userdata('adm') == 1){?>
                    <h5><b>Menu</b></h5>
                    <a class="btn btn-outline-primary mt-2 mb-2" href="<?= base_url('paciente/editar');?>">Admin área</a>
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#relatorios">
                        Relatórios
                    </button>

            <?php } ?>
                <a class="btn btn-outline-danger" href="<?= base_url('usuario/logout')?>">Logout</a>

            </div>
        </div>
        <div id="boxControl">
            <button type="button" class="btn btn-outline-dark" onclick="toggleBox('hide')"><i class="fa fa-arrow-up"></i></button>
        </div>
	</div>


	<div class="row mt-2" id="optionsBox">
		<div class="col"></div>
		<div class="col-md-8" id="itensBox">
			<div class="input-group-prepend">
				<label class="input-group-text">Digite um endereço:</label>
				<input class="form-control tags" style="width: 40vmax;" id="endereco" name="endereco" type="text" placeholder="Ex: Av. Arthur Oscar - Centro, Serafina Corrêa" required>
				<input class="form-control" id="end" name="end" type="text" hidden>
				<button type="button" id="btnEndereco" style="width: 40vmax;" class="btn btn-success ml-xl-2"/>Mostrar no mapa</button>
			</div>

			<div class="mt-2">
				<a href="<?= base_url('inicio/cadastrar'); ?>" class="btn btn-block btn-primary">
					Cadastrar Paciente
				</a>
			</div>

		</div>
		<div class="col"></div>
	</div>

    <?php else: ?>
        <div id="map" style="width: 100%; min-height: 95vh">
        </div>
        <div class="row ml-5 mb-2">
            <div class="col">
                <select class="form-control" id="condicao">
                    <option value="0" selected>Todas as condições</option>
                </select>
            </div>
        </div>
    <?php endif; ?>

	<!--Modall-->
    <div class="modal fade" id="relatorios" tabindex="-1" role="dialog" aria-labelledby="relatorios" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="relatoriosLabel">Relatórios disponíveis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mt-xl-2">
                        <p class="label text-center">Todas condições e número total de pacientes por condição</p>
                        <a href="<?= base_url('Paciente/gerarPDFPacientesByCondicao'); ?>" class="btn btn-success btn-block">Gerar PDF</a>
                    </div>
                    <div class="mt-xl-2">
                        <p class="label text-center">Todas condições e todos pacientes</p>
                        <a href="<?= base_url('Paciente/gerarPDFCondicoesPacientes'); ?>" class="btn btn-success btn-block">Gerar PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script
	src="https://code.jquery.com/jquery-3.3.1.js"
	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	crossorigin="anonymous"></script>
<script src="<?= base_url('/assets/js/toastr/toastr.js');?>"></script>
<script
	src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
	integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
	crossorigin="anonymous"></script>
<script >
	var geocoder;
	var corPino = '';
	var pinos = new Array();
	var pinQtd = 0;
	var map;
	var address = null;
	var marker;

	function initMap() {
        var vm = this;
        var lat;
        var lng;
        var cidade = "<?= $session['cidade']; ?>";
        var estado = "<?= $session['estado']; ?>";
	    //local do mapa
		var inicial = {lat: -28.715051, lng: -51.931089};
		var loc;

        geocoder = new google.maps.Geocoder();
        address = cidade + ", " + estado;


		//criando mapa
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 30,
			center: inicial,
			clickableIcons: false
		});

		var remove_points = [
			{
				"featureType": "poi",
				"elementType": "labels",
				"stylers": [
					{ "visibility": "off" }
				]
			}
		]

		map.setOptions({styles: remove_points})


		function getByCondicao(){
			var idCondicao = $('#condicao').val();
            var idCidade = "<?= $session['id_cidade']; ?>";
			$.ajax({
				url:"<?= base_url();?>api/paciente/pinos/"+idCondicao+"/"+idCidade,
				dataType:'json',
				type:"GET",
			}).done(function(data) {
				var i;
				for (i = 0; i < data['response'].length; i++) {
					var myLatLng = {lat: parseFloat(data['response'][i]['lat']), lng: parseFloat(data['response'][i]['lng'])};

					placeMarker(myLatLng, data['response'][i]['cor'], data['response'][i]);

				}
				if(data['response'] == false){

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": 300,
                        "hideDuration": 100,
                        "timeOut": 3000,
                        "extendedTimeOut": 1000,
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.warning("Nenhum paciente cadastrado !");
                }

			});
		}

		$.ajax({
			url:"<?= base_url();?>api/condicao",
			dataType:'json',
			type:"GET",
		}).done(function(data) {
			$('#condicao').empty();
			$('#condicao').append('<option value="0" selected>Todas as condições</option>');
			$.each(data.response, function (i, item) {
				$('#condicao').append('<option value="'+item.id+'">'+item.nome+'</option>');
			});

		});
		$('#condicao').on('change', function() {
			for(var i = 0; i < pinos.length; i++){
				pinos[i].setMap(null);
			};
			getByCondicao();
		})
		getByCondicao();
		geocoder = new google.maps.Geocoder();

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


//funcao para adicionar marker no mapa
		function placeMarker(location, cor, dados) {
			console.log(dados)
            var dataFimQuarentena = new Date(dados.data_fim_quarentena).toLocaleDateString('pt-BR', {timeZone: 'UTC'});
			var contentString = '<div id="content">'+
				'<div id="siteNotice">'+
				'</div>'+
				'<h3 id="firstHeading" class="firstHeading">'+dados.iniciais_nome+'</h3>'+
				'<div id="bodyContent">'+
				'<p>Condição: <b><span style="color:'+cor+'">'+ dados.doencanome +'</span></b></p>'+
                '<p>Idade: '+ dados.idade+' </p>'+
                '<p>Número de familiares: '+ dados.total_familiares+' </p>'+
                '<p><b>Fim quarentena: </b>'+ dataFimQuarentena+' </p>'+
				'<p>Descrição: '+dados.descricao +'</p>'+
				'<p>Telefone: '+dados.telefone+'</p>'+
				'<p>Rua: '+dados.rua+'</p>'+
				'<p>Número: '+dados.numero+'</p>'+
				'</div>'+
				'</div>';
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});

            function calcAge(dateString) {
                var birthday = +new Date(dateString);
                return ~~((Date.now() - birthday) / (31557600000));
            }


			var marker = new google.maps.Marker({
				position: location,
				map: map,
				icon: pinSymbol(cor),
				draggable: false
			});
            // adicionando circulo no mapa
            // var oMarker = new google.maps.Marker({
            //     position: location,
            //     sName: "Marker Name",
            //     map: map,
            //     icon: {
            //         path: google.maps.SymbolPath.CIRCLE,
            //         scale: 8.5,
            //         fillColor: "#F00",
            //         fillOpacity: 0.4,
            //         strokeWeight: 0.4
            //     },
            // });
            //
            // oMarker.setIcon({
            //     path: google.maps.SymbolPath.CIRCLE,
            //     scale: 20,
            //     fillColor: "#F00",
            //     fillOpacity: 0.8,
            //     strokeWeight: 1
            // })

			pinos.push(marker);
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			});


			//pegando latitude e longitudo do ponto clicado
		}

		//criando icone do pino

	}

    function SetMapAddress(address) {  // "London, UK" for example
        var geocoder = new google.maps.Geocoder();
        if (geocoder) {
            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.fitBounds(results[0].geometry.viewport);
                }
            });
        }
    }


	$(document).ready(function() {

			//chamando controller dentro da pasta /api/mapa, metodo get
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

        SetMapAddress(address);


	});

	$("#btnEndereco").click(function() {
		if($(this).val() != "")
			carregarNoMapa($("#endereco").val());
	});

	$("#endereco").blur(function() {
		if($(this).val() != "")
			carregarNoMapa($(this).val());
	});


	function toggleBox(opt){

        $("#boxContent").slideToggle();
        $("#boxControl").html('');
	    if(opt === 'show'){
            $("#boxMenu").css("width", "30%");
            $("#boxMenu").css("left", "65%");
	        $("#boxControl").html('<button type="button" class="btn btn-outline-dark" onclick="toggleBox(\'hide\')"><i class="fa fa-arrow-up"></i></button>');
        }else{
            $("#boxMenu").css("left", "90%");
            $("#boxMenu").css("width", "3.8%");
            $("#boxControl").html('<button type="button" class="btn btn-outline-dark" onclick="toggleBox(\'show\')"><i class="fa fa-arrow-down"></i></button>');
        }
    }

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


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxVfaJlXlVCKTWkpIllZYl4UnV3Z7gNkA&callback=initMap"
		async defer></script>
</body>
</html>
