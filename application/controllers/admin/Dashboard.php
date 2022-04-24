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
		$queryGetDataKeluhan = $this->m->cekHarga();
		$queryGetDataTeknisi = $this->m->getDataTeknisi();
		$queryGetData = $this->m->getData();
		$data = array(
			'data' => $queryGetData,
			'teknisi' => $queryGetDataTeknisi,
			'title' => 'Dashboard',
			'keluhan' => $queryGetDataKeluhan

		);
		$this->load->view('templates/header', $data);
		$this->load->view('admin/utama/dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function ambilData()
	{
		$queryGetData = $this->m->getData();
		echo json_encode($queryGetData);
	}

	public function ambilTeknisi()
	{
		$queryGetDataTeknisi = $this->m->getDataTeknisi();


		echo json_encode($queryGetDataTeknisi);
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
		// print_r($queryGetDataKeluhan);
	}

	public function selectKeluhan()
	{
		$data = $this->m->cekHarga();
		echo json_encode($data);
	}

	public function selectTeknisi($id_pesanan)
	{
		// echo $id_keluhan;
		// die();
		// $id_user = $this->session->userdata('id_user');
		// $id_pesanan = $this->;
		$data = $this->m->cekTeknisi($id_pesanan);

		echo json_encode($data);
	}

	public function tambahData()
	{
		// $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
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
				'nama_customer' => $this->session->userdata('username'),
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

	public function hapusData()
	{
		$tabel_pesanan = new Dashboard_model;
		$id_pesanan = $this->input->post('id_pesanan');

		if ($tabel_pesanan->cekId($id_pesanan)) {
			$data = $tabel_pesanan->cekId($id_pesanan);
			$data['0']->gambar;
			// echo json_encode($data['0']->gambar);
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
		// print_r($tabel_teknisi);
		// die;
		// $id_teknisi = $this->input->post('id_user');

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
		// $data = $this->m->ambilId('tb_pesanan', $where)->result();

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
				'status' => ($data['result']->status == 1) ? 'Diterima' : 'Ditolak',
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
		// print_r($dt);
		// die();


		echo json_encode($dt);
	}

	public function editData()
	{
		// print_r($_FILES);
		// die();
		$this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
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
		$gambar_lama = $this->input->post('gambar_lama');
		echo json_encode($gambar_lama);
		die();



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

			if (empty($_files)) {
				// $gambar = $this->input->post('gambar_lama');

				$data = array(
					'id_pesanan' => $id_pesanan,
					'nama_customer' => $this->input->post('nama_customer'),
					'alamat' => $this->input->post('alamat'),
					'keluhan' => $this->input->post('keluhan'),
					'detail_keluhan' => $this->input->post('detail_keluhan'),
					// 'gambar' => $this->input->post('gambar_lama'),
					'harga' => $this->input->post('harga'),
				);
				// echo json_encode($data);
				$insert = $this->m->editData($data, 'tb_pesanan');
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
			} else {

				if (!$this->upload->do_upload('gambar')) {
					$error = array('error' => $this->upload->display_errors());
					// $this->load->view('upload_form', $error);
					$result = array(
						'error' => 0,
						'data' => 'gagal mengupload gambar'
					);
					echo json_encode($result);
				} else {
					$dataUpload = array('upload_data' => $this->upload->data());
					// $image = $dataUpload['upload_data']['file_name'];
				}
				$data = array(
					'id_pesanan' => $id_pesanan,
					'nama_customer' => $nama_customer,
					'alamat' => $alamat,
					'keluhan' => $keluhan,
					'detail_keluhan' => $detail_keluhan,
					'gambar' => $dataUpload['upload_data']['file_name'],
					'harga' => $harga,

				);


				// echo json_encode($data);
				// die();

				$insert = $this->m->editData($data, 'tb_pesanan');
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
	}

	public function verifikasi()
	{

		$id_pesanan = $this->input->post('id_pesanan');
		$status = $this->input->post('status');
		$teknisi = $this->input->post('teknisi');



		$update = $this->m->verifikasi($id_pesanan, $status, $teknisi);
		// print_r($update)

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
	}

	public function tambahTeknisi()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
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
			// echo json_encode(['success' => 'Record added successfully.']);
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$no_hp = $this->input->post('no_hp');
			$password = $this->input->post('password');
			$grup = $this->input->post('grup');
			$status = 1;

			$config['upload_path']   = './profile/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']      = 1024;
			$config['max_width']     = 1024;
			$config['max_height']    = 1200;
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
				'email' => $email,
				'no_hp' => $no_hp,
				'password' => $password,
				'grup' => $grup,
				'level' => 2,
				'status' => $status,
				'foto' => $dataUpload['upload_data']['file_name'],
			);

			// print_r($data);
			// die;

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
