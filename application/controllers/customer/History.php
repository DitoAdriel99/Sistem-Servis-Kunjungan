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
		
		// print_r($bukti);
		// die;
		
		
		if ($bukti['error'] == 0) {
			$bukti['result'];
			$string_harga = intval(preg_replace('/[^\d.]/', '', $bukti['result']->harga));
			$string_tambahan = intval(preg_replace('/[^\d.]/', '', $bukti['result']->biaya_tambahan));
			$proses = $string_harga + $string_tambahan;
			$hasil = number_format($proses, 2, ".", ",");
			$dt = array(
				'id_pesanan' => $bukti['result']->id_pesanan,
				'tanggal_perbaikan' => $bukti['result']->tanggal_perbaikan,
				'nama_customer' => $bukti['result']->nama_customer,
				'alamat' => $bukti['result']->alamat,
				'no_hp' => $bukti['result']->no_hp,
				'nama_keluhan' => $bukti['result']->nama_keluhan,
				'harga' => $bukti['result']->harga,
				'barang_tambahan' => $bukti['result']->barang_tambahan,
				'biaya_tambahan' => $bukti['result']->biaya_tambahan,
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
		// print_r($bukti);
		// die;
		$this->load->view('customer/bukti', $dt);


		// print_r($bukti);
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
