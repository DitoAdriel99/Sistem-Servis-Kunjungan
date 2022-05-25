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
		$this->load->view('customer/History', $data);
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
		$bukti = $this->m->getBukti($id_pesanan);
		if ($bukti['error'] == 0) {
			$bukti['result'];
			$string_harga = intval(preg_replace('/[^\d.]/', '', $bukti['result']->harga));
			$string_tambahan1 = intval(preg_replace('/[^\d.]/', '', $bukti['result']->harga_tambahan1));
			$string_tambahan2 = intval(preg_replace('/[^\d.]/', '', $bukti['result']->harga_tambahan2));
			$string_tambahan3 = intval(preg_replace('/[^\d.]/', '', $bukti['result']->harga_tambahan3));
			$proses = $string_harga + $string_tambahan1 + $string_tambahan2 + $string_tambahan3;
			$hasil = number_format($proses,2,".",",");
			$dt = array(
				'id_pesanan' => $bukti['result']->id_pesanan,
				'tanggal_perbaikan' => $bukti['result']->tanggal_perbaikan,
				'nama_customer' => $bukti['result']->nama_customer,
				'alamat' => $bukti['result']->alamat,
				'no_hp' => $bukti['result']->no_hp,
				'nama_keluhan' => $bukti['result']->nama_keluhan,
				'harga' => $bukti['result']->harga,
				'barang_tambahan1' => $bukti['result']->barang_tambahan1,
				'harga_tambahan1' => $bukti['result']->harga_tambahan1,
				'barang_tambahan2' => $bukti['result']->barang_tambahan2,
				'harga_tambahan2' => $bukti['result']->harga_tambahan2,
				'barang_tambahan3' => $bukti['result']->barang_tambahan3,
				'harga_tambahan3' => $bukti['result']->harga_tambahan3,
				'total' => $hasil,
			);
		} else {
			$dt = array(
				'id_pesanan' => $bukti['error'],
				'tanggal_perbaikan' => $bukti['error'],
				'nama_customer' => $bukti['error'],
				'alamat' => $bukti['error'],
				'no_hp' => $bukti['error'],
				'nama_keluhan' => $bukti['error'],
				'harga' => $bukti['error'],
				'barang_tambahan' => $bukti['error'],
				'biaya_tambahan' => $bukti['error'],
			);
		}
		$this->load->view('customer/bukti', $dt);
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
