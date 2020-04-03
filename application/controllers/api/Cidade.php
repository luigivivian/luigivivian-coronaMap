<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Cidade extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_cidade');
        $this->load->model('m_estado');
	}

	public function index_get($idEstado){ //index
        $cidades = $this->m_cidade->getAllByEstado($idEstado);
		if(!empty($cidades)){
			$this->response(array('response' => $cidades), 200);
		}else{
			$this->response(array('error' => 'Cidades não encontradas...'), 404);
		}
	}


}
