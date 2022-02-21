<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_user extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('login') == FALSE)
		{
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'User | Daftar User Aktif';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$this->routerosapi->write('/ip/hotspot/active/getall');
			$data['daftar'] = $this->routerosapi->read();
			$this->routerosapi->disconnect();
			$this->load->view('admin/daftar_user', $data);
		}
		$this->load->view('templates/footer');
	}
	public function hapus_user($id){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$this->routerosapi->write('/ip/hotspot/active/remove',false);
			$this->routerosapi->write('=.id='.$id);
			$hotspot_users = $this->routerosapi->read();
			$this->routerosapi->disconnect();	
			$this->session->set_flashdata('message','Data berhasil dihapus!');
			redirect('daftar_user');
		}
	}
}