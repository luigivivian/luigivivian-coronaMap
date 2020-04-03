<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cidade extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function getAllByEstado($idEstado){
        $query = $this->db->select('*')->from('gmap_cidade')->where('idEstado', $idEstado)->get();
        return $query->result_array();
    }

    public function get($id = null){
        if(!empty($id)){
            $query = $this->db->select('*')->from('gmap_cidade')->where('id', $id)->get();
            if($query->num_rows() === 1){
                return $query->row_array();
            }
            return false;
        }

        $query = $this->db->select('*')->from('gmap_cidade')->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }

    public function getData($id){
        $query = $this->db->query("SELECT c.nome as cidade, e.nome as estado_nome from gmap_cidade c inner join gmap_estado e on c.idEstado = e.id where c.id = $id;");
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


}
