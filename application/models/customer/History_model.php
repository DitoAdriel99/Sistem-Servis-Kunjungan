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
		return $query->result();
	}
}
