<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index(){
		$this->form_validation->set_rules('hostname', 'Hostname', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		if($this->form_validation->run() == false){
			$data['title'] = 'Login Mikotik Control Panel';
			$this->load->view('templates/auth_header.php', $data);
			$this->load->view('templates/login');
			$this->load->view('templates/auth_footer.php');
		}else{
			$this->_login();
		}
	}

	private function _login(){
		
		$hostname = $this->input->post('hostname');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->routerosapi->connect($hostname, $username, $password);

		if($cek){
			$data = array(
				'hostname_mikrotik'=> $hostname, 
				'username_mikrotik' => $username, 
				'password_mikrotik' => $password, 
				'login' => TRUE
			);
			$this->session->set_userdata($data);
			redirect('beranda');
		}else{
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Hostname, Username dan Password yang anda masukkan salah !!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}

	}

	public function logout(){
		$this->session->unset_userdata(array(
			'hostname_mikrotik' => '',
			'username_mikrotik' => '',
			'password_mikrotik' => '',
			'login' => FALSE
		));
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil Keluar <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('auth');
	}
}
