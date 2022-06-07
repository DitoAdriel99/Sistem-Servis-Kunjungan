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
		$this->load->view('teknisi/profile');
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
				'status' => $profile['result']->status,
			);
		}else{
			$dt = array(
				'id_user' => $profile['error'],
				'status' => $profile['error'],
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

	public function status()
	{
		$id_user = $this->input->post('id_user');
		$status = $this->input->post('status');

		$data = array(
			'id_user' => $id_user,
			'status' => $status
		);

		$update = $this->m->update($data);

		if ($update['error'] == 0) {
			$result = array(
				'error' => 0,
				'data' => 'Berhasil di ubah'
			);
			echo json_encode($result);
		} else {
			$result = array(
				'error' => 1,
				'data' => 'gagal melakukan update ke database'
			);
			echo json_encode($result);
		}

	}

}
