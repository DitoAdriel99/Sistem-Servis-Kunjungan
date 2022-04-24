<?php
class Dashboard_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getData()
	{
		$query = $this->db->select('tp.*,tk.nama_keluhan')
			->from('tb_pesanan tp')
			->join('tb_keluhan tk', 'tk.id_keluhan = tp.keluhan')
			->where('tp.status', null)
			->get();
		return $query->result();
	}

	public function getDataTeknisi()
	{
		$query = $this->db->select('*')
			->from('user')
			->where('level', 2)
			->get();
		return $query->result();
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

	public function insertTeknisi($data, $table)
	{
		$this->db->insert($table,$data);
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

	public function cekTeknisi($id_pesanan)
	{
		$query = $this->db->select('user.*')
			->from('user')
			->join('tb_keluhan', 'tb_keluhan.grup = user.grup')
			->join('tb_pesanan', 'tb_pesanan.keluhan = tb_keluhan.id_keluhan')
			->where('user.level', '2')
			->where('user.status', '1')
			->where('tb_pesanan.id_pesanan', $id_pesanan)
			->get();
		return $query->result();
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

	public function cekIdTeknisi($id_user)
	{
		$query = $this->db->get_where('user', ['id_user' => $id_user]);
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

	public function deleteDataTeknisi($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function verifikasi($id_pesanan, $status, $teknisi)
	{
		if ($status == 1) {
			$this->db->trans_start();

			$this->db->query("UPDATE tb_pesanan SET status = $status, teknisi = $teknisi WHERE id_pesanan = $id_pesanan");
			$this->db->query("UPDATE user SET status = '0' where id_user = $teknisi");
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return $result = array('error' => 1);
			} else {
				return $result = array('error' => 0, 'id_pesanan' => $id_pesanan);
			}
		}else{
			$this->db->trans_start();

			$this->db->query("UPDATE tb_pesanan SET status = $status WHERE id_pesanan = $id_pesanan");
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return $result = array('error' => 1);
			} else {
				return $result = array('error' => 0, 'id_pesanan' => $id_pesanan);
			}
		}
		
	}

	public function updateStatusTeknisi($id_user, $status)
	{
		$this->db->where('id_user', $id_user);
		$this->db->update('user', array(
			'status' => $status,
		));
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0, 'id_user' => $id_user);
		} else {
			return $result = array('error' => 1,);
		}
	}
}
