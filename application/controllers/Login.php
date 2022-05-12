<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

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

		$cekLogin = $this->m->login($user, $pass);

		if ($cekLogin) {
			foreach ($cekLogin as $row);
			$this->session->set_userdata('id_user', $row->id_user);
			$this->session->set_userdata('username', $row->username);
			$this->session->set_userdata('no_hp', $row->no_hp);
			$this->session->set_userdata('alamat', $row->alamat);
			$this->session->set_userdata('foto', $row->foto);
			$this->session->set_userdata('email', $row->email);
			$this->session->set_userdata('level', $row->level);

			if ($this->session->userdata('level') == ('1')) {
				redirect('admin/Dashboard');
			} elseif ($this->session->userdata('level') == ('2')) {
				redirect('teknisi/Dashboard');
			} elseif ($this->session->userdata('level') == ('3')) {
				redirect('customer/Dashboard');
			}
		} else {
			$data['pesan'] = "Harap Periksa Kembali Username & Password!";
			$this->load->view('viewLogin', $data);
		}
	}

	function validation()
	{
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		$email = $this->input->post('email');
		if ($this->form_validation->run()) {

			$queryEmail = $this->m->validasiEmail($email, 'user');

			if ($queryEmail['validasi'] == 0) {
				$data = array(
					'error'   => true,
					'email_error' => 'Email Sudah Terpakai Harap di ganti',
					'username_error' => form_error('username'),
					'no_hp_error' => form_error('no_hp'),
					'password_error' => form_error('password')
				);
				echo json_encode($data);
			} else {

				$data = array(
					'username' => $this->input->post('username'),
					'email' => $email,
					'no_hp' => $this->input->post('no_hp'),
					'password' => $this->input->post('password'),
					'level' => 3,
				);

				$insert = $this->m->insertCustomer($data, 'user');

				if ($insert['error'] == 0) {
					$result = array(
						'error' => 0,
						'data' => 'Berhasil'
					);
				} else {
					$result = array(
						'error' => 1,
						'data' => 'Data gagal dimasukan'
					);
				}

				echo json_encode($result);
			}
		} else {
			$array = array(
				'error'   => true,
				'username_error' => form_error('username'),
				'email_error' => form_error('email'),
				'no_hp_error' => form_error('no_hp'),
				'password_error' => form_error('password')
			);
			echo json_encode($array);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
