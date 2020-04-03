
<!--  inicio navbar-->
<style>

	.sidenav {
		height: 100%;
		width: 0;
		position: fixed;
		z-index: 1;
		top: 0;
		left: 0;
		overflow-x: hidden;
		transition: 0.5s;
		padding-top: 60px;
	}
	.navbar{
		font-size: 22px;
		height: 110px !important;
	}

	.navbar a:hover{
		border-left: 1px solid #00CFAA;
		border-right: 1px solid #00CFAA;
	}

	.sidenav a {
		padding: 8px 8px 8px 32px;
		text-decoration: none;
		font-size: 25px;
		color: #818181;
		display: block;
		transition: 0.3s;
	}

	.sidenav a:hover {
		color: #088C08;
	}
	.textNavbar{
		color: #088C08 !important;
	}
	.sidenav .closebtn {
		position: absolute;
		top: 0;
		right: 25px;
		font-size: 36px;
		margin-left: 50px;
	}

	@media screen and (max-height: 450px) {
		.sidenav {padding-top: 15px;}
		.sidenav a {font-size: 18px;}
	}

</style>
 <nav class="navbar bg-dark" role="navigation" aria-label="main navigation">
   <div class="navbar-brand">
     <span style="font-size:30px;cursor:pointer" class="navbar-item" onclick="openNav()"><p class="textNavbar">&#9776; Menu</p></span>
     <div class="navbar-burger">
       <span></span>
       <span></span>
       <span></span>
     </div>
   </div>
 </nav>
 <!-- Fim navbar -->
 <div id="mySidenav" class="sidenav bg-dark">
	 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	 <a href="<?= base_url();?>"><span><i class="fa fa-home"></i>    INICIO</span></a>
	 <a href="<?= base_url('paciente/editar');?>"><p><span><i class="fa fa-edit"></i>    EDITAR PACIENTES</span></p></a>
	 <a href="<?= base_url('condicao/editar');?>"><p><span><span><i class="fa fa-edit"></i>    EDITAR CONDIÇÕES</span></p></a>
	 <a href="<?= base_url('usuario/logout');?>"><p><span><span><i class="fa fa-sign-out-alt"></i>    SAIR</span></p></a>
 </div>

 <script>
 function openNav() {
     document.getElementById("mySidenav").style.width = "350px";
 }

 function closeNav() {
     document.getElementById("mySidenav").style.width = "0";
 }
 </script>
 <!--  Fim menu drawer-->
