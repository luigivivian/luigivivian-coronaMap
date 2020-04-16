<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <title>Pacientes e condições</title>

    <style type="text/css">

    </style>
</head>
<body>
<div class="container">
    <div class="mt-xl-5 text-center">
        <h3>Pacientes e condições</h3>
    </div>
    <?php if(!empty($lista)):?>
        <div class="tabela mt-xl-5">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID Paciente</th>
                    <th>Condição</th>
                    <th>Nome Completo</th>
                    <th>Telefone</th>
                    <th>Data de Nascimento</th>
                    <th>Idade</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($lista as $v){ ?>
                    <tr>
                        <th scope="row"><?= $v['id']; ?></th>
                        <td style="color: <?= $v['cor']?>"><?= $v['cnome']; ?></td>
                        <td><?= $v['iniciais_nome']; ?> </td>
                        <td><?= $v['telefone']; ?></td>
                        <td><?= date('d/m/Y', strtotime($v['datanascimento'])); ?></td>
                        <td><?= $v['dataAtual'] - $v['datanascimento']; ?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div>
            Dados insuficientes para gerar o relatorio.
        </div>
    <?php endif;?>
</div>
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="assets/js/jquery-filestyle.min.js"></script>

</body>

</html>
