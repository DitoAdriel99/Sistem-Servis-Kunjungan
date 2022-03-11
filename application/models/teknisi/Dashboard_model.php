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

	public function statuspekerjaan($id_pesanan, $status_pekerjaan, $time)
	{
		if ($status_pekerjaan == 0) {
			$this->db->trans_start();

			$this->db->query("UPDATE tb_pesanan SET status_pekerjaan = $status_pekerjaan, jam_mulai = $time WHERE id_pesanan = $id_pesanan");
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return $result = array('error' => 1);
			} else {
				return $result = array('error' => 0, 'id_pesanan' => $id_pesanan);
			}
		} else {
			$this->db->query("UPDATE tb_pesanan SET status_pekerjaan = $status_pekerjaan, jam_selesai = $time WHERE id_pesanan = $id_pesanan");
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return $result = array('error' => 1);
			} else {
				return $result = array('error' => 0, 'id_pesanan' => $id_pesanan);
			}
		}
	}
}
