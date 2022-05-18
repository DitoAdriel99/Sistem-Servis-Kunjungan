<?php
class History_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getHistory($id_user)
	{
		$query = $this->db->select('tp.*,tk.nama_keluhan,tu.username')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->join('user tu', 'tu.id_user = tp.teknisi')
			->where('tp.id_user', $id_user)
			->get();
		return $query->result();
	}

	public function getBukti($id_pesanan)
	{
		$query = $this->db->select('tp.*,tk.nama_keluhan,tu.username')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->join('user tu', 'tu.id_user = tp.teknisi')
			->where('tp.id_pesanan', $id_pesanan)
			->get();
		
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'result' => $query->row());
		}else{
			return $result = array('error' => 0, 'result' => 'Data tidak ditemukan');
		}
	}
}
