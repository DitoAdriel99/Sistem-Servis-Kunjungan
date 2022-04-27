<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluhan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Keluhan_model', 'm');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));

		if ($this->session->userdata('level') != "1") {
			redirect(base_url());
		}
	}

	public function index()
	{	
		$data = array(
			'title' => 'Keluhan',
		);
		$this->load->view('templates/header', $data);
		$this->load->view('admin/utama/keluhan', $data);
		$this->load->view('templates/footer');
	}

	public function ambilKeluhan()
	{
		$keluhan = $this->m->getKeluhan();
		echo json_encode($keluhan);
	}

	public function add()
	{
		$this->form_validation->set_rules('nama_keluhan', 'Nama Keluhan', 'required');
		$this->form_validation->set_rules('grup', 'Grup', 'required');
		$this->form_validation->set_rules('harga_keluhan', 'Harga Keluhan', 'required');

		$harga_keluhan = $this->input->post('harga_keluhan');
		
		if ($this->form_validation->run() == true) {
			$data = array(
				'nama_keluhan' => $this->input->post('nama_keluhan'),
				'grup' => $this->input->post('grup'),
				'harga_keluhan' => number_format($harga_keluhan,2,".",","),
			);
			$insert = $this->m->insertData($data,'tb_keluhan');
			if ($insert['error'] == 0) {
				$result = array(
					'error' => 0,
					'data' => 'Berhasil'
				);
			}else{
				$result = array(
					'error' => 1,
					'data' => 'Data gagal dimasukan'
				);
			}
			echo json_encode($result);
		
		}else{
			$data = array(
				'error' => true,
				'nama_keluhan_error' => form_error('nama_keluhan'),
				'grup_error' => form_error('grup'),
				'harga_keluhan_error' => form_error('harga_keluhan'),
			);
			echo json_encode($data);
		}

		
	}

	public function destroy()
	{
		$id_keluhan = $this->input->post('id_keluhan');


		$delete = $this->m->delete($id_keluhan);
		echo json_encode($delete);
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
