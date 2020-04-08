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
