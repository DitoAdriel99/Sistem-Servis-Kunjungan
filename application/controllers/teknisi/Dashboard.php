<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('teknisi/Dashboard_model', 'm');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form', 'url', 'date'));

		if ($this->session->userdata('level') != "2") {
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->load->view('teknisi/dashboard');
	}

	public function ambilData()
	{
		$id_teknisi = $this->session->userdata('id_user');

		$queryGetData = $this->m->getData($id_teknisi);

		echo json_encode($queryGetData);

		// print_r($queryGetData);
		// die();
	}

	public function tambahBarang()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$barang_tambahan1 = $this->input->post('barang_tambahan1');
		$harga_tambahan1 = $this->input->post('harga_tambahan1');
		$barang_tambahan2 = $this->input->post('barang_tambahan2');
		$harga_tambahan2 = $this->input->post('harga_tambahan2');
		$barang_tambahan3 = $this->input->post('barang_tambahan3');
		$harga_tambahan3 = $this->input->post('harga_tambahan3');

		$data = array(
			'id_pesanan' => $id_pesanan,
			'barang_tambahan1' => $barang_tambahan1,
			'harga_tambahan1' => number_format($harga_tambahan1, 2, ".", ","),
			'barang_tambahan2' => $barang_tambahan2,
			'harga_tambahan2' => number_format($harga_tambahan2, 2, ".", ","),
			'barang_tambahan3' => $barang_tambahan3,
			'harga_tambahan3' => number_format($harga_tambahan3, 2, ".", ","),
		);

		$insert = $this->m->masukanTambahan($data);

		if ($insert['error'] == 0) {
			$result = array(
				'error' => 0,
				'data' => 'Data Sudah ditambahkan'
			);
		} else {
			$result = array(
				'error' => 1,
				'data' => 'Data Tidak bisa dimasukan'
			);
		}

		echo json_encode($result);
	}

	public function ambilId()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$where = array('id_pesanan' => $id_pesanan);
		$data = $this->m->getid($id_pesanan);

		// print_r($data);
		// die();

		if ($data['error'] == 0) {
			$data['result'];

			$string_harga = intval(preg_replace('/[^\d.]/', '', $data['result']->harga));
			$string_tambahan1 = intval(preg_replace('/[^\d.]/', '', $data['result']->harga_tambahan1));
			$string_tambahan2 = intval(preg_replace('/[^\d.]/', '', $data['result']->harga_tambahan2));
			$string_tambahan3 = intval(preg_replace('/[^\d.]/', '', $data['result']->harga_tambahan3));
			$proses = $string_harga + $string_tambahan1 + $string_tambahan2 + $string_tambahan3;
			$hasil = number_format($proses,2,".",",");

			$dt = array(
				'id_pesanan' => $data['result']->id_pesanan,
				'nama_customer' => $data['result']->nama_customer,
				'alamat' => $data['result']->alamat,
				'keluhan' => $data['result']->nama_keluhan,
				'detail_keluhan' => $data['result']->detail_keluhan,
				'jam_mulai' => $data['result']->jam_mulai,
				'jam_selesai' => $data['result']->jam_selesai,
				'status_pekerjaan' => $data['result']->status_pekerjaan,
				'harga' => $hasil,
				'gambar' => $data['result']->gambar,
				'status' => $data['result']->status,
			);
		} else {
			$dt = array(
				'id_pesanan' => $data['error'],
				'nama_customer' => $data['error'],
				'keluhan' => $data['error'],
				'detail_keluhan' => $data['error'],
				'jam_mulai' => $data['error'],
				'jam_selesai' => $data['error'],
				'status_pekerjaan' => $data['error'],
				'harga' => $data['error'],
				'gambar' => $data['error'],
				'status' => $data['error'],
			);
		}
		// print_r($dt);
		// die();

		echo json_encode($dt);
	}

	public function statusPekerjaan()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$status_pekerjaan = $this->input->post('status_pekerjaan');
		date_default_timezone_set("Asia/Jakarta");
		$time = date("h:i:sa");
		// die();

		$data = array(
			'id_pesanan' => $id_pesanan,
			'status_pekerjaan' => $status_pekerjaan,
			'jam_mulai' => $time
		);

		$update = $this->m->statuspekerjaan($data);

		// print_r($time);
		// die();

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

		// 	print_r($result);
		// 	die();
		echo json_encode($result);
	}

	public function selesai()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$status_pekerjaan = $this->input->post('status_pekerjaan');
		// print_r($id_pesanan);
		// die;
		$gambar_pekerjaan = $this->input->post('gambar_pekerjaan');
		$barang_tambahan = $this->input->post('barang_tambahan');
		$biaya_tambahan = $this->input->post('biaya_tambahan');


		$config['upload_path']   = './gambar/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = 1024;
		$config['max_width']     = 1024;
		$config['max_height']    = 1200;
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('gambar_pekerjaan')) {
			$dataUpload = array('upload_data' => $this->upload->data());
		} else {
			$error = $this->upload->display_errors();
			// $this->load->view('upload_form', $error);
			$result = array(
				'error' => 1,
				'data' => $error
			);
			echo json_encode($result);
			exit;
		}

		$data = array(
			'id_pesanan' => $id_pesanan,
			'gambar_pekerjaan' => $dataUpload['upload_data']['file_name'],

		);

		$insert = $this->m->selesai($data, 'tb_pesanan');
		if ($insert['error'] == 0) {
			$result = array(
				'error' => 0,
				'data' => $data
			);
			echo json_encode($result);
		} else {
			$result = array(
				'error' => 1,
				'data' => $data
			);
			echo json_encode($result);
		}
	}

	public function tambahan()
	{
		$this->load->view('teknisi/tambahan.php');
	}

	public function tambahan1()
	{
		$this->load->view('teknisi/tambahan1.php');
	}
}
