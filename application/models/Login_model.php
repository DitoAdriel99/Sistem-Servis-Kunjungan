<?php
class Login_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function login($user,$pass)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username',$user);
		$this->db->where('password',$pass);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows()==1) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function insertCustomer($data, $table)
	{
		$this->db->insert($table,$data);
		$exist = $this->db->affected_rows();
		if ($exist > 0) {
			return $result = array('error' => 0);
		} else {
			return $result = array('error' => 1);
		}
	}
}
