<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('login') == FALSE)
		{
			redirect('auth');
		}
	}

	public function index(){
		if ($this->routerosapi->connect($this->session->userdata('hostname_mikrotik'), $this->session->userdata('username_mikrotik'), $this->session->userdata('password_mikrotik'))){
			$data['title'] = 'Mikrotik Control Panel | Admin';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/beranda', $data);
			$this->load->view('templates/footer');
		}
	}
}
