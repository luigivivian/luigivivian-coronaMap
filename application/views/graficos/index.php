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

</head>
<style>

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #bdc3c7;
    }

</style>
<body>


<?php $this->load->view('menu');?>
<!-- DOC: script to save and load page settings -->


<?php var_dump($casosConfirmados);?>
<!-- BEGIN Page Wrapper -->
<div class="page-wrapper">
    <div class="page-inner">

        <!-- END Left Aside -->
        <div class="page-content-wrapper">
            <main id="js-page-content" role="main" class="page-content">
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-chart-pie'></i>Gráficos administrativos
                        <small>
                            Os gráficos desempenham um papel muito importante na análise de dados :)
                        </small>
                    </h1>
                </div>

                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-6">
                            <div id="panel-8" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        <span class="fw-300">Número de casos Suspeitos</span>
                                    </h2>
                                    <div class="panel-toolbar">
                                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                    </div>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <div class="panel-tag" id="barChartSuspeitosInfo">
                                            Esse gráfico representa o crescimento do número de casos suspeitos de covid-19                                        </div>
                                        <div id="barChartSuspeitos">
                                            <canvas style="width:100%; height:300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-6">
                            <div id="panel-8" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        <span class="fw-300">Número de casos Confirmados</span>
                                    </h2>
                                    <div class="panel-toolbar">
                                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                    </div>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <div class="panel-tag" id="barChartConfirmadosInfo">
                                            Esse gráfico representa o crescimento do número de casos confirmados de covid-19
                                        </div>
                                        <div id="barChartConfirmados">
                                            <canvas style="width:100%; height:300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-6">
                            <div id="panel-6" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        <span class="fw-300">Faixa etaria pessoas atingidas</span>
                                    </h2>
                                    <div class="panel-toolbar">
                                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                    </div>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <div class="panel-tag">
                                            Pie charts are probably the most commonly used chart there are. They are divided into segments, the arc of each segment shows the proportional value of each piece of data
                                        </div>
                                        <div id="pieChart">
                                            <canvas style="width:100%; height:300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </main>
            <!-- this overlay is activated only when mobile menu is triggered -->
            <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
            <!-- BEGIN Page Footer -->
            <footer class="page-footer" role="contentinfo">
                <div class="d-flex align-items-center flex-1 text-muted">
                    <span class="hidden-md-down fw-700">2020 © Corona Map by&nbsp;</span>
                    <a href="https://www.linkedin.com/in/luigi-vivian-44752b16b/" class='text-primary fw-500' target='_blank'>Luigi Vivian</a>
                </div>
            </footer>
            <!-- END Page Footer -->
            <!-- BEGIN Shortcuts -->
            <div class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
                <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <ul class="app-list w-auto h-auto p-0 text-left">
                                <li>
                                    <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                        <div class="icon-stack">
                                            <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                            <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                            <i class="fal fa-home icon-stack-1x opacity-100 color-white"></i>
                                        </div>
                                        <span class="app-list-name">
                                                    Home
                                                </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="page_inbox_general.html" class="app-list-item text-white border-0 m-0">
                                        <div class="icon-stack">
                                            <i class="base base-7 icon-stack-3x opacity-100 color-success-500 "></i>
                                            <i class="base base-7 icon-stack-2x opacity-100 color-success-300 "></i>
                                            <i class="ni ni-envelope icon-stack-1x text-white"></i>
                                        </div>
                                        <span class="app-list-name">
                                                    Inbox
                                                </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                        <div class="icon-stack">
                                            <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                            <i class="fal fa-plus icon-stack-1x opacity-100 color-white"></i>
                                        </div>
                                        <span class="app-list-name">
                                                    Add More
                                                </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Shortcuts -->
            <!-- BEGIN Color profile -->
            <!-- this area is hidden and will not be seen on screens or screen readers -->
            <!-- we use this only for CSS color refernce for JS stuff -->
            <p id="js-color-profile" class="d-none">
                <span class="color-primary-50"></span>
                <span class="color-primary-100"></span>
                <span class="color-primary-200"></span>
                <span class="color-primary-300"></span>
                <span class="color-primary-400"></span>
                <span class="color-primary-500"></span>
                <span class="color-primary-600"></span>
                <span class="color-primary-700"></span>
                <span class="color-primary-800"></span>
                <span class="color-primary-900"></span>
                <span class="color-info-50"></span>
                <span class="color-info-100"></span>
                <span class="color-info-200"></span>
                <span class="color-info-300"></span>
                <span class="color-info-400"></span>
                <span class="color-info-500"></span>
                <span class="color-info-600"></span>
                <span class="color-info-700"></span>
                <span class="color-info-800"></span>
                <span class="color-info-900"></span>
                <span class="color-danger-50"></span>
                <span class="color-danger-100"></span>
                <span class="color-danger-200"></span>
                <span class="color-danger-300"></span>
                <span class="color-danger-400"></span>
                <span class="color-danger-500"></span>
                <span class="color-danger-600"></span>
                <span class="color-danger-700"></span>
                <span class="color-danger-800"></span>
                <span class="color-danger-900"></span>
                <span class="color-warning-50"></span>
                <span class="color-warning-100"></span>
                <span class="color-warning-200"></span>
                <span class="color-warning-300"></span>
                <span class="color-warning-400"></span>
                <span class="color-warning-500"></span>
                <span class="color-warning-600"></span>
                <span class="color-warning-700"></span>
                <span class="color-warning-800"></span>
                <span class="color-warning-900"></span>
                <span class="color-success-50"></span>
                <span class="color-success-100"></span>
                <span class="color-success-200"></span>
                <span class="color-success-300"></span>
                <span class="color-success-400"></span>
                <span class="color-success-500"></span>
                <span class="color-success-600"></span>
                <span class="color-success-700"></span>
                <span class="color-success-800"></span>
                <span class="color-success-900"></span>
                <span class="color-fusion-50"></span>
                <span class="color-fusion-100"></span>
                <span class="color-fusion-200"></span>
                <span class="color-fusion-300"></span>
                <span class="color-fusion-400"></span>
                <span class="color-fusion-500"></span>
                <span class="color-fusion-600"></span>
                <span class="color-fusion-700"></span>
                <span class="color-fusion-800"></span>
                <span class="color-fusion-900"></span>
            </p>
            <!-- END Color profile -->
        </div>
    </div>
