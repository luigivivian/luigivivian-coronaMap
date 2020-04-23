<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Grafico extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_usuario');
		$this->load->model('m_paciente');
        $this->load->model('m_cidade');
        $this->load->model('m_estado');

	}


	public function index($mensagem = null)
	{
        // faixa etaria
        $intervals = array(
            '10_20' => array(10,20),
            '20_30' => array(20,30),
            '30_50' => array(30,50),
            '60_150' => array(60, 150),
        );
        $idCidade = $this->session->userdata('id_cidade');
		$dados['estados'] = $this->m_estado->getAll();
        $dados['session'] = $this->session->userdata();
		$dados['casosConfirmados'] = $this->m_paciente->getDadosGrafico($idCidade, GRAFICO_CASOS_CONFIRMADOS);
        $dados['casosSuspeitos'] = $this->m_paciente->getDadosGrafico($idCidade, GRAFICO_CASOS_SUSPEITOS);

        foreach ($intervals as $key => $interval) {
            $casosByIdade[$key] = $this->m_paciente->getPacientesByFaixaEtaria(CONDICAO_COVID_SUSPEITO, $idCidade, $interval);
        }
        $dados['faixaEtariaCasosSuspeitos'] = $casosByIdade;

        if($dados['casosSuspeitos'] != false){
            $dados['casosSuspeitosLabels'] = array();
            foreach ($dados['casosSuspeitos'] as $d){
                array_push($dados['casosSuspeitosLabels'], date('d/m', strtotime($d['data'])));
            }
        }

        if($dados['casosConfirmados'] != false){
            $dados['casosConfirmadosLabels'] = array();
            foreach ($dados['casosConfirmados'] as $d){
                array_push($dados['casosConfirmadosLabels'], date('d-m-Y', strtotime($d['data'])));
            }
        }



		$this->load->view('graficos/index', $dados);
	}




}
