<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Governo extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
		$this->load->model('m_usuario');
		$this->load->model('m_paciente');
        $this->load->model('m_cidade');
        $this->load->model('m_estado');
	}


	public function index($mensagem = null)
	{
        $this->template->load('app', 'governo/details');

	}

}
