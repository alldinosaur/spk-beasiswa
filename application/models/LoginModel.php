<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	function validasi($table,$where){		
		return $this->db->get_where($table,$where);
	}

	function updateUser($username_lama, $data)
	{
		$this->db->where("username", $username_lama);
		$this->db->update("user", $data);
	}
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */