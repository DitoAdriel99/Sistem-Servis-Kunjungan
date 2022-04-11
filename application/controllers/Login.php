<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model', 'm');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->load->view('viewLogin');
	}

	public function proses_login()
	{
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		
		$cekLogin = $this->m->login($user,$pass);

		if ($cekLogin) {
			foreach($cekLogin as $row);
			$this->session->set_userdata('id_user', $row->id_user);
			$this->session->set_userdata('username', $row->username);
			$this->session->set_userdata('no_hp', $row->no_hp);
			$this->session->set_userdata('alamat', $row->alamat);
			$this->session->set_userdata('foto', $row->foto);
			$this->session->set_userdata('level', $row->level);

			if ($this->session->userdata('level')==('1')) {
				redirect('admin/Dashboard');
			}elseif ($this->session->userdata('level')==('2')) {
				redirect('teknisi/Dashboard');
			}elseif ($this->session->userdata('level')==('3')) {
				redirect('customer/Dashboard');
			}
		}else{
			$data['pesan'] = "Harap Periksa Kembali Username & Password!";
			$this->load->view('viewLogin',$data);
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
}
