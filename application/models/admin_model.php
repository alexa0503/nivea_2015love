<?php
class admin_Model extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
    public function getUserByname($user_name){
    	$user_name = trim($user_name);
    	$query = $this->db->where('user_name', $user_name)->limit(1)->get('admin');
    	if($query->num_rows === 0)
    		return null;
    	else
    		return $query->row();
    }
}