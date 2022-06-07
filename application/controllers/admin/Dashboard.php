<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Dashboard_model', 'm');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));

		if ($this->session->userdata('level') != "1") {
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->load->view('admin/utama/dashboard');
	}

	public function ambilData()
	{
		$queryGetData = $this->m->getData();
		echo json_encode($queryGetData);
	}

	public function ambilProses()
	{
		$queryGetData = $this->m->getProses();
		echo json_encode($queryGetData);
	}

	public function cek()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$cekId = $this->m->getCekId($id_pesanan);
		$convert = intval($cekId);
		$history = $this->m->getHistoryUser($convert);

		echo json_encode($history);
		
	}

	public function ambilTeknisi()
	{
		$queryGetDataTeknisi = $this->m->getDataTeknisi();
		// print_r($queryGetDataTeknisi);
		// die;
		
		$i = 0;
		foreach($queryGetDataTeknisi['result'] as $key){
			if ($key->status == 0) {
				$status = 'Sedang Tugas';
			}elseif ($key->status == 1){
				$status = 'Tersedia';
			}else{
				$status = 'Tidak Hadir';

			}

			$result[$i++] = array(
				'id_user' => $key->id_user,
				'username' => $key->username,
				'grup' => $key->grup,
				'status' => $status
			);
		}

		echo json_encode($result);
	}

	public function viewTambah()
	{
		$queryGetDataKeluhan = $this->m->cekHarga();
		$data = array(
			'title' => 'viewTambah',
			'keluhan' => $queryGetDataKeluhan
		);
		$this->load->view('templates/header', $data);
		$this->load->view('admin/utama/viewTambah');
		$this->load->view('templates/footer');
	}

	public function cekHarga($id = null)
	{
		$queryGetDataKeluhan = $this->m->cekHarga($id);
		echo $queryGetDataKeluhan->harga_keluhan;
	}

	public function selectKeluhan()
	{
		$data = $this->m->cekHarga();
		echo json_encode($data);
	}

	public function pesananSelesai()
	{
		$data = $this->m->getPesananSelesai();
		echo json_encode($data);
	}

	public function selectTeknisi($id_pesanan)
	{
		$data = $this->m->cekTeknisi($id_pesanan);

		echo json_encode($data);
	}

	public function tambahData()
	{
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('keluhan', 'Keluhan', 'required');
		$this->form_validation->set_rules('detail_keluhan', 'Detail Keluhan', 'required');
		if (empty($_FILES)) {
			$this->form_validation->set_rules('gambar', 'Gambar', 'required');
		}
		$id_pesanan = $this->input->post('id_pesanan');
		$nama_customer = $this->input->post('nama_customer');
		$alamat = $this->input->post('alamat');
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
				'nama_customer' => $this->session->userdata('username'),
				'alamat' => $alamat,
				'keluhan' => $keluhan,
				'detail_keluhan' => $detail_keluhan,
				'gambar' => $dataUpload['upload_data']['file_name'],
				'harga' => $harga,
				'teknisi' => $teknisi,
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

	public function tolak()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$pesan = $this->input->post('pesan');

		$queryemail = $this->db->select('*')->from('tb_pesanan')->where('id_pesanan', $id_pesanan)->get();

		$email = $queryemail->row()->email;
		
	

		$delete = $this->m->tolak($id_pesanan);

		if ($delete['error'] == 0) {
			$result = array(
				'error' => 0,
				'data' => 'Data dihapus'
			);
		}else{
			$result = array(
				'error' => 1,
				'data' => 'Data gagal dihapus'
			);
		}

		echo json_encode($result);
		//start config
		$config['protocol']  = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_user'] = 'skripsidito@gmail.com';
		$config['smtp_pass'] = 'pastilulus';
		$config['smtp_port'] = 465;
		$config['charset']   = 'utf-8';
		$config['mailtype']  = 'html';
		$config['newline']   = "\r\n";

		$this->load->library('email', $config);
		$this->email->initialize($config);
		//end config


		$this->email->from('skripsidito@gmail.com','qhome');
		$this->email->to($email);
		$this->email->subject('Mohon Maaf! Kode Pesanan.'.$id_pesanan.'Ditolak');
		$this->email->message($pesan);
		$this->email->send();
	}

	public function hapusData()
	{
		$tabel_pesanan = new Dashboard_model;
		$id_pesanan = $this->input->post('id_pesanan');

		if ($tabel_pesanan->cekId($id_pesanan)) {
			$data = $tabel_pesanan->cekId($id_pesanan);
			$data['0']->gambar;
			if (file_exists("./gambar/" . $data['0']->gambar)) {
				unlink("./gambar/" . $data['0']->gambar);
			}
			$where = array('id_pesanan' => $id_pesanan);
			$this->m->deleteData($where, 'tb_pesanan');
		} else {
			echo 'id tiaj dad';
		}
	}

	public function hapusDataTeknisi()
	{
		$id_user = $this->input->post('id_user');
		$tabel_teknisi = $this->m->cekIdTeknisi($id_user);;
		if ($tabel_teknisi['0']->foto) {
			if (file_exists("./profile/" . $tabel_teknisi['0']->foto)) {
				unlink("./profile/" . $tabel_teknisi['0']->foto);
				$where = array('id_user' => $id_user);
				$this->m->deleteData($where, 'user');
			}else{
				$where = array('id_user' => $id_user);
				$this->m->deleteData($where, 'user');
			}
		}else{
			echo "tidak ada id";
		}
	}

	public function ambilId()
	{
		$id_pesanan = $this->input->post('id_pesanan');
		$where = array('id_pesanan' => $id_pesanan);

		$data = $this->m->ambilId($id_pesanan);


		if ($data['error'] == 0) {
			$data['result'];
			$dt = array(
				'id_pesanan' => $data['result']->id_pesanan,
				'nama_customer' => $data['result']->nama_customer,
				'alamat' => $data['result']->alamat,
				'keluhan' => $data['result']->nama_keluhan,
				'id_keluhan' => $data['result']->keluhan,
				'detail_keluhan' => $data['result']->detail_keluhan,
				'gambar' => $data['result']->gambar,
				'harga' => $data['result']->harga,
				'status' => ($data['result']->status == 1) ? 'Diterima' : 'Menunggu',
				'id_keluhan' => $data['result']->keluhan,
			);
		} else {
			$dt = array(
				'id_pesanan' => $data['error'],
				'nama_customer' => $data['error'],
				'alamat' => $data['error'],
				'keluhan' => $data['error'],
				'detail_keluhan' => $data['error'],
				'gambar' => $data['error'],
				'harga' => $data['error'],
				'status' => $data['error'],
			);
		}


		echo json_encode($dt);
	}


	public function verifikasi()
	{

		$id_pesanan = $this->input->post('id_pesanan');
		$status = $this->input->post('status');
		$teknisi = $this->input->post('teknisi');



		$update = $this->m->verifikasi($id_pesanan, $status, $teknisi);

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
		$config['smtp_pass'] = 'pastilulus';
		$config['smtp_port'] = 465;
		$config['charset']   = 'utf-8';
		$config['mailtype']  = 'html';
		$config['newline']   = "\r\n";

		$this->load->library('email', $config);
		$this->email->initialize($config);
		//end config

		$this->email->from('skripsidito@gmail.com','qhome');
		$this->email->to($this->m->getEmail($id_pesanan));
		$this->email->subject('Terimakasih! Kode Pesanan.'.$id_pesanan.'Teknisi Sudah menuju lokasi');
		$this->email->message('Harap Menunggu ditempat dan memverifikasi kedatangan teknisi jika sudah sampai.');
		$this->email->send();
	}

	public function tambahTeknisi()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('grup', 'Grup', 'required');

		if ($this->form_validation->run() == FALSE) {
			$error = array(
				'error' => 1,
				'data' => $this->form_validation->error_array(),
			);
			echo json_encode($error);
		} else {
			$username = $this->input->post('username');
			$no_hp = $this->input->post('no_hp');
			$password = $this->input->post('password');
			$grup = $this->input->post('grup');
			$status = 1;

			$config['upload_path']   = './profile/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']      = 9999;
			$config['max_width']     = 9999;
			$config['max_height']    = 9999;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto')) {
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
				'username' => $username,
				'no_hp' => $no_hp,
				'password' => $password,
				'grup' => $grup,
				'level' => 2,
				'status' => $status,
				'foto' => $dataUpload['upload_data']['file_name'],
			);

			$insert = $this->m->insertTeknisi($data, 'user');

			if ($insert['error'] == 0) {
				$result = array(
					'error' => 0,
					'data' => 'Berhasil'
				);
			} else {
				$result = array(
					'error' => 1,
					'data' => 'Data Gagal dimasukan'
				);
			}

			echo json_encode($result);
		}
	}

	public function sessions()
	{
		print_r($this->session->userdata());
	}
}
