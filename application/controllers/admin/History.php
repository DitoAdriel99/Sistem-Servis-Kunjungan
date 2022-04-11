<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/History_model', 'm');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));

		if ($this->session->userdata('level') != "1") {
			redirect(base_url());
		}
	}

	public function index()
	{
		$queryGetHistory = $this->m->getHistory();
		// print_r($queryGetHistory);
		// die();
		
		$data = array(
			'title' => 'Dashboard',
			'history' => $queryGetHistory
		);
		$this->load->view('templates/header', $data);
		$this->load->view('admin/utama/history', $data);
		$this->load->view('templates/footer');
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
