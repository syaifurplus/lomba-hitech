<?php
class M_user extends CI_Model
{
	public function insert_data($table, $data)
	{
		return $this->db->insert($table, $data);
	}
}