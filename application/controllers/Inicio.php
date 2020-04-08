<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Inicio extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_paciente');
        $this->load->model('m_estado');
	}

	public function index(){
		$logado = $this->session->userdata('logged_in');
		if($logado == TRUE){
			$dados['condicoes'] = $this->m_paciente->getCondicao();
			$dados['estados'] = $this->m_estado->getAll();
			$dados['session'] = $this->session->userdata();
            $this->template->load('app', 'visualizar', $dados);
		}else{
            $dados['estados'] = $this->m_estado->getAll();
            $this->template->load('app', 'usuario/login', $dados);
        }
	}

	public function cadastrar(){
        $dados['condicoes'] = $this->m_paciente->getCondicao();
        $dados['estados'] = $this->m_estado->getAll();
        $dados['session'] = $this->session->userdata();
        $this->template->load('app', 'paciente/cadastrar', $dados);
	}


}
