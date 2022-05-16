<?php
class Dashboard_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getData($id_teknisi)
	{
		$query = $this->db->select('tp.*,tk.nama_keluhan')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->where('tp.teknisi', $id_teknisi)
			->where('tp.verifikasi_pembayaran', null)
			->get();
		return $query->result();
	}

	public function cekHarga($id = null)
	{
		if ($id != null) {
			$query = $this->db->get_where('tb_keluhan', array('id_keluhan' => $id));
			return $query->row();
		} else {
			$query = $this->db->get('tb_keluhan');
			return $query->result();
		}
	}

	public function getId($where)
	{
		$query = $this->db->select('tp.*, tk.nama_keluhan')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->where('tp.id_pesanan', $where)
			->get();
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'result' => $query->row());
		} else {
			return $result = array('error' => 1, 'result' => 'data tidak ditemukan');
		}
	}

	public function statuspekerjaan($data)
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

	public function selesai($data)
	{
		$this->db->where('id_pesanan', $data['id_pesanan']);
		$this->db->update('tb_pesanan', array(
			'gambar_pekerjaan' => $data['gambar_pekerjaan'],
			'barang_tambahan' => $data['barang_tambahan'],
			'biaya_tambahan' => $data['biaya_tambahan'],
		));
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'id_pesanan' => $data['id_pesanan']);
		} else {
			return $result = array('error' => 1,);
		}
	}
}
