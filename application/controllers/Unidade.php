<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Unidade extends CI_Controller{

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
		$this->load->model('m_paciente');
        $this->load->model('m_unidade');
	}



	public function index(){

        $this->m_unidade->atualizarDadosUnidades(1);
    }

    public function editar($id = null)
    {
        $id_cidade = $this->session->userdata('id_cidade');
        $dados["session"] = $this->session->userdata();
        if($id_cidade == null){
            return redirect('usuario/logout');
        }
        if(!$id){ //lista de usuario
            $unidades = $this->m_unidade->get(null , $id_cidade);
            $dados['lista'] = true;
            $dados['unidades'] = $unidades;
            return $this->template->load('app', 'unidades/editar', $dados);
        }else{
            $unidade = $this->m_unidade->get($id, $id_cidade);
            $dados['lista'] = false;
            $dados['unidade'] = $unidade;
            return  $this->template->load('app', 'unidades/editarForm', $dados);
        }
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
