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
		}else{ //caso contrario
			$query = $this->m_paciente->store('gmap_paciente',$this->post()); //armazena dados no database
			if(!is_null($query)){ //caso os dados forem armazenados com sucesso
				$this->response(array('response' => $query), 200); //retorna estado da operaçao
			}else{ //caso der pau dispara erro
				$this->response(array('error', 'Erro no servidor'), 400);
			}
		}
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
	public function index_delete($id){
		if(!$id){
			$this->response(null, 400);
		}else{
			$query = $this->m_paciente->delete($id, $this->post('planta'));
			if(!is_null($query)){
				$this->response(array('response' => 'Planta deletada com sucesso'), 200);
			}else{
				$this->response(array('error', 'Algo esta faltando no servidor'), 400);
			}
		}
	}



}
