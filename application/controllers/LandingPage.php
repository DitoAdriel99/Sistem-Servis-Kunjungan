<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LandingPage extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('admin/Dashboard_model', 'm');
		// $this->load->library('form_validation');
		// $this->load->library('session');
		// $this->load->helper(array('form', 'url'));

		// if ($this->session->userdata('level') != "1") {
		// 	redirect(base_url());
		// }
	}

	public function index()
	{
		$this->load->view('viewLandingPage');
	}


	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
