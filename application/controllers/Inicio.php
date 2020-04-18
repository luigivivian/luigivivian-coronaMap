<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Inicio extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_paciente');
        $this->load->model('m_estado');
        $this->load->model('m_unidade');
        $this->load->model('m_cidade');
	}

	public function index(){
		$logado = $this->session->userdata('logged_in');
		if($logado == TRUE){
            $dados['is_mobile'] = false;
            if($this->isMobile()){
                $dados['is_mobile'] = true;
            }
			$dados['condicoes'] = $this->m_paciente->getCondicao();
			$dados['estados'] = $this->m_estado->getAll();
			$dados['session'] = $this->session->userdata();
            return $this->template->load('app', 'visualizar', $dados);
		}else{
            $dados['estados'] = $this->m_estado->getAll();
            return redirect("inicio/publico");
            //return $this->template->load('app', 'usuario/login', $dados);
        }
	}



    public function cidade($idCidade=null){
        $logado = $this->session->userdata('logged_in');
        $dados['is_mobile'] = false;
        if($this->isMobile()){
            $dados['is_mobile'] = true;
        }
        $dados['unidades'] = $this->m_unidade->get();
        $dados['estados'] = $this->m_estado->getAll();
        $dados['session'] = $this->session->userdata();
        if(empty($idCidade)){
            return $this->template->load('app', 'mapa_publico/selecionar_cidade', $dados);
        }
        return redirect("inicio/publico/$idCidade");

    }

    public function publico($idCidade=null){

        $dados['is_mobile'] = false;
        if($this->isMobile()){
            $dados['is_mobile'] = true;
        }
        if(empty($idCidade)){
            return redirect("inicio/cidade/");
        }
        $dados['unidades'] = $this->m_unidade->get();
        $dados['estados'] = $this->m_estado->getAll();
        $dados['session'] = $this->session->userdata();
        $cidade = $this->m_cidade->getData($idCidade);
        if(!empty($cidade)){
            $dados['cidade'] = $cidade[0]['cidade'];
            $dados['estado'] = $cidade[0]['estado_nome'];
        }
        return $this->template->load('app', 'mapa_publico/visualizar', $dados);
    }

	public function cadastrar(){
	    $session = $this->session->userdata();
	    if(empty($session))
	        redirect('usuario');
        $dados['condicoes'] = $this->m_paciente->getCondicao();
        $dados['estados'] = $this->m_estado->getAll();
        $dados['unidades'] = $this->m_unidade->getAll($session['id_cidade']);
        $dados['session'] = $session;
        $this->template->load('app', 'paciente/cadastrar', $dados);
	}


	public function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

}
