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
		$this->load->view('customer/dashboard');
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

	public function detailHarga()
	{
		$id_pesanan = $this->input->post('id_pesanan');

		print_r($id_pesanan);
	}

	public function ambilId()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$where = array('id_pesanan' => $id_pesanan);
		$data = $this->m->getId($id_pesanan);
		$detailharga = $this->m->getDetailHarga($id_pesanan);
		// print_r($detailharga);
		// die;
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
				'id_user' => $data['result']->id_user,
				'teknisi' => $data['result']->teknisi,
				'nama_customer' => $data['result']->nama_customer,
				'alamat' => $data['result']->alamat,
				'keluhan' => $data['result']->nama_keluhan,
				'detail_keluhan' => $data['result']->detail_keluhan,
				'jam_mulai' => $data['result']->jam_mulai,
				'jam_selesai' => $data['result']->jam_selesai,
				'harga' => $data['result']->harga,
				'gambar' => $data['result']->gambar,
				'status' => ($data['result']->status == null) ? 'Menunggu' : 'Diterima' ,
				// 'teknisi' => $data['result']->username,
				// 'no_hp' => $data['result']->no_hp,
				'status_pekerjaan' => $data['result']->status_pekerjaan,
				'barang_tambahan1' => $data['result']->barang_tambahan1,
				'harga_tambahan1' => $data['result']->harga_tambahan1,
				'barang_tambahan2' => $data['result']->barang_tambahan2,
				'harga_tambahan2' => $data['result']->harga_tambahan2,
				'barang_tambahan3' => $data['result']->barang_tambahan3,
				'harga_tambahan3' => $data['result']->harga_tambahan3,
				'total' => $hasil,

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

		$i = 0;
		foreach ($queryGetData['result'] as $key) {
			if ($key->status === '1') {
				$status = 'Diterima';
			} else {
				$status = 'Menunggu';
			}
			$result[$i++] = array(
				'id_pesanan' => $key->id_pesanan,
				'nama_keluhan' => $key->nama_keluhan,
				'harga' => $key->harga,
				'gambar' => $key->gambar,
				'status' => $status,
				'bukti_pembayaran' => $key->bukti_pembayaran,
			);
		}
		echo json_encode($result);
	}

	public function tambahData()
	{
		$this->form_validation->set_rules('keluhan', 'Keluhan', 'required');
		$this->form_validation->set_rules('detail_keluhan', 'Detail Keluhan', 'required');
		if (empty($_FILES)) {
			$this->form_validation->set_rules('gambar', 'Gambar', 'required');
		}
		$id_pesanan = $this->input->post('id_pesanan');
		$alamat = $this->input->post('alamat');
		$id_user = $this->session->userdata('id_user');
		$nama_customer = $this->session->userdata('username');
		$email = $this->session->userdata('email');
		$no_hp = $this->session->userdata('no_hp');
		$keluhan = $this->input->post('keluhan');
		$detail_keluhan = $this->input->post('detail_keluhan');
		$harga = $this->input->post('harga');
		$teknisi = $this->input->post('teknisi');
		$tanggal = format_indo(date('Y-m-d'));


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
			$config['max_size']      = 9999;
			$config['max_width']     = 9999;
			$config['max_height']    = 9999;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$error = $this->upload->display_errors();
				$result = array(
					'error' => 1,
					'data' => $error
				);
				echo json_encode($result);
				exit;
			} else {
				$dataUpload = array('upload_data' => $this->upload->data());
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
				'email' => $email,
				'teknisi' => $teknisi,
				'tanggal_pesanan' => $tanggal
			);

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

		
	}

	public function kedatangan()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$tanggal = format_indo(date('Y-m-d'));
		date_default_timezone_set("Asia/Jakarta");
		$time = date("h:i:sa");
		
		$data = array(
			'id_pesanan' => $id_pesanan,
			'tanggal_perbaikan' => $tanggal,
			'jam_mulai' => $time,
			'status_pekerjaan' => 0
		);

		$update = $this->m->updateKedatangan($data,'tb_pesanan');

		if ($update['error'] == 0) {
			$result = array(
				'error' => 0,
				'data' => 'Data berhasil diubah',
			);
		}else{
			$result = array(
				'error' => 1,
				'data' => 'Data gagal diubah',
			);
		}

		echo json_encode($result);
	}

	public function selesai()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		date_default_timezone_set("Asia/Jakarta");
		$time = date("h:i:sa");
		
		
		$data = array(
			'id_pesanan' => $id_pesanan,
			'jam_selesai' => $time,
			'status_pekerjaan' => 1
		);

		$update = $this->m->updateSelesai($data,'tb_pesanan');

		if ($update['error'] == 0) {
			$result = array(
				'error' => 0,
				'data' => 'Data berhasil diubah',
			);
		}else{
			$result = array(
				'error' => 1,
				'data' => 'Data gagal diubah',
			);
		}

		echo json_encode($result);
	}

	public function verifikasi()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$teknisi = $this->input->post('teknisi');
		echo $teknisi;
		die();

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
		$teknisi = $this->input->post('teknisi');
		$verifikasi_selesai = 1;
		// print_r($teknisi);
		// die;

		$config['upload_path']   = './gambar/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$config['max_size']      = 9000;
		$config['max_width']     = 9000;
		$config['max_height']    = 9000;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('bukti_pembayaran')) {
			$error = $this->upload->display_errors();
			$result = array(
				'error' => 1,
				'data' => $error
			);
			echo json_encode($result);
			exit;
		} else {
			$dataUpload = array('upload_data' => $this->upload->data());
		}

		$data = array(
			'id_pesanan' => $id_pesanan,
			'bukti_pembayaran' => $dataUpload['upload_data']['file_name'],
			'verifikasi_selesai' => $verifikasi_selesai
		);

		
		$sts = array(
			'id_user' => $teknisi,
			'status' => 1,
		);
		

		$upload = $this->m->uploadBukti($data);

		$this->m->verifikasiSelesai($sts);
		

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

	public function profileTeknisi()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$teknisi = $this->m->getProfileTeknisi($id_pesanan);
		echo json_encode($teknisi);
	}



	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
