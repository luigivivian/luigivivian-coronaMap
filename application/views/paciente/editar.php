<?php $this->load->view('menu');?>
<div class="container mt-5">

    <form method="get" action="<?= base_url('paciente/editar');?>">
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label" for="name-f">Procurar paciente</label>
                    <div class="input-group">
                        <input type="text" id="basic-addon1" name="search" class="form-control" placeholder="ID, ID SUS, INICIAIS E TELEFONE" aria-label="Preencha para pesquisar" aria-describedby="basic-addon1">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success shadow-0">PROCURAR...</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="mt-3">
        <a href="<?= base_url('inicio/cadastrar'); ?>" class="btn mb-3 btn-block btn-success">
            <i class="fa fa-plus"></i>  NOVO PACIENTE
        </a>
    </div>

    <div class="mt-3 text-center">
        <h4><b>Número total de casos cadastrados: <?= $total_pacientes_cadastrados?></b></h4>
    </div>

<!--    --><?php //var_dump($pacientes);?>
    <?php if($lista){?>
        <?php if($pacientes){?>
            <div class="tabela">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" >ID PACIENTE</th>
                        <th scope="col" >ID SUS</th>
                        <th scope="col" class="text-center">INICIAIS NOME</th>
                        <th scope="col" class="text-center">CONDIÇÃO</th>
                        <th scope="col" class="text-center">TELEFONE</th>
                        <th scope="col" class="text-center">DATA NASCIMENTO</th>

                        <th scope="col" class="text-center">OPÇÕES</th>
                    </tr>
                    </thead>
                    <tbody id="tabela">
                    <?php foreach($pacientes as $i){?>
                        <tr>
                            <td><?= $i['id'];?></td>
                            <td><b><?= $i['id_sus'];?></b></td>
                            <td class="text-center"><?= $i['iniciais_nome'];?></td>
                            <td class="text-center" style="color: <?= $i['cor']; ?>"><b><?= $i['doencanome'];?></b></td>
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
