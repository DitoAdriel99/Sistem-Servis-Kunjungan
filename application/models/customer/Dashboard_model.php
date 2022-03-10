<?php
class Dashboard_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getData($id_user)
	{
		$query = $this->db->select('tp.*,tk.nama_keluhan')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->where('id_user', $id_user)
			// ->where('status', null)
			// ->where('status', '1')
			->get();
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'result' => $query->result());
		} else {
			return $result = array('error' => 1);
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
		}else{
			return $result = array('error' => 1, 'result' => 'data tidak ditemukan');
		}
	}

	public function insertData($data, $table)
	{
		$this->db->insert($table, $data);
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0);
		} else {
			return $result = array('error' => 1);
		}
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

	public function editData($data)
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

	public function cekId($id_pesanan)
	{
		$query = $this->db->get_where('tb_pesanan', ['id_pesanan' => $id_pesanan]);
		return $query->result();
	}

	public function ambilId($where)
	{
		$query = $this->db->select('tp.*, tk.nama_keluhan')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->where('tp.id_pesanan', $where)
			// ->where('tp.status', null)
			->get();
		// return $this->db->get_where($table,$where);
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'result' => $query->row());
		} else {
			return $result = array('error' => 1, 'result' => 'data tidak ditemukan');
		}
	}

	public function deleteData($where, $table)
	{
		//   return $this->db->delete('tb_pesanan',['id_pesanan'=>$id_pesanan]);
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function verifikasi($id_pesanan, $status)
	{
		$this->db->where('id_pesanan', $id_pesanan);
		$this->db->update('tb_pesanan', array('status' => $status));
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'id_pesanan' => $id_pesanan);
		} else {
			return $result = array('error' => 1,);
		}
	}
}
