<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Usuario extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_usuario');
		$this->load->model('m_paciente');
        $this->load->model('m_cidade');
        $this->load->model('m_estado');
        $this->load->model('m_unidade');
	}


	public function index($mensagem = null)
	{
		$dados['title'] = "Área de login";
		if($mensagem)
		    $dados['mensagem'] = $mensagem;
		$dados['estados'] = $this->m_estado->getAll();
		$this->load->view('usuario/login', $dados);
	}

	///cadusuario
	public function cadastrar(){
		$this->load->library('form_validation');
		$rules = array(
			array(
				'field' => 'nome',
				'label' => 'nome',
				'rules' => 'required|max_length[200]'
			),
			array(
				'field' => 'sobrenome',
				'label' => 'sobrenome',
				'rules' => 'required|max_length[120]'
			),
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|max_length[120]'
			),
			array(
				'field' => 'senha',
				'label' => 'senha',
				'rules' => 'required|max_length[120]'
			),
			array(
				'field' => 'senha2',
				'label' => 'senha2',
				'rules' => 'required|max_length[120]'
			),
		);

		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Campo obrigatorio não informado !');

		if($this->form_validation->run() == FALSE){
			//dados nao corretos
		}else{
			if($this->input->post('senha') == $this->input->post('senha2')){
				$query = $this->m_usuario->getByLogin($this->input->post('login'));
				if($query->num_rows() > 0){
					$dados['msg'] = "Esse login já existe.";
					$dados['erro'] = 1;
					$this->load->view('usuario/login', $dados);
				}else{
					$dados = array(
						'nome' => $this->input->post('nome'),
						'sobrenome' => $this->input->post('sobrenome'),
						'email' => $this->input->post('email'),
						'login' => $this->input->post('login'),
						'celular' => $this->input->post('celular'),
						'idCidade' => $this->input->post('cidade'),
						'senha' => md5($this->input->post('senha'))
					);
					$this->m_usuario->store('gmap_usuario',$dados);
					$dados['msg'] = "Cadastro efetuado com sucesso !";
					$this->load->view('usuario/login', $dados);
				}
			}else{
				$dados['msg'] = "Senhas não conferem.";
				$dados['erro'] = 1;
				$this->load->view('usuario/login', $dados);
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
        $dados['estados'] = $this->m_estado->getAll();
		$this->load->view('usuario/login', $dados);
	}
	public function logar()
	{
		$this->load->library('form_validation');
		$rules = array(
			array(
				'field' => 'login',
				'label' => 'login',
				'rules' => 'required|max_length[200]'
			),
			array(
				'field' => 'senha',
				'label' => 'senha',
				'rules' => 'required|max_length[120]'
			),

		);
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Campo obrigatorio não informado !');

		if ($this->form_validation->run() == FALSE) {
			$dados['erro'] = 1;
			$dados['msg'] = "Preencha todos campos !";
			$this->load->view('usuario/login', $dados);
		} else {

			$query = $this->m_usuario->validarDados($this->input->post('login'), md5($this->input->post('senha')));
            $idCidade = $query->row('idCidade');

			if ($query->num_rows() > 0) {//logado com sucesso
                $cidade = $this->m_cidade->getData($idCidade);
				$adm = $query->row('medico');
				$data = array(
					'nome' => $query->row('nome'),
					'sobrenome' => $query->row('sobrenome'),
					'login' => $query->row('login'),
					'logged_in' => TRUE,
					'adm' => $adm,
                    'cidade' => !empty($cidade) ? $cidade[0]['cidade'] : null,
                    'estado' => !empty($cidade) ? $cidade[0]['estado_nome'] : null,
                    'id_cidade' => $idCidade
				);
				$this->session->set_userdata($data);
				$dados['session'] = $data;
				$dados['condicoes'] = $this->m_paciente->getCondicao();
				$this->m_unidade->atualizarDadosUnidades($idCidade);
				redirect('inicio');
			} else {    //dados incorretos
				$dados['erro'] = 1;
				$dados['msg'] = "Usuario ou Senha incorreto !";
				$this->load->view('usuario/login', $dados);
			}
		}
	}

	public function atualizarUnidades($idCidade){
        $dados = $this->m_unidade->atualizarDadosUnidades($idCidade);
        return var_dump($dados);
    }
}
