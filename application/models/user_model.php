<?php
class User_Model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	public function getAll($limit = 20, $offset = 0, $where = null)
	{
		$query = $this->db->get('t_love2015_user', $limit, $offset);
		$result = array();
		foreach ($query->result() as $row){
			$result[] = array(
				'id' => $row->id,
				'name' => $row->name,
				'tel' => $row->tel,
				'address' => $row->address,
				'type' => $row->type,
				'create_time' => $row->create_time,
				'create_ip' => $row->create_ip,
				);
		}
		return $result;
	}
	public function getSum($where = null)
	{
		return $this->db->count_all_results('t_love2015_user');
	}
	public function getFields()
	{
		return array(
			'id'=>'ID',
			'name' => 'name',
			'tel'=>'tel',
			'address'=>'address',
			'type'=>'type',
			'create_time' => '创建时间',
			'create_ip' => '创建IP',
			);
	}
}