<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer/Dashboard_model', 'm');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));

		if ($this->session->userdata('level') != "3") {
			redirect(base_url());
		}
	}

	public function index()
	{
		// $data = $this->session->username;
		// print_r($data);
		// die;
		$id_user = $this->session->userdata('id_user');


		// $queryGetData = $this->m->getData($id_user);

		$queryGetDataKeluhan = $this->m->cekHarga();
		$queryGetData = $this->m->getData($id_user);
		$data = array(
			'data' => $queryGetData,
			'title' => 'Dashboard',
			'keluhan' => $queryGetDataKeluhan

		);
		$this->load->view('templates_customer/header', $data);
		$this->load->view('customer/dashboard', $data);
		$this->load->view('templates_customer/footer');
	}
	public function selectKeluhan()
	{
		$data = $this->m->cekHarga();
		echo json_encode($data);
	}

	public function cekHarga($id = null)
	{
		$queryGetDataKeluhan = $this->m->cekHarga($id);
		echo $queryGetDataKeluhan->harga_keluhan;
		// print_r($queryGetDataKeluhan);
	}

	public function ambilId()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$where = array('id_pesanan' => $id_pesanan);
		$data = $this->m->getId($id_pesanan);

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
				'teknisi' => $data['result']->teknisi,
				'status_pekerjaan' => $data['result']->status_pekerjaan,
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
				'status_pekerjaan' => $data['error'],
			);
		}
		echo json_encode($dt);

	}

	public function ambilData()
	{
		$id_user = $this->session->userdata('id_user');
		$queryGetData = $this->m->getData($id_user);
		// $id_user = $this->session->userdata('id_user');
		// print_r($id_user);
		// die();

		// $i = 0;
		// foreach ($queryGetData['result'] as $key) {
		// 	if ($key->status === '0') {
		// 		$status = 'Ditolak';
		// 	} else if ($key->status === '1') {
		// 		$status = 'Diterima';
		// 	} else {
		// 		$status = 'Menunggu';
		// 	}


		// 	$result[$i++] = array(
		// 		'id_pesanan' => $key->id_pesanan,
		// 		'keluhan' => $key->nama_keluhan,
		// 		'harga' => $key->harga,
		// 		'gambar' => $key->gambar,
		// 		'status' => $status,
		// 		'bukti_pembayaran' => $key->bukti_pembayaran,


		// 	);
		// }
		echo json_encode($queryGetData);
	}

	public function tambahData()
	{
		// $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
		// $this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('keluhan', 'Keluhan', 'required');
		$this->form_validation->set_rules('detail_keluhan', 'Detail Keluhan', 'required');
		if (empty($_FILES)) {
			$this->form_validation->set_rules('gambar', 'Gambar', 'required');
		}
		$id_pesanan = $this->input->post('id_pesanan');
		$id_user = $this->session->userdata('id_user');
		$nama_customer = $this->session->userdata('username');
		$alamat = $this->session->userdata('alamat');
		$no_hp = $this->session->userdata('no_hp');
		$keluhan = $this->input->post('keluhan');
		$detail_keluhan = $this->input->post('detail_keluhan');
		$harga = $this->input->post('harga');
		$teknisi = $this->input->post('teknisi');


		$this->form_validation->set_error_delimiters('<div class="alert bg-danger" role="alert">', '</div>');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('message', validation_errors());
			$result = array(
				'error' => 1,
				'data' => $this->form_validation->error_array(),
			);
			echo json_encode($result);
		} else {
			$config['upload_path']   = './gambar/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']      = 1024;
			$config['max_width']     = 1024;
			$config['max_height']    = 1200;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$error = $this->upload->display_errors();
				// $this->load->view('upload_form', $error);
				$result = array(
					'error' => 1,
					'data' => $error
				);
				echo json_encode($result);
				exit;
			} else {
				$dataUpload = array('upload_data' => $this->upload->data());
				// $image = $dataUpload['upload_data']['file_name'];
			}

			$data = array(
				'id_pesanan' => $id_pesanan,
				'id_user' => $id_user,
				'nama_customer' => $nama_customer,
				'no_hp' => $no_hp,
				'alamat' => $alamat,
				'keluhan' => $keluhan,
				'detail_keluhan' => $detail_keluhan,
				'gambar' => $dataUpload['upload_data']['file_name'],
				'harga' => $harga,
				'teknisi' => $teknisi,
			);


			// echo json_encode($data);
			// die();

			$insert = $this->m->insertData($data, 'tb_pesanan');
			if ($insert['error'] == 0) {
				$result = array(
					'error' => 0,
					'data' => $data
				);
				echo json_encode($result);
			} else {
				$result = array(
					'error' => 1,
					'data' => 'gagal melakukan insert ke database'
				);
				echo json_encode($result);
			}
		}
		// echo json_encode($data);

	}

	public function verifikasi()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$teknisi = $this->input->post('teknisi');
		// echo $teknisi;
		// die();

		$verifikasi_selesai = $this->input->post('verifikasi_selesai');

		

		$update = $this->m->verifikasiSelesai($id_pesanan,$teknisi,$verifikasi_selesai);

		if ($update['error'] == 0) {
			$result = array(
				'error' => 0,
				'data' =>'berhasil'
			);
		}else{
			$result = array(
				'error' => 1,
				'data' =>'Data Gagal Di verifikasi'
			);
		}

		echo json_encode($result);
	}

	public function uploadBukti()
	{
		$id_pesanan = $this->input->post('id_pesanan');

		$config['upload_path']   = './gambar/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$config['max_size']      = 9000;
		$config['max_width']     = 9000;
		$config['max_height']    = 9000;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('bukti_pembayaran')) {
			$error = $this->upload->display_errors();
			// $this->load->view('upload_form', $error);
			$result = array(
				'error' => 1,
				'data' => $error
			);
			echo json_encode($result);
			exit;
		} else {
			$dataUpload = array('upload_data' => $this->upload->data());
			// $image = $dataUpload['upload_data']['file_name'];
		}

		$data = array(
			'id_pesanan' => $id_pesanan,
			'bukti_pembayaran' => $dataUpload['upload_data']['file_name']
		);

		$upload = $this->m->uploadBukti($data);

		if ($upload['error'] == 0) {
			$result = array(
				'error' => 0,
				'data' =>'Berhasil Di Upload Harap menunggu Konfirmasi'
			);
		}else{
			$result = array(
				'error' => 1,
				'data' =>'Data Gagal Di Upload'
			);
		}

		echo json_encode($result);


	}



	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
