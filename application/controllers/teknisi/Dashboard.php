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
		// $id_teknisi = $this->session->userdata('id_user');

		// $queryGetDataKeluhan = $this->m->cekHarga();
		// $queryGetData = $this->m->getData($id_teknisi);
		// // print_r($queryGetData['result']);
		// // die();

		// if ($queryGetData['error'] == 0) {
		// 	// $queryGetData['result'];
		// 	$data['data'] = $queryGetData['result'];

		// 	// print_r($queryGetData['result'][0]->nama_customer);
		// }else{
		// 	echo 'data erro';
		// }
		$data['title'] = 'Dashboard';
		// die();
		// $data = array(
		// 	'data' => $queryGetData,
		// 	'title' => 'Dashboard',
		// 	'keluhan' => $queryGetDataKeluhan

		// );
		$this->load->view('templates/header', $data);
		$this->load->view('teknisi/dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function ambilData()
	{
		$id_teknisi = $this->session->userdata('id_user');

		$queryGetData = $this->m->getData($id_teknisi);

		echo json_encode($queryGetData);

		// print_r($queryGetData);
		// die();
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
			$dt = array(
				'id_pesanan' => $data['result']->id_pesanan,
				'nama_customer' => $data['result']->nama_customer,
				'alamat' => $data['result']->alamat,
				'keluhan' => $data['result']->nama_keluhan,
				'detail_keluhan' => $data['result']->detail_keluhan,
				'jam_mulai' => $data['result']->jam_mulai,
				'jam_selesai' => $data['result']->jam_selesai,
				'status_pekerjaan' => $data['result']->status_pekerjaan,
				'harga' => $data['result']->harga,
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
		date_default_timezone_set("Asia/Jakarta");
		$time = date("h:i:sa");
		// print_r($id_pesanan);
		// die;
		$gambar_pekerjaan = $this->input->post('gambar_pekerjaan');

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
			'jam_selesai' => $time
		);
		// print_r($data);
		// die();

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
}
