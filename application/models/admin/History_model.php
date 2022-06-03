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
			->order_by('tp.tanggal_pesanan', 'desc')
			->get();
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'result' => $query->result());
		}else{
			return $result = array('error' => 0, 'result' => 'Data tidak ditemukan');
		}
	}
	

}
