<?php $this->load->view('menu');?>
<div class="container mt-5">
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
                        <th scope="col" class="text-center">INICIAIS NOME</th>
                        <th scope="col" class="text-center">TELEFONE</th>
                        <th scope="col" class="text-center">DATA NASCIMENTO</th>
                        <th scope="col" class="text-center">OPÇÕES</th>
                    </tr>
                    </thead>
                    <tbody id="tabela">
                    <?php foreach($pacientes as $i){?>
                        <tr>
                            <td><?= $i['id'];?></td>
                            <td class="text-center"><?= $i['iniciais_nome'];?></td>
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
