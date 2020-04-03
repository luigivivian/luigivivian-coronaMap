<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_usuario extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get($id = null){
		if(!is_null($id)){
			$query = $this->db->query("SELECT *
								FROM gmap_usuario
                                WHERE id = $id");
			if($query->num_rows() === 1){
				return $query->row_array();
			}else{
				return false;
			}
		}else{
			$query = $this->db->query("SELECT * FROM gmap_usuario");
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
		$this->db->set($p)->where('id', $id)->update('gmap_usuario');

		if($this->db->affected_rows() === 1){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){
		$this->db->where('id', $id)->delete('gmap_usuario');
		if($this->db->affected_rows() === 1){
			return true;
		}else{
			return false;
		}

	}

	public function validarDados($login, $senha){
		return $this->db->get_where('gmap_usuario', array('login' => $login, 'senha' => $senha));
	}

	public function getByLogin($login){
		return $this->db->get_where('gmap_usuario', array('login' => $login));
	}

}
