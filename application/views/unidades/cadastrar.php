<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    #map {
        height: 90vmin;

    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #bdc3c7;
    }
    .ui-autocomplete {
        z-index: 215000000 !important;
    }



</style>
<body>
<div class="container-fluid" id="conteudo">

    <div id="map">
    </div>

    <!-- Modal -->
    <div class="row mt-2" id="menu">

        <div class="col"></div>
        <div class="col-md-6 row">
            <div class="col">
                <button type="submit" id="continuar" form="cadastro" class="btn btn-success btn-block ml-xl-2" data-placement="top" data-content="Após ajustar o pino no mapa clique aqui"/>Continuar</button>
                <input class="" id="end" name="end" type="text" hidden>
            </div>
            <div class="col">
                <a class="btn btn-danger ml-2 btn-block"  href="<?= base_url('inicio');?>">Cancelar</a>
            </div>


        </div>
        <div class="col"></div>
    </div>


    <div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="cadastroModal" aria-hidden="true">
        <div class="modal-dialog modal-lg ui-front" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadastroModalLabel">Digite os dados pessoais !</h5>
                </div>
                <div class="modal-body">
                    <form id="cadastro" method="POST" action="<?= base_url('api/paciente')?>">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="iniciais_nome">Nome da unidade</label>
                                    <input type="text" name="nome" required class="form-control" id="nome" aria-describedby="nomeHelp" placeholder="Digite o nome da unidade">
                                    <small id="nomeHelp" class="form-text text-muted">campo obrigatório</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="sobrenome">BAIRRO</label>
                                    <input type="text" name="bairro" required class="form-control" id="bairro" aria-describedby="bairroHelp" placeholder="Digite o bairro da unidade">
                                    <small id="bairroHelp" class="form-text text-muted">campo obrigatório</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="iniciais_nome">Número de leitos</label>
                                    <input type="text" name="numero_leitos" required class="form-control" id="numero_leitos" aria-describedby="numero_leitosHelp" placeholder="Digite o total deleitos ">
                                    <small id="numero_leitosHelp" class="form-text text-muted">campo obrigatório</small>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="endereco">Digite o endereço completo</label>
                                    <input class="form-control tags" id="endereco" name="endereco" type="text" placeholder="Ex: Av. Arthur Oscar - Centro, Serafina Corrêa" required>
                                    <input class="" id="end" type="text" hidden>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="lat" name="lat" required>
                        <input type="hidden" id="lng" name="lng" required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnModalDados" class="btn btn-success ml-xl-2"/>Confirmar</button>
                    <a class="btn btn-danger"  href="<?= base_url('inicio');?>">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script >
    var geocoder;
    var corPino = '';
    var pinos = new Array();
    var pinQtd = 0;
    var map;
    var address = null;
    var marker;
    var idCidade = "<?= $session['id_cidade']; ?>";
    function initMap() {
        //local inicial do mapa
        var inicial = {lat: -28.715051, lng: -51.931089};

        var cidade = "<?= $session['cidade']; ?>";
        var estado = "<?= $session['estado']; ?>";
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
        geocoder = new google.maps.Geocoder();
        //evento de clique no mapa
        google.maps.event.addListener(map, 'click', function(event) { //evento disparado ao clicar no mapa
            if(pinos.length > 0){
                alert('Já existe um pino no mapa !');
                return;
            }else{
                placeMarker(event.latLng, '');//adicionando pino ao local clicado
            }
        });



//funcao para adicionar marker no mapa
        function placeMarker(location, cor) {
            marker = new google.maps.Marker({
                position: location,
                map: map,
                icon: pinSymbol(cor),
                draggable: true
            });
            google.maps.event.addListener(marker, 'dragend', function (event) {
                document.getElementById("lat").value = this.getPosition().lat();
                document.getElementById("lng").value = this.getPosition().lng();
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
            $('#lng').val(marker.getPosition().lng());

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
        $( "#cadDoenca" ).hide();
        SetMapAddress(address);
        $('#cadastroModal').modal({backdrop: 'static', keyboard: false})
        $('#cadastroModal').modal('show');


        //Botao modal dados paciente
        $("#btnModalDados").click(function() {

            if($('#endereco').val() == '' || $('#nome').val() == ''|| $('#bairro').val() == ''){
                alert("Preencha todos os campos !");
                return;
            }

            $('#cadastroModal').modal('hide');
            $('#continuar').popover('show');
            $('#continuar').html('Finalizar Cadastro');
        });


        $("#cadastro").submit(function(event) {
            $(this).append('<input type="hidden" name="idCidade" value="'+idCidade+'" />');
            var ajaxRequest;
            event.preventDefault();
            if(pinos.length == 0){
                alert('Por favor marque o local no mapa !');
                $('#cadastroModal').modal('hide');
            }else{
                var values = $(this).serialize();
                ajaxRequest = $.ajax({
                    url: "<?= base_url();?>api/unidade",
                    type: "post",
                    data: values
                });
                ajaxRequest.done(function (response, textStatus, jqXHR) {
                    alert('Cadastro concluido com sucesso !');
                    window.location = "<?= base_url();?>";
                });
                ajaxRequest.fail(function (response) {
                    alert('Ocorreu algum erro ao cadastrar');
                    console.log(response);
                });
            }
        });

    });

    function cadastrar(){
        $('#cadastroModal').modal('show');
    }

    function novaDoenca(){
        $('#cadDoenca').slideToggle();
    }



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

                    if(pinos.length > 0){
                        alert('Já existe um pino no mapa !');
                        return;
                    }else{
                        var location = new google.maps.LatLng(latitude, longitude);
                        marker = new google.maps.Marker({
                            map: map,
                            draggable: true
                        });
                        pinos.push(marker);
                        marker.setPosition(location);
                        google.maps.event.addListener(marker, 'dragend', function (event) {
                            document.getElementById("lat").value = this.getPosition().lat();
                            document.getElementById("lng").value = this.getPosition().lng();
                        });
                        map.setCenter(location);
                        map.setZoom(16);
                    }
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
        //var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+long+"&sensor=false";
        var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+long+"&sensor=false";
        $.getJSON(url,function (data, textStatus) {
            var streetaddress=data.results[0].formatted_address;
            console.log(data.results[0]);
            console.log(textStatus);
            return streetaddress;
        });
    }



</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxVfaJlXlVCKTWkpIllZYl4UnV3Z7gNkA&callback=initMap"
        async defer></script>
</body>
