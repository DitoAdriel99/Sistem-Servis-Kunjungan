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

		$i = 0;
		foreach ($queryGetHistory['result'] as $key){
			$string_harga = intval(preg_replace('/[^\d.]/', '', $key->harga));
			$string_tambahan = intval(preg_replace('/[^\d.]/', '', $key->biaya_tambahan));

			$proses = $string_harga + $string_tambahan;
			$hasil = number_format($proses,2,".",",");

			if ($key->barang_tambahan == null) {
				$pesan = 'Tidak ada';
			}else{
				$pesan = $key->barang_tambahan;
			}

			$result[$i++] = array(
				'id_pesanan' => $key->id_pesanan,
				'nama_customer' => $key->nama_customer,
				'tanggal_pesanan' => $key->tanggal_pesanan,
				'tanggal_perbaikan' => $key->tanggal_perbaikan,
				'alamat' => $key->alamat,
				'nama_keluhan' => $key->nama_keluhan,
				'barang_tambahan' => $pesan,
				'jam_mulai' => $key->jam_mulai,
				'jam_selesai' => $key->jam_selesai,
				'harga' => $key->harga,
				'username' => $key->username,
				'status_pekerjaan' => $key->status_pekerjaan,
				'total' => $hasil,
			);

		}
		
		echo json_encode($result);
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
