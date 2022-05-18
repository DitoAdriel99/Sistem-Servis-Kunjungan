<?php
class Pesanan_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getOnGoing()
	{
		$query = $this->db->select('tp.*,tk.nama_keluhan')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->where('tp.bukti_pembayaran', null)
			->where('tp.status', 1)
			->get();
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'result' => $query->result());
		} else {
			return $result = array('error' => 1, 'result' => 'Data tidak ada');
		}
	}

	public function getDataPembayaran()
	{
		$query = $this->db->select('tp.*,tk.nama_keluhan')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->where('tp.verifikasi_selesai', 1)
			->where('tp.status', 1)
			->where('tp.verifikasi_pembayaran', null)
			->get();
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'result' => $query->result());
		} else {
			return $result = array('error' => 1, 'result' => 'Data tidak ada');
		}
	}

	public function getIdPesanan($id_pesanan)
	{
		$query = $this->db->select('*')
			->from('tb_pesanan')
			->where('id_pesanan', $id_pesanan)
			->get();
		return $query->row()->email;
	}

	public function verifikasi($data)
	{
		$this->db->where('id_pesanan', $data['id_pesanan']);
		$this->db->update('tb_pesanan', $data);
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'id_pesanan' => $data['id_pesanan']);
		} else {
			return $result = array('error' => 1,);
		}
	}

	public function getBukti($id_pesanan)
	{
		$query = $this->db->select('tp.*,tk.nama_keluhan,tu.username')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->join('user tu', 'tu.id_user = tp.teknisi')
			->where('tp.id_pesanan', $id_pesanan)
			->get();
		return $query->result();
	}
}