</div>

<!-- plugin Chart.js : MIT license -->
<script src="<?= base_url('/assets/js/vendors.bundle.js');?>"></script>
<script src="<?= base_url('/assets/js/app.bundle.js');?>"></script>
<script src="<?= base_url('/assets/js/statistics/chartjs/chartjs.bundle.js');?>"></script>
<script src="<?= base_url('/assets/js/moment.js');?>"></script>


<script>


    /* bar chart */

    var casosSuspeitos = new Array();
    <?php if(!empty($casosSuspeitos)):?>
    <?php foreach($casosSuspeitos as $key => $val){ ?>
        casosSuspeitos.push('<?php echo $val['total']; ?>');
    <?php } ?>
    <?php endif;?>

    var casosConfirmados = new Array();
    <?php if(!empty($casosConfirmados)):?>
        <?php foreach($casosConfirmados as $key => $val){ ?>
            casosSuspeitos.push('<?php echo $val['total']; ?>');
        <?php } ?>
    <?php endif;?>


    var casosSuspeitosLabels = new Array();
    <?php if(!empty($casosSuspeitosLabels)):?>
    <?php foreach($casosSuspeitosLabels as $key => $val){ ?>
    casosSuspeitosLabels.push('<?php echo $val; ?>');
    <?php } ?>
    <?php endif;?>


    var casosConfirmadosLabels = new Array();
    <?php if(!empty($casosConfirmadosLabels)):?>
    <?php foreach($casosConfirmadosLabels as $key => $val){ ?>
    casosConfirmadosLabels.push('<?php echo $val; ?>');
    <?php } ?>
    <?php endif;?>
    console.log(casosConfirmados);
    console.log(casosSuspeitos);

    if(casosSuspeitos.length == 0){
        $("#barChartSuspeitosInfoInfo").html('<span class="text-danger"><b>Sem dados para montar o gráfico !</b></span>');
    }

    if(casosConfirmados.length == 0){
        $("#barChartConfirmadosInfo").html('<span class="text-danger"><b>Sem dados para montar o gráfico !</b></span>');
    }

    var cidade = "<?= $session['cidade']; ?>";


    var barChartSuspeitos = function()
    {
        var barChartData = {
            labels: casosSuspeitosLabels,
            datasets: [
                {
                    label: "Casos suspeitos",
                    backgroundColor: color.warning._300,
                    borderColor: color.warning._500,
                    borderWidth: 1,
                    data: casosSuspeitos,
                }]

        };
        var config = {
            type: 'bar',
            data: barChartData,
            options:
                {
                    responsive: true,
                    legend:
                        {
                            position: 'top',
                        },
                    title:
                        {
                            display: false,
                            text: 'Bar Chart'
                        },
                    scales:
                        {
                            xAxes: [
                                {
                                    display: true,
                                    scaleLabel:
                                        {
                                            display: false,
                                            labelString: '6 months forecast'
                                        },
                                    gridLines:
                                        {
                                            display: true,
                                            color: "#f2f2f2"
                                        },
                                    ticks:
                                        {
                                            beginAtZero: true,
                                            fontSize: 11
                                        }
                                }],
                            yAxes: [
                                {
                                    display: true,
                                    scaleLabel:
                                        {
                                            display: false,
                                            labelString: 'Profit margin (approx)'
                                        },
                                    gridLines:
                                        {
                                            display: true,
                                            color: "#f2f2f2"
                                        },
                                    ticks:
                                        {
                                            beginAtZero: true,
                                            fontSize: 11,
                                            stepSize: 1,
                                            precision: 1,
                                        }
                                }]
                        }
                }
        }
        new Chart($("#barChartSuspeitos > canvas").get(0).getContext("2d"), config);
    }





    var barChartConfirmados = function()
    {



        var barChartData = {
            labels: casosConfirmadosLabels,
            datasets: [
                {
                    label: "Casos confirmados",
                    backgroundColor: color.danger._300,
                    borderColor: color.danger._500,
                    borderWidth: 1,
                    data: casosConfirmados,

                },
               ]

        };
        var config = {
            type: 'bar',
            data: barChartData,
            options:
                {
                    responsive: true,
                    legend:
                        {
                            position: 'top',
                        },
                    title:
                        {
                            display: false,
                            text: 'Bar Chart'
                        },
                    scales:
                        {
                            xAxes: [
                                {
                                    display: true,
                                    scaleLabel:
                                        {
                                            display: false,
                                            labelString: '6 months forecast'
                                        },
                                    gridLines:
                                        {
                                            display: true,
                                            color: "#f2f2f2"
                                        },
                                    ticks:
                                        {
                                            beginAtZero: true,
                                            fontSize: 11
                                        }
                                }],
                            yAxes: [
                                {
                                    display: true,
                                    scaleLabel:
                                        {
                                            display: false,
                                            labelString: 'Profit margin (approx)'
                                        },
                                    gridLines:
                                        {
                                            display: true,
                                            color: "#f2f2f2"
                                        },
                                    ticks:
                                        {
                                            beginAtZero: true,
                                            fontSize: 11,
                                            stepSize: 1,
                                            precision: 1,
                                        }
                                }]
                        }
                }
        }
        new Chart($("#barChartConfirmados > canvas").get(0).getContext("2d"), config);
    }



    /* pie chart */
    var pieChart = function(data, labels)
    {


        var config = {
            type: 'pie',
            data:
                {
                    datasets: [
                        {
                            data: data,
                            backgroundColor: [
                                color.primary._200,
                                color.primary._400,
                                color.success._50,
                                color.success._300,
                                color.success._500
                            ],
                            label: 'My dataset' // for legend
                        }],
                    labels: labels
                },
            options:
                {
                    responsive: true,
                    legend:
                        {
                            display: true,
                            position: 'bottom',
                        }
                }
        };
        new Chart($("#pieChart > canvas").get(0).getContext("2d"), config);
    }
    /* pie chart -- end */

    /* initialize all charts */
    $(document).ready(function()
    {
        var data = [
            0,
            2,
            1,
            2,
            1
        ];
        var labels = ["1 até 10 anos", "10 até 20 anos", "20 até 40 anos", "40 até 70", "> 70"];
        barChartConfirmados();
        barChartSuspeitos()
        pieChart(data, labels);

    });
</script>

</body>
</html>
