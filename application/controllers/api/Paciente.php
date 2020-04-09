<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Paciente extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_paciente');
	}

	public function index_get(){ //index
		$usuarios = $this->m_paciente->get();
		if(!is_null($usuarios)){
			$this->response(array('response' => $usuarios), 200);
		}else{
			$this->response(array('error' => 'Usuario não encontrada...'), 404);
		}
	}

	public function pinos_get($id, $idCidade){ //index
		if(!$id){
			if($id == 0){
				$usuarios = $this->m_paciente->get(null, $idCidade);
				$this->response(array('response' => $usuarios), 200);
			}else{
				$usuarios = $this->m_paciente->get($id, $idCidade);
				$this->response(array('response' => $usuarios), 200);
			}

		}else{
			$usuarios = $this->m_paciente->getByIdCondicao($id, $idCidade);
			if(!is_null($usuarios)){
				$this->response(array('response' => $usuarios), 200);
			}else{
				$this->response(array('error' => 'Usuario não encontrada...'), 404);
			}
		}
	}



	public function id_get($id){
		if(!$id){
			$this->response(null, 400);
		}else{
			$usuarios = $this->m_paciente->get($id);
			if(!is_null($usuarios)){
				$this->response(array('response' => $usuarios), 200);
			}else{
				$this->response(array('error' => 'Usuario não encontrada...'), 404);
			}
		}
	}
	public function index_post(){ //funcao para salvar formulario no banco de dados
		if(!$this->post()){ //se formulario for nulo dispara erro.
			$this->response(null, 400); //erro 400
		}

        $this->load->library('form_validation');
        $rules = array(
            array(
                'field' => 'idCondicao',
                'label' => 'idCondicao',
                'rules' => 'required|max_length[200]'
            ),
            array(
                'field' => 'datanascimento',
                'label' => 'datanascimento',
                'rules' => 'required|max_length[200]'
            ),
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Campo obrigatorio não informado !');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('error', 'Preencha todos os dados'), 400);
        }
        $data = $this->post();
        $data['datanascimento'] = date('Y-m-d', strtotime($data['datanascimento']));
        $query = $this->m_paciente->store('gmap_paciente',$data); //armazena dados no database

        if(is_null($query)){ //caso os dados forem armazenados com sucesso
            $this->response(array('error', 'Erro no servidor'), 400);
        }
        $this->response(array('response' => $query), 200); //retorna estado da operaçao
	}

	public function index_put($id){

		if(!$this->put() || !$id){
			$this->response(null, 400);
		}else{
			$query = $this->m_paciente->update($id, $this->put());

			if(!is_null($query)){
				$this->response(array('response' => $query), 200);
			}else{
				$this->response(array('error', 'Erro no servidor'), 400);
			}
		}
	}


}
