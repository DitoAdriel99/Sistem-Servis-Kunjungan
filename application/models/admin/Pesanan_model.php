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
		return $query->result();
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
		return $query->result();
	}

	public function verifikasi($data)
	{
		$this->db->where('id_pesanan',$data['id_pesanan']);
		$this->db->update('tb_pesanan',$data);
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'id_pesanan' => $data['id_pesanan']);
		} else {
			return $result = array('error' => 1,);
		}
	}

}
