<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_unidade extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get($id = null, $idCidade= null)
    {
        if (!empty($id) && !empty($idCidade)) {
            $query = $this->db->query("select * from gmap_unidade where idCidade = $idCidade and id = $id and (total_confirmados > 0 or total_suspeitos > 0 or total_curados > 0) ;");
            if ($query->num_rows() === 1) {
                return $query->row_array();
            } else {
                return false;
            }
        } else {
            $query = $this->db->query("select * from gmap_unidade;");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        }
    }

    public function geyUnidadeByIdCidade($id){
	    if(empty($id))
	        return false;
        $query = $this->db->query("select * from gmap_unidade where idCidade = $id and (total_pacientes_confirmados > 0 or total_pacientes_suspeitos > 0 or total_pacientes_curados > 0) ;");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }




    public function atualizarDadosUnidades($idCidade){

	    $selectUnidades = $this->db->query("select id from gmap_unidade gu where idCidade = $idCidade;");
        $unidades = $selectUnidades->result_array();
        if(empty($unidades)){
            return false;
        }
        $suspeitosConst = array(CONDICAO_COVID_SINDROME_GRIPAL, CONDICAO_COVID_SUSPEITO);
        $confirmadosConst = array(CONDICAO_COVID_CONFIRMADO_2, CONDICAO_COVID_CONFIRMADO);
        $curadosConst = CONDICAO_COVID_CURADO;
        $newUnidades = array();

        foreach($unidades as $uKey=>$u) {
            $id = intval($u['id']);
            $newUnidades[$id]['id'] = $id;
            $newUnidades[$id]['total_pacientes_suspeitos'] = 0;
            $newUnidades[$id]['total_pacientes_confirmados'] = 0;
            $newUnidades[$id]['total_pacientes_curados'] = 0;
        }
        $selectTotalCasosSuspeitos = $this->db->query("select count(id) as total_pacientes_suspeitos, `idUnidade`
                                                        from gmap_paciente gp
                                                        where idCidade = $idCidade and (idCondicao = $suspeitosConst[0] or idCondicao = $suspeitosConst[1])
                                                        group by idUnidade;");
        if ($selectTotalCasosSuspeitos->num_rows() > 0) {
            $totalCasosSuspeitos = $selectTotalCasosSuspeitos->result_array();
            foreach($unidades as $uKey=>$u) {
                foreach($totalCasosSuspeitos as $cKey=>$caso) {
                    $idUnidade = $caso['idUnidade'];
                    if($u['id'] === $idUnidade){
                        $id = intval($caso['idUnidade']);
                        $newUnidades[$id]['total_pacientes_suspeitos'] = intval($caso['total_pacientes_suspeitos']);
                    }
                }
            }
        }
        $selectTotalCasosConfirmados = $this->db->query("select count(id) as total_pacientes_confirmados, `idUnidade`
                                                        from gmap_paciente gp
                                                        where idCidade = $idCidade and (idCondicao = $confirmadosConst[0] or idCondicao = $confirmadosConst[1])
                                                        group by idUnidade;");
        if ($selectTotalCasosConfirmados->num_rows() > 0) {
            $totalCasosConfirmados = $selectTotalCasosConfirmados->result_array();
            foreach($unidades as $uKey=>$u) {
                foreach($totalCasosConfirmados as $cKey=>$caso) {
                    $idUnidade = $caso['idUnidade'];
                    if($u['id'] === $idUnidade){
                        $id = intval($caso['idUnidade']);
                        $newUnidades[$id]['total_pacientes_confirmados'] = intval($caso['total_pacientes_confirmados']);
                    }
                }
            }
        }

        $selectTotalCasosCurados = $this->db->query("select count(id) as total_pacientes_curados, `idUnidade`
                                                        from gmap_paciente gp
                                                        where idCidade = $idCidade and idCondicao = $curadosConst
                                                        group by idUnidade;");
        if ($selectTotalCasosCurados->num_rows() > 0) {
            $totalCasosCurados = $selectTotalCasosCurados->result_array();
            foreach($unidades as $uKey=>$u) {
                foreach($totalCasosCurados as $cKey=>$caso) {
                    $idUnidade = $caso['idUnidade'];
                    if($u['id'] === $idUnidade){
                        $id = intval($caso['idUnidade']);
                        $newUnidades[$id]['total_pacientes_curados'] = intval($caso['total_pacientes_curados']);
                    }
                }
            }
        }
        $update = $this->db->update_batch('gmap_unidade', $newUnidades, 'id');
        return $update;
    }

    public function getTotalPacientesGroupByUnidade($condicao = null, $idCidade= null)
    {
        if (!empty($id) && !empty($idCidade)) {
            $query = $this->db->query("select * from gmap_unidade where idCidade = $idCidade and id = $id;");
            if ($query->num_rows() === 1) {
                return $query->row_array();
            } else {
                return false;
            }
        }

    }



    public function getAll($idCidade){
	    if(empty($idCidade)){
	        return false;
        }
        $query = $this->db->select('*')->where('idCidade', $idCidade)->from('gmap_unidade')->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

	public function store($table, $dados)
	{
		return $this->db->insert($table, $dados);
	}


}
