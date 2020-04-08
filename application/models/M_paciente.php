<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Paciente extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

	}

    public function getTotalPacientesByCondicao(){
        $query = $this->db->query("SELECT c.id, c.nome, c.cor,  count(c.id) as total from gmap_paciente p
                                    INNER JOIN gmap_tipoCondicao c
                                    ON p.idCondicao = c.id
                                    group by c.id
                                    order by c.nome ASC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function getPacientesECondicoes(){
        $query = $this->db->query("SELECT p.id, c.nome as cnome, c.cor, p.nome as pnome, p.sobrenome, p.telefone, p.datanascimento, current_date as dataAtual
                                from gmap_paciente p
                                INNER JOIN gmap_tipoCondicao c
                                ON p.idCondicao = c.id
                                order by c.nome ASC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

	public function get($id = null, $idCidade= null)
	{
		if (!empty($id) && !empty($idCidade)) {
			$query = $this->db->query("SELECT td.cor,td.nome as doencanome, u.endereco, u.datanascimento, td.descricao, u.id, u.idCondicao, u.lat, u.lng, u.nome, u.numero, u.sobrenome, u.rua, u.telefone, u.idCidade
                                from gmap_paciente u
                                INNER JOIN gmap_tipoCondicao td
                                ON u.idCondicao = td.id
                                WHERE u.id = $id and u.idCidade = $idCidade");
			if ($query->num_rows() === 1) {
				return $query->row_array();
			} else {
				return false;
			}
		} else {
			$query = $this->db->query("SELECT td.cor, td.nome as doencanome, u.datanascimento, td.descricao, u.id, u.idCondicao, u.lat, u.lng, u.nome, u.numero, u.sobrenome, u.rua, u.telefone
                                from gmap_paciente u
                                INNER JOIN gmap_tipoCondicao td
                                ON u.idCondicao = td.id where u.idCidade = $idCidade");
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return false;
			}
		}
	}

	public function getByIdCondicao($id)
	{
		$query = $this->db->query("SELECT td.cor,td.nome as doencanome, u.datanascimento, td.descricao, u.id, u.idCondicao, u.lat, u.lng, u.nome, u.numero, u.sobrenome, u.rua, u.telefone
                                from gmap_paciente u
                                INNER JOIN gmap_tipoCondicao td
                                ON u.idCondicao = td.id
                                WHERE td.id = $id");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}

	}

	public function getCondicao(){
		$query = $this->db->query("SELECT *
                                from gmap_tipoCondicao");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}


	public function store($table, $dados)
	{
		return $this->db->insert($table, $dados);
	}

	public function update($id, $p)
	{
		$this->db->set($p)->where('id', $id)->update('gmap_paciente');

		if ($this->db->affected_rows() === 1) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($id)
	{
		$this->db->where('id', $id)->delete('gmap_paciente');
		if ($this->db->affected_rows() === 1) {
			return true;
		} else {
			return false;
		}
	}


	public function getDadosGrafico($idCidade, $grafico){

	    if($grafico == GRAFICO_CASOS_CONFIRMADOS){

	        $condicoes = array(CONDICAO_COVID_CONFIRMADO, CONDICAO_COVID_CONFIRMADO_RISCO);
            $query = $this->db->query("select count(id) as total, DATE(created_at) AS data
                                        from gmap_paciente gp
                                        where (`idCondicao` = $condicoes[0] or `idCondicao` = $condicoes[1]) and `idCidade` = $idCidade
                                        GROUP BY DATE(created_at);"
            );
            if($idCidade == null){
                $query = $this->db->query("select count(id) as total, DATE(created_at) AS data
                                        from gmap_paciente gp
                                        where (`idCondicao` = $condicoes[0] or `idCondicao` = $condicoes[1])
                                        GROUP BY DATE(created_at);"
                );
            }

            if ($query->num_rows() < 5) {
                return false;
            }
            return $query->result_array();
        }

        if($grafico == GRAFICO_CASOS_SUSPEITOS){
            $idCondicao = CONDICAO_COVID_SUSPEITO;
            $query = $this->db->query("select count(id) as total, DATE(created_at) AS data
                                        from gmap_paciente gp
                                        where `idCondicao` = $idCondicao and `idCidade` = $idCidade
                                        GROUP BY DATE(created_at);"
            );
            if($idCidade == null){
                $query = $this->db->query("select count(id) as total, DATE(created_at) AS data
                                        from gmap_paciente gp
                                        where `idCondicao` = $idCondicao
                                        GROUP BY DATE(created_at);"
                );
            }
            if ($query->num_rows() < 5) {
                return false;
            }
            return $query->result_array();
        }


    }


}
