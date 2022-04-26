<?php
class Keluhan_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getKeluhan()
	{
		$query = $this->db->select('*')->from('tb_keluhan')->get();
		return $query->result();
	}

	public function insertData($data,$table)
	{
		$this->db->insert($table,$data);
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0);
		} else {
			return $result = array('error' => 1);
		}
		
	}
	
	public function delete($id_keluhan)
	{
		$this->db->delete('tb_keluhan',['id_keluhan'=>$id_keluhan]);
	}



}
