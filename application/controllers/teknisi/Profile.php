<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('teknisi/Profile_model', 'm');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form', 'url', 'date'));

		if ($this->session->userdata('level') != "2") {
			redirect(base_url());
		}
	}

	public function index()
	{
		
		$data['title'] = 'Profile Teknisi';
		$this->load->view('templates/header', $data);
		$this->load->view('teknisi/profile', $data);
		$this->load->view('templates/footer');
	}

	public function ambilProfile()
	{
		$id_user = $this->session->userdata('id_user');
		$profile = $this->m->getProfile($id_user);
		if ($profile['error'] == 0) {
			$profile['result'];
			$dt = array(
				'id_user' => $profile['result']->id_user,
				'username' => $profile['result']->username,
				'grup' => $profile['result']->grup,
			);
		}else{
			$dt = array(
				'id_user' => $profile['error'],
				'username' => $profile['error'],
				'grup' => $profile['error'],
			);
		}
		echo json_encode($dt);
	}

	public function ambilData()
	{
		$id_user = $this->session->userdata('id_user');
		$history = $this->m->getHistory($id_user);

		echo json_encode($history);
	}

}
