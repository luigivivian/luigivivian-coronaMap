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
            $dados['is_mobile'] = false;
            if($this->isMobile()){
                $dados['is_mobile'] = true;
            }
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


	public function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

}
