<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class StafModel extends CI_Model
{
	public function show_staf(){
		$query = $this->db->query("SELECT * FROM staf");
		return $query->result();
	}
	public function add_staf($data_db, $table){
		$this->db->insert($table,$data_db);
	}
	public function proses_edit_staf($where, $data_d, $table){
		$this->db->where($where);
		$this->db->update($table, $data_d);
	}
	public function proses_hapus_staf($where, $table){
		$this->db->where($where);
		$this->db->delete($table);
	}
}

?>