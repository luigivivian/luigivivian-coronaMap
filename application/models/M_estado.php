<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_estado extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function getAll(){
        $query = $this->db->select('*')->from('gmap_estado')->get();
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
