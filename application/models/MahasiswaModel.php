<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class MahasiswaModel extends CI_Model
{
	public function show_mhs(){
		$query = $this->db->query("SELECT * FROM mahasiswa");
		return $query->result();
	}
	public function add_mhs($data_db, $table){
		$this->db->insert($table,$data_db);
	}
	public function proses_edit_mhs($where, $data_d, $table){
		$this->db->where($where);
		$this->db->update($table, $data_d);
	}
	public function proses_hapus_mhs($where, $table){
		$this->db->where($where);
		$this->db->delete($table);
	}
}

?>