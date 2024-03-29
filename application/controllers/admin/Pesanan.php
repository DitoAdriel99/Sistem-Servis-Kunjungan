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
		$this->load->view('admin/utama/pesanan');
	}

	public function onGoing()
	{
		$queryOnGoing = $this->m->getOnGoing();

		$i = 0;
		foreach ($queryOnGoing['result'] as $key) {
			if ($key->status === '1') {
				$status = 'Proses';
			} else {
				$status = 'Menunggu';
			}

			$result[$i++] = array(
				'id_pesanan' => $key->id_pesanan,
				'nama_customer' => $key->nama_customer,
				'nama_keluhan' => $key->nama_keluhan,
				'harga' => $key->harga,
				'gambar' => $key->gambar,
				'status' => $status,
				'bukti_pembayaran' => $key->bukti_pembayaran,


			);
		}
		echo json_encode($result);
	}

	public function dataPembayaran()
	{
		$queryDataPembayaran = $this->m->getDataPembayaran();

		$i = 0;
		foreach ($queryDataPembayaran['result'] as $key) {

			$string_harga = intval(preg_replace('/[^\d.]/', '', $key->harga));
			$string_tambahan1 = intval(preg_replace('/[^\d.]/', '', $key->harga_tambahan1));
			$string_tambahan2 = intval(preg_replace('/[^\d.]/', '', $key->harga_tambahan2));
			$string_tambahan3 = intval(preg_replace('/[^\d.]/', '', $key->harga_tambahan3));
			$proses = $string_harga + $string_tambahan1 + $string_tambahan2 + $string_tambahan3;
			$hasil = number_format($proses, 2, ".", ",");
			if ($key->status === '1') {
				$status = 'Proses';
			} else {
				$status = 'Menunggu';
			}

			$result[$i++] = array(
				'id_pesanan' => $key->id_pesanan,
				'nama_customer' => $key->nama_customer,
				'nama_keluhan' => $key->nama_keluhan,
				'harga' => $key->harga,
				'gambar' => $key->gambar,
				'status' => $status,
				'bukti_pembayaran' => $key->bukti_pembayaran,
				'total' => $hasil,
			);
		}
		echo json_encode($result);
	}

	public function verifikasi()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$verifikasi = 1;

		//verifikasi pesanan
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
		} else {
			$result = array(
				'error' => 1,
				'data' => 'Data Gagal di verifikasi'
			);
		}

		echo json_encode($result);

		//start config
		$config['protocol']  = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_user'] = 'skripsidito@gmail.com';
		$config['smtp_pass'] = 'tujmezupyrnpughm';
		$config['smtp_port'] = 465;
		$config['charset']   = 'utf-8';
		$config['mailtype']  = 'html';
		$config['newline']   = "\r\n";

		$this->load->library('email', $config);
		$this->email->initialize($config);
		//end config

		$bukti = $this->m->getBukti($id_pesanan);
		if ($bukti['error'] == 0) {
			$bukti['result'];
			$string_harga = intval(preg_replace('/[^\d.]/', '', $bukti['result']->harga));
			$string_tambahan1 = intval(preg_replace('/[^\d.]/', '', $bukti['result']->harga_tambahan1));
			$string_tambahan2 = intval(preg_replace('/[^\d.]/', '', $bukti['result']->harga_tambahan2));
			$string_tambahan3 = intval(preg_replace('/[^\d.]/', '', $bukti['result']->harga_tambahan3));
			$proses = $string_harga + $string_tambahan1 + $string_tambahan2 + $string_tambahan3;
			$hasil = number_format($proses, 2, ".", ",");
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


		$this->email->from('skripsidito@gmail.com', 'qhome');
		$this->email->to($this->m->getIdPesanan($id_pesanan));
		$this->email->subject('Terimakasih! Kode Pesanan.' . $id_pesanan . 'Sudah Selesai');
		$this->email->message($this->load->view('customer/bukti', $dt, true));
		$this->email->send();
		// if ($this->email->send()) {
		// echo 'behasil';
		// } else {
		// 	echo $this->email->log_message();
		// }
	}

	public function send_mail()
	{
		$from_email = "email@example.com";
		$to_email = $this->input->post('email');
		//Load email library
		$this->load->library('email');
		$this->email->from($from_email, 'Identification');
		$this->email->to($to_email);
		$this->email->subject('Send Email Codeigniter');
		$this->email->message('The email send using codeigniter library');
		//Send mail
		if ($this->email->send())
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		else
			$this->session->set_flashdata("email_sent", "You have encountered an error");
		$this->load->view('contact_email_form');
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
