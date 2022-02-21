<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('login') == FALSE){
			redirect('auth');
		}
	}
	public function index(){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$data['title'] = 'User | Staf';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->routerosapi->write('/ip/hotspot/user/getall');
			$data['staf'] = $this->routerosapi->read();
			$data['stafshow'] = $this->StafModel->show_staf();
			$this->routerosapi->disconnect();
			$this->load->view('admin/staf/staf', $data);
		}
		$this->load->view('templates/footer');
	}
	public function form_tambah_staf(){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$data['title'] = 'Form Tambah';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->routerosapi->write('/ip/hotspot/user/getall');
			$data['user'] = $this->routerosapi->read();
			$this->routerosapi->disconnect();
			$this->load->view('admin/staf/form_tambah_staf', $data);
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
			$this->StafModel->add_staf($data_db, 'staf');
			$this->routerosapi->disconnect();
			$this->session->set_flashdata('message','Data berhasil ditambahkan!');
			redirect('staf');
		}
	}
	public function form_edit_staf($id){
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
			$this->load->view('admin/staf/form_edit_staf', $data);
			$this->load->view('templates/footer');
		}
	}
	public function update_staf(){
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
			$this->StafModel->proses_edit_staf($where, $data_d, 'staf');
			$this->routerosapi->disconnect();
			$this->session->set_flashdata('message','Data berhasil diperbaharui !!');
			redirect('staf');
		}
	}
	public function delete_staf($id){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$this->routerosapi->write('/ip/hotspot/user/remove',false);
			$this->routerosapi->write('=.id='.$id);
			$hotspot_users = $this->routerosapi->read();
			$where = array ('name' => $id);
			$this->StafModel->proses_hapus_staf($where,'staf');
			$this->routerosapi->disconnect();	
			$this->session->set_flashdata('message','Data berhasil dihapus!');
			redirect('staf');
		}
	}
	public function enabled_staf($id){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$this->routerosapi->write('/ip/hotspot/user/enable',false);
			$this->routerosapi->write('=.id='.$id);
			$hotspot_users = $this->routerosapi->read();
			$this->routerosapi->disconnect();	
			$this->session->set_flashdata('message','Data berhasil diaktifkan!');
			redirect('staf');
		}
	}
	public function disabled_staf($id){		
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$this->routerosapi->write('/ip/hotspot/user/disable',false);
			$this->routerosapi->write('=.id='.$id);
			$hotspot_users = $this->routerosapi->read();
			$this->routerosapi->disconnect();	
			$this->session->set_flashdata('message','Data berhasil dinonaktifkan!');
			redirect('staf');
		}
	}
}