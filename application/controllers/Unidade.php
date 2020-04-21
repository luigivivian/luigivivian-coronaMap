<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Unidade extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_paciente');
        $this->load->model('m_unidade');
	}



	public function index(){

        $this->m_unidade->atualizarDadosUnidades(1);
    }


	public function cadastrar($id = null)
	{
        $id_cidade = $this->session->userdata('id_cidade');
        $dados["session"] = $this->session->userdata();
        if($id_cidade == null){
            redirect('usuario/logout');
        }

        $this->template->load('app', 'unidades/cadastrar', $dados);
	}

}
