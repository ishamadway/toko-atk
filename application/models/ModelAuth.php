<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelAuth extends CI_Model
{
    public function daftar_user($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function cek_login()
	  {
			$email = set_value('email');
			$password = set_value('password');

			$result = $this->db
				->where('email',$email)
			    ->where('password',md5($password))
				->limit(1)
				->get('user');

			if($result->num_rows() > 0) {
				return $result->row();
			} else {
					return FALSE;
			}
	   }

     public function cek_password_user($id, $old)
     {
       $id = $this->session->userdata('id');
       $old = md5($this->input->post('old_password'));
       $this->db->where('id',$id);
       $this->db->where('password',$old);
       $query = $this->db->get('user');
          return $query->result();
     }

}

?>
