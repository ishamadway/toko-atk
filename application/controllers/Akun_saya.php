<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_saya extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      if($this->session->userdata('id') == NULL){
          redirect('Auth/login');
      }
  }

  public function index()
  {
    $id_pembeli = $this->session->userdata('id');
    $data['pembeli'] = $this->db->query("SELECT * FROM user WHERE id='$id_pembeli'")->result();

    $data['title'] = 'Akun Saya - L.U.M Office Stationery Store';
    $this->load->view('templates_user/header', $data);
    $this->load->view('templates_user/topbar', $data);
    $this->load->view('user/akun_saya', $data);
    $this->load->view('templates_user/footer');
  }

  public function ubah_password()
  {
    $this->form_validation->set_rules('old_password','Password saat ini','required');
    $this->form_validation->set_rules('new_password','Password baru','required');
    $this->form_validation->set_rules('new_password2','Konfirmasi Password','required|matches[new_password]');

    if($this->form_validation->run() == FALSE){
      redirect('akun_saya');
    } else {
      $id = $this->input->post('id_pembeli');
      $old = md5($this->input->post('old_password'));
      $cek_password = $this->ModelAuth->cek_password_user($id, $old);

      if($cek_password == FALSE){
        $this->session->set_flashdata('gagal',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Password salah!</strong> Password saat ini yang anda masukan salah!
         </div>');
        redirect('akun_saya');
      } else {
        $data = array(
          'password' => md5($this->input->post('new_password'))
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
        redirect('akun_saya');
      }
    }
  }

  function ubah_profil()
  {
    $this->form_validation->set_rules('nama','Nama Lengkap','required');
    $this->form_validation->set_rules('alamat','Alamat','required');
    $this->form_validation->set_rules('kota','Kota','required');
    $this->form_validation->set_rules('kode_pos','Kode Pos','required');

    if($this->form_validation->run() == FALSE){
      redirect('akun_saya');
    } else {
      $id = $this->input->post('id');
      $nama = $this->input->post('nama');
      $alamat = $this->input->post('alamat');
      $kota = $this->input->post('kota');
      $kode_pos = $this->input->post('kode_pos');

      $config['upload_path']   = './assets/uploads/user/';
    	$config['allowed_types'] = 'jpg|png|jpeg';
    	$config['max_size']      = 2048;
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      $data = array(
        'nama' => $nama,
        'alamat' => $alamat,
        'kota' => $kota,
        'kode_pos' => $kode_pos
      );

      $where = array(
        'id' => $id
      );

      if(trim($this->upload->do_upload('foto')) != '') {

				if ( ! $this->upload->do_upload('foto'))
		    {
			    $error = array('error' => $this->upload->display_errors());
			    print_r($error);die;
		    }
		    else
		    {
			    //$data = array('upload_data' => $this->upload->data());
			    $file_name = $this->upload->data('file_name');
			    /*here assuming that your column name for image is image_name, change it not*/
					$data['foto'] = $file_name;
				}
			}

      $update = $this->db->update('user', $data, $where);

      $this->session->set_userdata('nama', $this->input->post('nama'));
      $this->session->set_userdata('alamat', $this->input->post('alamat'));
      $this->session->set_userdata('kota', $this->input->post('kota'));
      $this->session->set_userdata('kode_pos', $this->input->post('kode_pos'));

      $this->session->set_flashdata('sukses',
      '<div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Profil berhasil diubah</strong>
        </div>');
      redirect('akun_saya');
    }
  }

  function email()
  {
    $id_pembeli = $this->session->userdata('id');
    $data['pembeli'] = $this->db->query("SELECT * FROM user WHERE id='$id_pembeli'")->result();

    $data['title'] = 'Akun Saya - L.U.M Office Stationery Store';
    $this->load->view('templates_user/header', $data);
    $this->load->view('templates_user/topbar', $data);
    $this->load->view('user/email', $data);
    $this->load->view('templates_user/footer');
  }

  function check_password_for_email()
  {
    $this->form_validation->set_rules('old_password','Password','required');

    if($this->form_validation->run() == FALSE){
      $this->session->set_flashdata('gagal',
      '<div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Silahkan isi password akun anda</strong>
        </div>');
      redirect('akun_saya/email');
    } else {
      $id = $this->input->post('id_pembeli');
      $old = md5($this->input->post('old_password'));
      $cek_password = $this->ModelAuth->cek_password_user($id, $old);

      if($cek_password == FALSE){
        $this->session->set_flashdata('gagal',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Password salah!</strong> Password yang anda masukan salah!
         </div>');
        redirect('akun_saya/email');
      } else {
        $code = rand();
        $id = sha1($code);
        $this->session->set_userdata('code_access', $id);
        redirect('akun_saya/ubah_email/'.$id);
      }
    }
  }

  function ubah_email($id)
  {
    if($this->session->userdata('code_access') != $id){
      redirect('akun_saya');
    }

    $id_pembeli = $this->session->userdata('id');
    $data['pembeli'] = $this->db->query("SELECT * FROM user WHERE id='$id_pembeli'")->result();

    $data['title'] = 'Ubah Email - L.U.M Office Stationery Store';
    $this->load->view('templates_user/header', $data);
    $this->load->view('templates_user/topbar', $data);
    $this->load->view('user/ubah_email', $data);
    $this->load->view('templates_user/footer');
  }

  function ubah_email_aksi($id)
  {
    $this->form_validation->set_rules('email','Email','required');

    if($this->form_validation->run() == FALSE){
      $this->ubah_email($id);
    } else {
      $id = $this->input->post('id_pembeli');
      $email = $this->input->post('email');

      $data = array(
        'email' => $email
      );

      $where = array(
        'id' => $id
      );

      $this->db->update('user', $data, $where);
      $this->session->unset_userdata('code_access');
      $this->session->set_flashdata('sukses',
      '<div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Email berhasil diubah</strong>
        </div>');
      redirect('akun_saya');
    }
  }

  function no_telp()
  {
    $id_pembeli = $this->session->userdata('id');
    $data['pembeli'] = $this->db->query("SELECT * FROM user WHERE id='$id_pembeli'")->result();

    $data['title'] = 'Akun Saya - L.U.M Office Stationery Store';
    $this->load->view('templates_user/header', $data);
    $this->load->view('templates_user/topbar', $data);
    $this->load->view('user/no_telp', $data);
    $this->load->view('templates_user/footer');
  }

  function check_password_for_notelp()
  {
    $this->form_validation->set_rules('old_password','Password','required');

    if($this->form_validation->run() == FALSE){
      $this->session->set_flashdata('gagal',
      '<div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Silahkan isi password akun anda</strong>
        </div>');
      redirect('akun_saya/no_telp');
    } else {
      $id = $this->input->post('id_pembeli');
      $old = md5($this->input->post('old_password'));
      $cek_password = $this->ModelAuth->cek_password_user($id, $old);

      if($cek_password == FALSE){
        $this->session->set_flashdata('gagal',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Password salah!</strong> Password yang anda masukan salah!
         </div>');
        redirect('akun_saya/no_telp');
      } else {
        $code = rand();
        $id = sha1($code);
        $this->session->set_userdata('code_access', $id);
        redirect('akun_saya/ubah_notelp/'.$id);
      }
    }
  }

  function ubah_notelp($id)
  {
    if($this->session->userdata('code_access') != $id){
      redirect('akun_saya');
    }

    $id_pembeli = $this->session->userdata('id');
    $data['pembeli'] = $this->db->query("SELECT * FROM user WHERE id='$id_pembeli'")->result();

    $data['title'] = 'Ubah Nomor Telepon - L.U.M Office Stationery Store';
    $this->load->view('templates_user/header', $data);
    $this->load->view('templates_user/topbar', $data);
    $this->load->view('user/ubah_notelp', $data);
    $this->load->view('templates_user/footer');
  }

  function ubah_notelp_aksi($id)
  {
    $this->form_validation->set_rules('no_telp','Nomor Telepon','required');

    if($this->form_validation->run() == FALSE){
      $this->ubah_notelp($id);
    } else {
      $id = $this->input->post('id_pembeli');
      $notelp = $this->input->post('no_telp');

      $data = array(
        'no_telp' => $notelp
      );

      $where = array(
        'id' => $id
      );

      $this->db->update('user', $data, $where);
      $this->session->unset_userdata('code_access');
      $this->session->set_flashdata('sukses',
      '<div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Nomor Telepon berhasil diubah</strong>
        </div>');
      redirect('akun_saya');
    }
  }

}
