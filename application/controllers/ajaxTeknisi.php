<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AjaxTeknisi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array(
			'title' => 'Dashboard',

		);
		$this->load->view('ajaxView', $data);
	}
		
}
