<?php
class History_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getHistory()
	{
		$query = $this->db->select('tp.*,tk.nama_keluhan,tu.username')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->join('user tu', 'tu.id_user = tp.teknisi')
			->where('verifikasi_pembayaran',1)
			->get();
		return $query->result();
	}

}