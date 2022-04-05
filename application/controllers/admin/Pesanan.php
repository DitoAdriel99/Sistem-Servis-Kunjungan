<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Pesanan_model', 'm');
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
			'title' => 'Dashboard',
		);
		$this->load->view('templates/header', $data);
		$this->load->view('admin/utama/pesanan');
		$this->load->view('templates/footer');
	}

	public function onGoing()
	{
		$queryOnGoing = $this->m->getOnGoing();
		echo json_encode($queryOnGoing);
	}

	public function dataPembayaran()
	{
		$queryDataPembayaran = $this->m->getDataPembayaran();
		echo json_encode($queryDataPembayaran);
	}

	public function verifikasi()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$verifikasi = 1;

		$data = array(
			'id_pesanan' => $id_pesanan,
			'verifikasi_pembayaran' => $verifikasi,
		);
		
		$update = $this->m->verifikasi($data);

		if ($update['error'] == 0) {
			$result = array(
				'error' => 0,
				'data' => 'Berhasil'
			);
		}else{
			$result = array(
				'error' => 1,
				'data' => 'Data Gagal di verifikasi'
			);
		}

		echo json_encode($result);
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
