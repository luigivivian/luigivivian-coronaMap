<style>

.frame{
    height: 100rem !important;
}

</style>
<body>
<?php $this->load->view('menu');?>

<div class="container-fluid">
    <object class="frame" data="https://covid.saude.gov.br/" width="100%" height="100rem">
        <embed src="https://covid.saude.gov.br/" width="100%"> </embed>
        Error: Embedded data could not be displayed.
    </object>
</div>

</body>
