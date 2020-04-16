<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= base_url('assets/imgs/favicon.ico');?>" type="image/x-icon">
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

</head>
<style>
    #map {
        height: 90vmin;

    }
</style>
<body>
<?php $this->load->view('menu');?>
<div class="container mt-xl-4">
        <h5>Dados paciente Form</h5>
        <form id="update" method="POST" action="<?= base_url('api/paciente')?>">
            <div class="form-group">
                <label for="exampleInputEmail1">ID</label>
                <input type="number" required class="form-control" id="id" value="<?= $paciente['id']?>" disabled>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">INICIAIS</label>
                        <input type="text" required class="form-control" id="iniciais_nome" name="iniciais_nome" value="<?= $paciente['iniciais_nome']?>" placeholder="Nome">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">DATA DE NASCIMENTO</label>
                        <input type="date" required class="form-control" id="datanascimento" name="datanascimento" value="<?= date('Y-m-d', strtotime($paciente['datanascimento']))?>" placeholder="Nome">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">TELEFONE</label>
                        <input type="text" required class="form-control" id="telefone" name="telefone" value="<?= $paciente['telefone']?>" placeholder="Nome">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">RUA</label>
                        <input type="text" required class="form-control" id="rua" name="rua" value="<?= $paciente['rua']?>" placeholder="Nome">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputPassword1">NÚMERO</label>
                        <input type="text" required class="form-control" id="numero" name="numero" value="<?= $paciente['numero']?>" placeholder="Nome">
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">ENDEREÇO</label>
                <input type="text" required class="form-control" id="endereco" name="endereco" value="<?= $paciente['endereco']?>" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">CONDIÇÃO CLINICA</label>
                <select class="form-control" name="idCondicao">
                    <?php foreach($condicoes as $c){?>
                        <option <?= $paciente['idCondicao'] == $c['id'] ? "selected" : ""; ?> value="<?= $c['id'];?>"><?= $c['nome']; ?></option>
                    <?php }?>
                </select>
            </div>
            <input type="hidden" value="<?= $paciente['lat']; ?>" id="lat" name="lat" required>
            <input type="hidden" value="<?= $paciente['lng']; ?>" id="lng" name="lng" required>
        </form>
        <input type="hidden" value="<?= $corPino; ?>" id="corPino" required>
        <div class="text-center">
            <h4>Arraste o pino com o mouse para alterar a localização</h4>
        </div>
        <div id="map" class="mt-5">
        </div>

        <div class="mt-4 mb-4">
            <button type="submit" form="update" class="btn btn-success btn-block">SALVAR</button>
            <a href="<?= base_url('paciente/editar');?>" class="btn btn-danger btn-block text-light mt-3">CANCELAR</a>
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
<script >
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxVfaJlXlVCKTWkpIllZYl4UnV3Z7gNkA&callback=initMap"
        async defer></script>
</body>

<script>

    var geocoder;
    var corPino = '';
    var map;
    var address = null;
    var marker;
    function initMap() {
        //local inicial do mapa
        var inicial = {lat: -28.715051, lng: -51.931089};
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
        inicial = {lat: parseFloat(document.getElementById("lat").value), lng: parseFloat(document.getElementById("lng").value)};
        marker = new google.maps.Marker({
            position: inicial,
            map: map,
            icon: pinSymbol(document.getElementById("corPino").value),
            draggable: true
        });
        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("lat").value = this.getPosition().lat();
            document.getElementById("lng").value = this.getPosition().lng();
        });

        //pegando latitude e longitudo do ponto clicado
        $('#lat').val(marker.getPosition().lat());
        $('#lng').val(marker.getPosition().lng());


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
        corPino = $('#corPino').val();
        $("#update").submit(function(event) {
            var ajaxRequest;
            event.preventDefault();

            var values = $(this).serialize();
            ajaxRequest = $.ajax({
                url: "<?= base_url();?>api/paciente/<?= $paciente['id']?>",
                type: "put",
                data: values
            });
            ajaxRequest.done(function (response, textStatus, jqXHR) {
                alert('Dados Atualizados !');

                window.location = "<?= base_url();?>";
            });
            ajaxRequest.fail(function (response) {
                alert('Ocorreu algum erro ao cadastrar');
                console.log(response);
            });
        });
    });
</script>



</html>
