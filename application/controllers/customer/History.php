<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer/History_model', 'm');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));

		if ($this->session->userdata('level') != "3") {
			redirect(base_url());
		}
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user');
		$history = $this->m->getHistory($id_user);
		$data = array(
			'title' => 'History',
			'history' => $history
		);
		$this->load->view('templates/header', $data);
		$this->load->view('customer/History', $data);
		$this->load->view('templates/footer');
	}

	public function getHistory()
	{
		$id_user = $this->session->userdata('id_user');
		$history = $this->m->getHistory($id_user);
		echo json_encode($history);
	}

	public function bukti($x)
	{
		$id_pesanan = $x;

		$bukti['data'] = $this->m->getBukti($id_pesanan);
		$this->load->view('customer/bukti', $bukti);


		// print_r($bukti);
	}
	
	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
