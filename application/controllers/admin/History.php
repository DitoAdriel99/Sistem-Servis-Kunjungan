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
		$this->load->view('admin/utama/history');
	}

	public function laporan()
	{
		$queryGetHistory = $this->m->getHistory();

		echo json_encode($queryGetHistory);
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
