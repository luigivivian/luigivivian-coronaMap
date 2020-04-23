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

    #box{
        -webkit-box-shadow: 10px 0px 132px 0px rgba(0,0,0,0.39);
        -moz-box-shadow: 10px 0px 132px 0px rgba(0,0,0,0.39);
        box-shadow: 10px 0px 132px 0px rgba(0,0,0,0.39);
        border-style: solid;
        border-width: 0.5px;
        border-radius: 10px;
        padding: 20px;
        border-color: gray;
    }

</style>
<body>



<div class="container-fluid" id="conteudo">
    <!--mapa-->
    <div class="col pt-lg-6">
        <div class="col col-md-4 offset-md-4" id="box">
            <div class="row">
                <div class="col col-sm-12">
                    <h3>Em qual cidade você está ?</h3>
                </div>
                <div class="col col-sm-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Selecione seu estado</label>
                        <select class="custom-select" name="idEstado" id="estado">
                            <option value="" disabled selected>Selecione uma opcao !</option>
                            <?php if(!empty($estados)):?>
                                <?php foreach($estados as $e){?>
                                    <option value="<?=$e['id'];?>"><?=$e['nome']?></option>
                                <?php }?>
                            <?php endif;?>
                        </select>
                    </div>
                </div>
                <div class="col col-sm-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Selecione sua cidade</label>
                        <select class="custom-select" name="cidade" id="cidade">
                            <option value="" disabled selected>Selecione uma opcao !</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col col-md-3 offset-md-5 offset-sm-0 col-sm-12 mt-5">
            <a class="btn btn-outline-danger" href="<?= base_url('/usuario')?>">Acessar área administrativa</a>
        </div>
    </div>

    <footer class="page-footer" role="contentinfo" style="position: fixed; bottom: 0; width: 100%">
        <div class="d-flex align-items-center flex-1 text-muted">
            <span class="hidden-md-down fw-700">2020 © Corona Map by&nbsp;</span>
            <a href="https://www.linkedin.com/in/luigi-vivian-44752b16b/" class='text-primary fw-500' target='_blank'>Luigi Vivian | UPF</a>
        </div>
    </footer>
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



<script>


    $(document).ready(function() {
        $('#estado').change(function(){
            // get estado by id
            var id = $("#estado").val();
            $.ajax({
                url:"<?= base_url();?>api/cidade/"+id,
                dataType:'json',
                type:"GET",
            }).done(function(response) {
                var data = response.response;
                console.log(data);
                for(var d in data){
                    console.log(d);
                    var options = '<option value="'+data[d].id+'">'+data[d].nome+'</option>';
                    $('#cidade').append(options);
                }
            });
        });


        $('#cidade').change(function(){
            // get estado by id
            var idCidade = $("#cidade").val();

            window.location.href = "<?= base_url();?>inicio/publico/"+idCidade;
        });
    });

</script>

</body>
</html>
