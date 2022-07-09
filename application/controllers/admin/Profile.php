<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
    parent::__construct();
		if($this->session->userdata('role_id') != '1')
    {
      redirect('Auth/login');
    }
	}

	public function index()
	{
        $id = $this->session->userdata('id');
        $data['admin'] = $this->db->query("SELECT * FROM user WHERE id='$id'")->result();

		$data['title'] = 'Profile - L.U.M Admin';
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/profile', $data);
		$this->load->view('templates_admin/footer');
	}

    public function ubah_profile()
    {
        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('email','Email','required');

        if($this->form_validation->run() == FALSE){
            $this->index();
          } else {
            $id = $this->session->userdata('id');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            $data = array(
                'nama' => $nama,
                'email' => $email
            );

            $where = array(
                'id' => $id
            );

            $this->db->update('user', $data, $where);

            $this->session->set_flashdata('sukses',
            '<div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Profil berhasil diubah</strong>
              </div>');
            redirect('admin/profile');
          }
    }

    public function ubah_password()
    {
      $this->form_validation->set_rules('old_password','Password saat ini','required');
      $this->form_validation->set_rules('password','Password baru','required');
      $this->form_validation->set_rules('password2','Konfirmasi Password','required|matches[password]');
  
      if($this->form_validation->run() == FALSE){
        $this->index();
      } else {
        $id = $this->session->userdata('id');
        $old = md5($this->input->post('old_password'));
        $cek_password = $this->ModelAuth->cek_password_user($id, $old);
  
        if($cek_password == FALSE){
          $this->session->set_flashdata('gagal',
          '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Password saat ini salah!</strong>
           </div>');
          redirect('admin/profile');
        } else {
          $data = array(
            'password' => md5($this->input->post('password'))
          );
  
          $where = array(
            'id' => $this->session->userdata('id')
          );
  
          $update = $this->db->update('user', $data, $where);
  
          $this->session->set_flashdata('sukses',
          '<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Password berhasil diubah</strong>
           </div>');
          redirect('admin/profile');
        }
      }
    }
}
