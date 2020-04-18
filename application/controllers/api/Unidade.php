<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Unidade extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_unidade');
	}


	public function unidades_get(){ //index
        if(empty($idCidade)){
            $usuarios = $this->m_unidade->get();
            $this->response(array('response' => $usuarios), 200);
        }else{
            $usuarios = $this->m_unidade->get();
            $this->response(array('response' => $usuarios), 200);
        }
	}



	public function id_get($id){
		if(!$id){
			$this->response(null, 400);
		}else{
			$usuarios = $this->m_unidade->get($id);
			if(!is_null($usuarios)){
				$this->response(array('response' => $usuarios), 200);
			}else{
				$this->response(array('error' => 'Unidade não encontrada...'), 404);
			}
		}
	}
	public function index_post(){ //funcao para salvar formulario no banco de dados
		if(!$this->post()){ //se formulario for nulo dispara erro.
			$this->response(null, 400); //erro 400
		}
        $data = $this->post();
        unset($data['endereco']);

        $this->load->library('form_validation');
        $rules = array(
            array(
                'field' => 'lat',
                'label' => 'lat',
                'rules' => 'required'
            ),
            array(
                'field' => 'lng',
                'label' => 'lng',
                'rules' => 'required'
            ),
            array(
                'field' => 'nome',
                'label' => 'nome',
                'rules' => 'required|max_length[200]'
            ),
            array(
                'field' => 'bairro',
                'label' => 'bairro',
                'rules' => 'required|max_length[200]'
            ),
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Campo obrigatorio não informado !');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('error', 'Preencha todos os dados'), 400);
        }

        $query = $this->m_unidade->store('gmap_unidade',$data); //armazena dados no database

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
