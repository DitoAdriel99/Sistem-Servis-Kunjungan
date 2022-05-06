<?php
class Profile_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getProfile($id_user)
	{
		$query = $this->db->select('*')->from('user')->where('id_user', $id_user)->get();

		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'result' => $query->row());
		}else{
			return $result = array('error' => 1, 'result' => 'Data tidak ditemukan');
		}
	}

	public function getHistory($id_user)
	{
		$query = $this->db->select('*')
				->from('tb_pesanan')
				->where('teknisi',$id_user)
				->get();
		return $query->result();
	}
}
