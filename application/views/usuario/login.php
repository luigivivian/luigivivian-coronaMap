<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Google maps</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?= base_url('/assets/css/vendors.bundle.css');?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/app.bundle.css');?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/fontawesome-all.css');?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/fa-solid.css');?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/toastr/toastr.css');?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/toastr/toastr.css.map');?>">
</head>
<style>
#boxLogin{
    -webkit-box-shadow: 10px 0px 132px 0px rgba(0,0,0,0.39);
    -moz-box-shadow: 10px 0px 132px 0px rgba(0,0,0,0.39);
    box-shadow: 10px 0px 132px 0px rgba(0,0,0,0.39);
}
</style>
<body>



<div class="container-fluid" id="conteudo">

	<div class="container">
		<div class="mt-xl-5">
			<div class="row">
				<div class="col"></div>
				<div class="col-md-6 mb-xl-5" id="boxLogin">
					<?php if(isset($msg)){ ?>
					<?php if(isset($erro)){?>
					<div class="alert mt-xl-4 text-center alert-danger" role="alert">
						<?php }else{?>
						<div class="alert mt-xl-4 text-center alert-success" role="alert">
							<?php }?>
							<?= $msg; ?>
						</div>
						<?php } ?>
						<?= form_open(base_url('usuario/logar'), 'name="login"');  ?>
						<div class="mt-xl-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Login</label>
								<input type="text" name="login" class="form-control" id="loginINPT" aria-describedby="emailHelp" placeholder="usuario123">
								<small id="emailHelp" class="form-text text-muted">Digite seu login.</small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Senha</label>
								<input type="password" name="senha" class="form-control" id="senhaINPT" placeholder="Digite sua senha.">
								<small id="emailHelp" class="form-text text-muted">Digite sua senha.</small>
							</div>
							<div class="mb-xl-4">
								<button type="submit" class="btn btn-primary">Entrar</button>
							</div>
						</div>
						<?= form_close();?>
					</div>
					<div class="col"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Preencha os campos para efetuar o cadastro !</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?= form_open(base_url('usuario/cadastrar'), 'name="cadastro"');  ?>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="exampleInputEmail1">Nome</label>
								<input type="text" name="nome" class="form-control" id="nomeINPT" placeholder="Digite seu nome">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="exampleInputEmail1">Sobrenome</label>
								<input type="text" name="sobrenome" class="form-control" id="sobrenomeINPT" placeholder="Digite seu sobrenome">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="exampleInputEmail1">Digite seu email</label>
								<input type="email" name="email" class="form-control" id="emailINPT" placeholder="exemplo@gmail.com">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="exampleInputEmail1">Digite seu login</label>
								<input type="text" name="login" class="form-control" id="loginINPT" placeholder="Digite seu login">
							</div>
						</div>
					</div>


                    <div class="row">
                        <div class="col">
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
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Selecione sua cidade</label>
                                <select class="custom-select" name="cidade" id="cidade">
                                    <option value="" disabled selected>Selecione uma opcao !</option>
                                </select>
                            </div>
                        </div>
                    </div>


					<div class="form-group">
						<label for="exampleInputEmail1">Digite seu número do celular</label>
						<input type="number" name="celular" class="form-control" id="celular" placeholder="54 99999902">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Senha</label>
						<input type="password" name="senha" class="form-control" id="senhaINPT" placeholder="Escolha uma senha segura">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Confirme sua senha</label>
						<input type="password" name="senha2" class="form-control" id="senha2INPT" placeholder="Confirme sua senha">
					</div>

					<button type="submit" class="btn btn-success">Cadastrar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<?= form_close();  ?>
				</div>
				<div class="modal-footer">

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
</body>

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
    });

</script>
</html>
