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
    <div>
        <a href="<?= base_url('inicio/cadastrar'); ?>" class="btn mb-3 btn-block btn-success">
            Cadastrar Paciente
        </a>
    </div>
	<?php if($lista){?>
        <?php if($pacientes){?>
	<div class="tabela">
		<table class="table">
			<thead>
			<tr>
				<th scope="col" >ID PACIENTE</th>
				<th scope="col" class="text-center">NOME</th>
				<th scope="col" class="text-center">TELEFONE</th>
				<th scope="col" class="text-center">DATA NASCIMENTO</th>
				<th scope="col" class="text-center">OPÇÕES</th>
			</tr>
			</thead>
			<tbody id="tabela">
			<?php foreach($pacientes as $i){?>
				<tr>
					<td><?= $i['id'];?></td>
					<td class="text-center"><?= $i['nome'];?></td>
					<td class="text-center"><?= $i['telefone'];?></td>
					<td class="text-center"><?= date('d/m/Y', strtotime($i['datanascimento']));?></td>
					<td class="text-center"><a class="btn btn-primary text-light" href="<?= base_url('paciente/editar/'.$i['id']); ?>"><i class="fa fa-search-plus"></i></a></td>
				</tr>
			<?php }?>
			</tbody>
		</table>
	</div>
            <?php }else{?>
                    <div class="text-center"><h2>Sem dados cadastrados</h2></div>
            <?php }?>
	<?php }?>

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

</script>



</html>
