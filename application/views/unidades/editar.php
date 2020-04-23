<?php $this->load->view('menu');?>
<div class="container mt-5">
<!---->
<!--    <form method="get" action="--><?//= base_url('unidade/editar');?><!--">-->
<!--        <div class="row">-->
<!--            <div class="col col-md-6">-->
<!--                <div class="form-group">-->
<!--                    <label class="form-label" for="name-f">Procurar unidades</label>-->
<!--                    <div class="input-group">-->
<!--                        <input type="text" id="basic-addon1" name="search" class="form-control" placeholder="ID, ID SUS, INICIAIS E TELEFONE" aria-label="Preencha para pesquisar" aria-describedby="basic-addon1">-->
<!--                        <div class="input-group-append">-->
<!--                            <button type="submit" class="btn btn-success shadow-0">PROCURAR...</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </form>-->

    <div class="mt-3">
        <a href="<?= base_url('unidade/cadastrar'); ?>" class="btn mb-3 btn-block btn-success">
            <i class="fa fa-plus"></i>  NOVA UNIDADE
        </a>
    </div>

<!--    --><?php //var_dump($pacientes);?>
    <?php if($lista){?>
        <?php if($unidades){?>
            <div class="tabela">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" >ID</th>
                        <th scope="col" >BAIRRO</th>
                        <th scope="col" class="text-center">NOME</th>
                        <th scope="col" class="text-center">TOTAL SUSPEITOS</th>
                        <th scope="col" class="text-center">TOTAL CONFIRMADOS</th>
                        <th scope="col" class="text-center">TOTAL CURADOS</th>
                        <th scope="col" class="text-center">NUMERO DE LEITOS</th>
                        <th scope="col" class="text-center">OPÇÕES</th>
                    </tr>
                    </thead>
                    <tbody id="tabela">
                    <?php foreach($unidades as $i){?>
                        <tr>
                            <td><?= $i['id'];?></td>
                            <td><b><?= $i['bairro'];?></b></td>
                            <td class="text-center"><?= $i['nome'];?></td>
                            <td class="text-center"> <?= $i['total_pacientes_suspeitos']; ?> </td>
                            <td class="text-center"> <?= $i['total_pacientes_confirmados']; ?> </td>
                            <td class="text-center"> <?= $i['total_pacientes_curados']; ?> </td>
                            <td class="text-center"> <?= $i['numero_leitos']; ?> </td>
                            <td class="text-center"><a class="btn btn-primary text-light" href="<?= base_url('unidade/editar/'.$i['id']); ?>"><i class="fa fa-search-plus"></i></a></td>
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
