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
		$queryGetHistory['history'] = $this->m->getHistory();

		$this->load->view('admin/utama/history',$queryGetHistory);
	}

	public function laporan()
	{
		$queryGetHistory = $this->m->getHistory();

		$i = 0;
		foreach ($queryGetHistory['result'] as $key){
			$string_harga = intval(preg_replace('/[^\d.]/', '', $key->harga));
			$string_tambahan1 = intval(preg_replace('/[^\d.]/', '', $key->harga_tambahan1));
			$string_tambahan2 = intval(preg_replace('/[^\d.]/', '', $key->harga_tambahan2));
			$string_tambahan3 = intval(preg_replace('/[^\d.]/', '', $key->harga_tambahan3));
			$proses = $string_harga + $string_tambahan1 + $string_tambahan2 + $string_tambahan3;
			$hasil = number_format($proses,2,".",",");
			$result[$i++] = array(
				'id_pesanan' => $key->id_pesanan,
				'nama_customer' => $key->nama_customer,
				'tanggal_pesanan' => $key->tanggal_pesanan,
				'tanggal_perbaikan' => $key->tanggal_perbaikan,
				'alamat' => $key->alamat,
				'nama_keluhan' => $key->nama_keluhan,
				'jam_mulai' => $key->jam_mulai,
				'jam_selesai' => $key->jam_selesai,
				'harga' => $hasil,
				'username' => $key->username,
				'status_pekerjaan' => $key->status_pekerjaan,
			);

		}
		
		echo json_encode($result);
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
