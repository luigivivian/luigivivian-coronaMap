<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="<?= base_url('assets/imgs/favicon.ico');?>" type="image/x-icon">
	<title>Editar Condição</title>
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


    <?php if(!isset($condicao['id'])){
        $condicao['id'] = 1;
    }?>
	<?php if($lista){?>
        <button type="button" class="btn btn-success btn-block mt-2 mb-3" data-toggle="modal" data-target="#exampleModal">
            Cadastrar nova condição
        </button>
		<div class="tabela">
			<table class="table">
				<thead>
				<tr>
					<th scope="col" >ID</th>
					<th scope="col">NOME</th>
					<th scope="col" class="text-center">OPÇÕES</th>
				</tr>
				</thead>
				<tbody id="tabela">
				<?php foreach($condicoes as $i){?>
					<tr>
						<td><?= $i['id'];?></td>
						<td><i class="fa fa-circle mr-xl-2" style="color: <?= $i['cor']; ?>"></i><?= $i['nome'];?></td>
						<td class="text-center">
                            <a class="btn btn-primary text-light" href="<?= base_url('condicao/editar/'.$i['id']); ?>"><i class="fa fa-search-plus"></i></a>
                            <a class="btn btn-danger text-light" onclick="return confirm('Deseja realmente deletar?');" href="<?= base_url('condicao/deletar/'.$i['id']); ?>"><i class="fa fa-trash"></i></a>
                        </td>
					</tr>
				<?php }?>
				</tbody>
			</table>
		</div>
	<?php }else{?>
		<p><?= $condicao['nome']; ?></p>
		<form id="update" method="POST" action="<?= base_url('api/editar'); ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">ID</label>
				<input type="number" required class="form-control" id="id" value="<?= $condicao['id']; ?>" disabled>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="exampleInputPassword1">NOME</label>
						<input type="text" required class="form-control" id="nome" name="nome" value="<?= $condicao['nome']; ?>" placeholder="Nome">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label for="exampleInputPassword1">COR</label>
						<input type="color" required class="form-control" id="cor" name="cor" value="<?= $condicao['cor']; ?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1">Descricao</label>
				<textarea class="form-control" name="descricao" id="descricao" rows="3"><?= $condicao['descricao']; ?></textarea>
			</div>

		</form>

		<div class="mt-4 mb-4">
			<button type="submit" form="update" class="btn btn-success btn-block">SALVAR</button>
			<a href="<?= base_url('condicao/editar');?>" class="btn btn-danger btn-block text-light mt-3">CANCELAR</a>
		</div>
	<?php }?>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="cadDoenca">
                        <form id="cadastroDoenca" method="POST"">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="senha">Nome</label>
                                        <input type="text" name="nome" class="form-control" id="nomeDoenca" placeholder="Digite o nome da condição">
                                        <small class="form-text text-muted">campo obrigatório</small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="senha">Selecione uma cor:</label>
                                        <input type="color" class="form-control" name="cor" value="#ff0000">
                                        <small id="telHELP" class="form-text text-muted">campo obrigatório</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="senha">Descrição</label>
                                <textarea class="form-control" name="descricao" rows="3"></textarea>
                                <small id="telHELP" class="form-text text-muted">campo obrigatório</small>
                            </div>
                            <button class="btn btn-success" type="submit" form="cadastroDoenca">Cadastrar Condição</button>
                        </form>
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
<script
	src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
	integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
	crossorigin="anonymous"></script>
<script >
</script>

</body>

<script>


	$(document).ready(function() {

		corPino = $('#corPino').val();
		$("#update").submit(function(event) {
			var ajaxRequest;
			event.preventDefault();

			var values = $(this).serialize();
			ajaxRequest = $.ajax({
				url: "<?= base_url(); ?>api/condicao/<?= $condicao['id'];?>",
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

        $("#cadastroDoenca").submit(function(event) {
            var ajaxRequest;
            event.preventDefault();

            var values = $(this).serialize();
            ajaxRequest = $.ajax({
                url: "<?= base_url(); ?>api/condicao",
                type: "post",
                data: values
            });
            ajaxRequest.done(function (response, textStatus, jqXHR) {
                alert('Cadastro efetuado !');

                window.location = "<?= base_url('condicao/editar');?>";
            });
            ajaxRequest.fail(function (response) {
                alert('Ocorreu algum erro ao cadastrar');
                console.log(response);
            });
        });
	});
</script>



</html>
