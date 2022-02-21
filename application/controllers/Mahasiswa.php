<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('login') == FALSE){
			redirect('auth');
		}
	}
	public function index(){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$data['title'] = 'User | Mahasiswa';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->routerosapi->write('/ip/hotspot/user/getall');
			$data['user'] = $this->routerosapi->read();
			$this->routerosapi->disconnect();
			$data['mahasiswa'] = $this->MahasiswaModel->show_mhs();
			$this->load->view('admin/mahasiswa/mahasiswa', $data);
			$this->load->view('templates/footer');
		}
	}
	public function form_tambah_mhs(){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$data['title'] = 'Form Tambah';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->routerosapi->write('/ip/hotspot/user/getall');
			$data['user'] = $this->routerosapi->read();
			$this->routerosapi->disconnect();
			$this->load->view('admin/mahasiswa/form_tambah_mhs', $data);
			$this->load->view('templates/footer');
		}
	}
	public function add_user(){
		$server 	= $this->input->post('server');			
		$name 		= $this->input->post('name');
		$password 	= $this->input->post('password');
		$profile 	= $this->input->post('profile');
		$disabled 	= $this->input->post('disabled');
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){

			$this->routerosapi->write('/ip/hotspot/user/add',false);
			$this->routerosapi->write('=server='.$server, false);
			$this->routerosapi->write('=name='.$name, false);
			if (!empty($password)){
				$this->routerosapi->write('=password='.$password, false);
			}
			$this->routerosapi->write('=profile='.$profile, false);
			$this->routerosapi->write('=disabled='.$disabled);
			$data['user'] = $this->routerosapi->read();
			$data_db = array(
				'server' 		=> $server,
				'name' 			=> $name,
				'password' 		=> $password,
				'profile' 		=> $profile,
				'status' 		=> $disabled,
			);
			$this->MahasiswaModel->add_mhs($data_db, 'mahasiswa');
			$this->routerosapi->disconnect();
			$this->session->set_flashdata('message','Data berhasil ditambahkan!');
			redirect('mahasiswa');
		}
	}
	public function form_edit_mhs($id){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$data['title'] = 'Form Edit Mahasiswa';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->routerosapi->write("/ip/hotspot/user/print", false);		
			$this->routerosapi->write("=.proplist=.id", false);
			$this->routerosapi->write("=.proplist=server", false);
			$this->routerosapi->write("=.proplist=name", false);
			$this->routerosapi->write("=.proplist=password", false);		
			$this->routerosapi->write("=.proplist=mac-address", false);
			$this->routerosapi->write("=.proplist=profile", false);
			$this->routerosapi->write("=.proplist=comment", false);		
			$this->routerosapi->write("=.proplist=disabled", false);		
			$this->routerosapi->write("?name=$id");

			$data['edit'] = $this->routerosapi->read();
			$this->routerosapi->disconnect();
			$this->session->set_userdata('id',$id);
			$this->load->view('admin/mahasiswa/form_edit_mhs', $data);
			$this->load->view('templates/footer');
		}
	}
	public function update_mhs(){
		$id 		= $this->input->post('id');	
		$id_mysql	= $this->input->post('id_mysql');	
		$server 	= $this->input->post('server');	
		$name 		= $this->input->post('name');
		$password 	= $this->input->post('password');
		$profile 	= $this->input->post('profile');
		$disabled 	= $this->input->post('disabled');
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$this->routerosapi->write('/ip/hotspot/user/set',false);				
			$this->routerosapi->write('=.id='.$id,false);
			$this->routerosapi->write('=server='.$server,false);										
			$this->routerosapi->write('=name='.$name, false);				
			$this->routerosapi->write('=password='.$password, false);							
			$this->routerosapi->write('=profile='.$profile, false);					
			$this->routerosapi->write('=disabled='.$disabled);
			$data['edit'] = $this->routerosapi->read();
			$data_d = array(
				'id' 			=> $id,
				'server' 		=> $server,
				'name' 			=> $name,
				'password' 		=> $password,
				'profile' 		=> $profile,
				'status' 		=> $disabled,
			);

			$where = array('name' => $id_mysql);
			$this->MahasiswaModel->proses_edit_mhs($where, $data_d, 'mahasiswa');
			$this->routerosapi->disconnect();
			$this->session->set_flashdata('message','Data berhasil diperbaharui !!');
			redirect('mahasiswa');
		}
	}
	public function delete_mhs($id){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$this->routerosapi->write('/ip/hotspot/user/remove',false);
			$this->routerosapi->write('=.id='.$id);
			$hotspot_users = $this->routerosapi->read();
			$where = array ('name' => $id);
			$this->MahasiswaModel->proses_hapus_mhs($where,'mahasiswa');
			$this->routerosapi->disconnect();
			$this->session->set_flashdata('message','Data berhasil dihapus!');
			redirect('mahasiswa');
		}
	}
	public function enabled_mhs($id){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$this->routerosapi->write('/ip/hotspot/user/enable',false);
			$this->routerosapi->write('=.id='.$id);
			$hotspot_users = $this->routerosapi->read();
			$this->routerosapi->disconnect();	
			$this->session->set_flashdata('message','Data berhasil diaktifkan!');
			redirect('mahasiswa');
		}
	}
	public function disabled_mhs($id){		
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$this->routerosapi->write('/ip/hotspot/user/disable',false);
			$this->routerosapi->write('=.id='.$id);
			$hotspot_users = $this->routerosapi->read();
			$this->routerosapi->disconnect();	
			$this->session->set_flashdata('message','Data berhasil dinonaktifkan!');
			redirect('mahasiswa');
		}
	}
}