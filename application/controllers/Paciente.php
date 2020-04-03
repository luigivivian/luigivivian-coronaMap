<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Paciente extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_paciente');
	}

	public function pacientesByCondicao(){
        $query = $this->m_paciente->getTotalPacientesByCondicao();
        $dados['lista'] = $query;
        $this->load->view('relatorios/totalPacientesPorCondicao', $dados);
    }


    public function gerarPDFCondicoesPacientes(){
        $query = $this->m_paciente->getPacientesECondicoes();
        $dados['lista'] = $query;
        $this->load->view('relatorios/pacientesECondicoes', $dados);
        // Get output html
        $html = $this->output->get_output();
        // Load pdf library
        $this->load->library('pdf');
        // Load HTML content
        $this->dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $this->dompdf->render();
        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream("Pacientes e condições", array("Attachment"=>0));
    }

    public function gerarPDFPacientesByCondicao(){
        $query = $this->m_paciente->getTotalPacientesByCondicao();
        $dados['lista'] = $query;
        $this->load->view('relatorios/totalPacientesPorCondicao', $dados);
        // Get output html
        $html = $this->output->get_output();
        // Load pdf library
        $this->load->library('pdf');
        // Load HTML content
        $this->dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $this->dompdf->render();
        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream("Pacientes e condições", array("Attachment"=>0));
    }

	public function editar($id = null)
	{
        $id_cidade = $this->session->userdata('id_cidade');
		if(!$id){ //lista de usuario
			$pacientes = $this->m_paciente->get(null , $id_cidade);
			$dados['lista'] = true;
			$dados['pacientes'] = $pacientes;
			$this->load->view('paciente/editar', $dados);
		}else{
			$paciente = $this->m_paciente->get($id, $id_cidade);
			$dados['condicoes'] = $this->m_paciente->getCondicao();
			$dados['corPino'] = $paciente['cor'];
			$dados['lista'] = false;
			$dados['paciente'] = $paciente;
			$this->load->view('paciente/editarForm', $dados);
		}
	}

}
