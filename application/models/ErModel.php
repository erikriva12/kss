<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class ErModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

	}

	public function selectData($table)
	{
		return $this->db->get($table);
	}

	public function selectWhere($table, $where)
	{
		$this->db->where($where);
		return $this->db->get($table);
	}


}

/* End of file  */
/* Location: ./application/models/ */