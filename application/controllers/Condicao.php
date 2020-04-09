<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Condicao extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_condicao');
	}


    public function testepdf(){
        $this->load->view('relatorios/totalPacientesPorCondicao');

        // Get output html
        $html = $this->output->get_output();

        // Load pdf library
        $this->load->library('pdf');

        // Load HTML content
        $this->dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $this->dompdf->render();

        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
    }
	public function editar($id = null)
	{
		if(!$id){ //lista de usuario
			$condicao = $this->m_condicao->get();
			$dados['lista'] = true;
			$dados['condicoes'] = $condicao;

            $this->template->load('app', 'condicao/editar', $dados);
		}else{
			$condicao = $this->m_condicao->get($id);
			$dados['lista'] = false;
			$dados['condicao'] = $condicao;
			//$this->load->view('condicao/editar', $dados);
            $this->template->load('app', 'condicao/editar', $dados);
		}
	}

	public function deletar($id = null){
            $query = $this->m_condicao->delete($id);
            $condicao = $this->m_condicao->get();
            $dados['lista'] = true;
            $dados['condicoes'] = $condicao;
            //$this->load->view('condicao/editar', $dados);
            $this->template->load('app', 'condicao/editar', $dados);
    }

}
