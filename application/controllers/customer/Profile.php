<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer/Profile_model', 'm');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));

		if ($this->session->userdata('level') != "3") {
			redirect(base_url());
		}
	}

	public function index()
	{
		$data = array(
			'title' => 'Profile',

		);
		$this->load->view('templates/header', $data);
		$this->load->view('customer/profile', $data);
		$this->load->view('templates/footer');
	}

	public function ambilData()
	{
		$id_user = $this->session->userdata('id_user');
		$profile = $this->m->getProfile($id_user);

		// print_r($profile);
		// die;

		if ($profile['error'] == 0) {
			$profile['result'];
			$dt = array(
				'id_user' => $profile['result']->id_user,
				'username' => $profile['result']->username,
				'email' => $profile['result']->email,
				'no_hp' => $profile['result']->no_hp,
				'alamat' => $profile['result']->alamat,
				'foto' => $profile['result']->foto,
			);
		}else{
			$dt = array(
				'id_user' => $profile['error'],
				'username' => $profile['error'],
				'email' => $profile['error'],
				'no_hp' => $profile['error'],
				'alamat' => $profile['error'],
				'foto' => $profile['error'],
			);
		}

		echo json_encode($dt);
	}

	public function update()
	{
		$id_user = $this->input->post('id_user');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');

		$data = array(
			'id_user' => $id_user,
			'username' => $username,
			'email' => $email,
			'alamat' => $alamat,
			'no_hp' => $no_hp,
		);

		
		$update = $this->m->update($data,'user');
		if ($update['error'] == 0) {
			$result = array(
				'error' => 0,
				'data' => $data
			);
		}else{
			$result = array(
				'error' => 1,
				'data' => 'gagal update'
			);
		}
		echo json_encode($result);
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
