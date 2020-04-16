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
            $query = $this->db->query("select * from gmap_unidade where idCidade = $idCidade and id = $id;");
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
