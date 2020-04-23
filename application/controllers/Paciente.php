<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Paciente extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_paciente');
        $this->load->helper('url');

	}

	public function pacientesByCondicao(){
        $session = $this->session->userdata();
        if(empty($session)){
            return redirect("inicio/publico");
        }
        $idCidade = $session['id_cidade'];
        $query = $this->m_paciente->getTotalPacientesByCondicao($idCidade);
        $dados['lista'] = $query;
        $this->load->view('relatorios/totalPacientesPorCondicao', $dados);
    }


    public function gerarPDFCondicoesPacientes(){
        $session = $this->session->userdata();
        if(empty($session)){
            return redirect("inicio/publico");
        }

        $idCidade = $session['id_cidade'];
        $query = $this->m_paciente->getPacientesECondicoes($idCidade);
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
        $session = $this->session->userdata();

        if(empty($session)){
            return redirect("inicio/publico");
        }
        $idCidade = $session['id_cidade'];

        $query = $this->m_paciente->getTotalPacientesByCondicao($idCidade);
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
        $dados["session"] = $this->session->userdata();
        if($id_cidade == null){
            return redirect('usuario/logout');
        }
        $search = $this->input->get('search', false);
        if(!empty($search)){
          $pacientes = $this->m_paciente->search($search);
            $dados['lista'] = true;
            $dados['pacientes'] = $pacientes;
            return $this->template->load('app', 'paciente/editar', $dados);
        }

		if(!$id){ //lista de usuario
			$pacientes = $this->m_paciente->get(null , $id_cidade);
			$dados['lista'] = true;
			$dados['pacientes'] = $pacientes;
			$dados['total_pacientes_cadastrados'] = !empty($pacientes) ? count($pacientes) : 0;
            return $this->template->load('app', 'paciente/editar', $dados);
		}else{
			$paciente = $this->m_paciente->get($id, $id_cidade);
			$dados['condicoes'] = $this->m_paciente->getCondicao();
			$dados['corPino'] = $paciente['cor'];
			$dados['lista'] = false;
			$dados['paciente'] = $paciente;
            return  $this->template->load('app', 'paciente/editarForm', $dados);
		}
	}

}
