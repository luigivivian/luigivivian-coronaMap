<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Condicao extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get($id = null){
		if(!is_null($id)){
			$query = $this->db->select('*')->from('gmap_tipoCondicao')->where('id', $id)->get();
			if($query->num_rows() === 1){
				return $query->row_array();
			}else{
				return false;
			}
		}else{
			$query = $this->db->select('*')->from('gmap_tipoCondicao')->get();
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}
	}
	public function store($table, $dados)
	{
		return $this->db->insert($table, $dados);
	}

	public function update($id, $p){
		$this->db->set($p)->where('id', $id)->update('gmap_tipoCondicao');

		if($this->db->affected_rows() === 1){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){
		$this->db->where('id', $id)->delete('gmap_tipoCondicao');
		if($this->db->affected_rows() === 1){
			return true;
		}else{
			return false;
		}

	}






}
