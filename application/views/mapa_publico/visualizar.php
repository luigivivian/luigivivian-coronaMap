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

        <div class="col col-md-8 offset-md-2">
            <div class="row mt-2" id="optionsBox">
                <div class="col col-md-8" id="itensBox">
                    <div>
                        <div class="input-group-prepend">
                            <div class="col">
                                <input class="form-control tags" style="width: 40vmax;" id="endereco" name="endereco" type="text" placeholder="Ex: Av. Arthur Oscar - Centro, Serafina Corrêa" required>
                                <input class="form-control" id="end" name="end" type="text" hidden>
                            </div>
                            <div class="col">
                                <button type="button" id="btnEndereco" class="btn btn-success"/>Mostrar no mapa</button>
                            </div>
                            <div class="col">
                                <a href="<?= base_url('/usuario/index');?>" class="btn btn-primary">Logar</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    <?php else: ?>
        <div id="map" style="width: 100%; min-height: 95vh">
        </div>
    <?php endif; ?>



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
        var cidade = "<?= $cidade; ?>";
        var estado = "<?= $estado; ?>";
        var idCidade = "<?= $idCidade; ?>";
        console.log(cidade);
        //local do mapa
        var inicial = {lat: -28.715051, lng: -51.931089};
        var loc;

        geocoder = new google.maps.Geocoder();
        address = cidade + ", " + estado;


        //criando mapa
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
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

        // refactor to get locais
        function getUnidades(){
            $.ajax({
                url:"<?= base_url();?>api/unidade/unidades/"+<?=$idCidade?>,
                dataType:'json',
                type:"GET",
            }).done(function(data) {
                console.log(data['response']);
                var i;
                for (i = 0; i < data['response'].length; i++) {
                     var myLatLng = {lat: parseFloat(data['response'][i]['lat']), lng: parseFloat(data['response'][i]['lng'])};
                    // console.log(parseFloat(myLatLng.lat));
                    // console.log(parseFloat(myLatLng.lng));
                    placeMarker(myLatLng, data['response'][i]['cor'], data['response'][i]);
                    // console.log("Pino colocado");
                    // console.log('response:');
                    // console.log(data['response']);
                    // adicionando circulo no mapa

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
                console.log(data['response']);
            });
        }


        getUnidades();
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
            console.log('teste');
            console.log(dados);
            var contentString = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h3 id="firstHeading" class="firstHeading">'+dados.nome+'</h3>'+
                '<div id="bodyContent">'+
                '<p>Casos <span class="text-warning"><b>Suspeitos</b>:</span> '+dados.total_pacientes_suspeitos+'</p>'+
                '<p>Casos <span class="text-danger"><b>Confirmados</b>: </span>'+dados.total_pacientes_confirmados+'</p>'+
                '<p>Casos <span class="text-success"><b>Curados</b></span>: '+dados.total_pacientes_curados+'</p>'+
                '</div>'+
                '</div>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            var totalSuspeitos = parseInt(dados.total_pacientes_suspeitos);
            var totalConfirmados = parseInt(dados.total_pacientes_confirmados);

            function calcAge(dateString) {
                var birthday = +new Date(dateString);
                return ~~((Date.now() - birthday) / (31557600000));
            }
            var oMarker = new google.maps.Marker({
                position: location,
                sName: "Marker Name",
                map: map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: parseInt(dados.total_pacientes_suspeitos),
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                },
            });

            var radius = ((totalSuspeitos + totalConfirmados) * ((totalSuspeitos * 0.5) + (totalConfirmados * 3)) / 10);
            if(radius < 10){
                radius = 15;
            }
            if(radius >= 150){
                radius = radius = 80;
            }

            oMarker.setIcon({
                path: google.maps.SymbolPath.CIRCLE,
                scale: radius,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
            })

            pinos.push(oMarker);
            oMarker.addListener('click', function() {
                infowindow.open(map, oMarker);
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
                    var location = results[0].geometry.location;
                    console.log(location);
                    map.setCenter(location);
                    map.setZoom(15);
                }
            });
        }
    }


    $(document).ready(function() {
        SetMapAddress(address);
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
