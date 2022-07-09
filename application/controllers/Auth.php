<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		$data['title'] = 'Login to your account! - L.U.M Office Stationery Store';
      	$this->load->view('templates_user/header', $data);
      	$this->load->view('templates_user/topbar');
      	$this->load->view('login');
      	$this->load->view('templates_user/footer');
	}

	public function register()
	{
		$data['title'] = 'Create an account! - L.U.M Office Stationery Store';
		$this->load->view('templates_user/header', $data);
		$this->load->view('templates_user/topbar');
		$this->load->view('register');
		$this->load->view('templates_user/footer');
	}

	public function daftar()
	{
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('no_telp','No. Telp','required');
		$this->form_validation->set_rules('kota','Kota','required');
		$this->form_validation->set_rules('kode_pos','Kode Pos','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() == FALSE) {
			$this->register();
		} else {
			$string 		= random_string('numeric',5);
			$id				= 'P-'.$string;
			$nama         	= $this->input->post('nama');
			$email 	        = $this->input->post('email');
			$no_telp 	    = $this->input->post('no_telp');
			$alamat         = $this->input->post('alamat');
			$kota 	        = $this->input->post('kota');
			$kode_pos 	    = $this->input->post('kode_pos');
			$password	  	= md5($this->input->post('password'));
			$role_id        = '3';

			$data = array(
			'id'		=> $id,
			'nama'      => $nama,
			'email'	    => $email,
			'no_telp'   => $no_telp,
			'alamat'	=> $alamat,
			'kota' 		=> $kota,
			'kode_pos'	=> $kode_pos,
			'password'	=> $password,
			'role_id'   => $role_id
			);

			$insert = $this->ModelAuth->daftar_user($data, 'user');
				$this->session->set_flashdata('sukses',
				'<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Berhasil mendaftar!</strong> Silahkan masuk dengan akun yang terdaftar.
				 </div>');
				redirect('auth/login');
		}
	}

  public function masuk()
  {
	    $this->form_validation->set_rules('email','Email','required');
	    $this->form_validation->set_rules('password','Password','required');
	    if($this->form_validation->run() == FALSE) {
	    	$this->login();
	    } else {
	      $email = $this->input->post('email');
	      $password = md5($this->input->post('password'));

	      $cek = $this->ModelAuth->cek_login($email, $password);
	      if($cek == FALSE)
	      {
	        $this->session->set_flashdata('gagal',
					'<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Username atau Password salah!</strong>.
					 </div>');
	        redirect('auth/login');
	      } else {
	        $this->session->set_userdata('email', $cek->email);
			$this->session->set_userdata('password', $cek->password);
	        $this->session->set_userdata('id', $cek->id);
	        $this->session->set_userdata('role_id', $cek->role_id);
	        $this->session->set_userdata('nama', $cek->nama);
			$this->session->set_userdata('no_telp', $cek->no_telp);
	        $this->session->set_userdata('alamat', $cek->alamat);
			$this->session->set_userdata('kota', $cek->kota);
			$this->session->set_userdata('kode_pos', $cek->kode_pos);
			$this->session->set_userdata('foto', $cek->foto);

					if($this->session->userdata('role_id') == '3') {
						$this->db->select('*');
						$this->db->from('temp_cart');
						$this->db->where('id_pembeli', $this->session->userdata('id'));
						$res=$this->db->get();

						if(isset($res))
						{
						    foreach($res->result_array() as $row)
						    {
					        $productData = array(
					        'id'      => $row['id_produk'],
					        'qty'     => $row['quantity'],
					        'price'   => $row['harga'],
					        'name' 		=> $row['nama_produk'],
					        'image' 	=> $row['gambar'],
							'url' 		=> $row['url_produk']
					        );
					        $rowId = $this->cart->insert($productData);
						    }

						    $this->db->from('temp_cart');
						    $this->db->where('id_pembeli', $this->session->userdata('id'));
						    $this->db->delete();
						}
					}

	        switch ($cek->role_id) {
	          case 1 :  redirect('admin/dashboard');
	                    break;
	          case 2 :	redirect('admin/dashboard');
	                    break;
	          case 3 :	redirect('Homepage');
	                    break;
	          default:  break;
	      }
	    }
	 	}
  }

  public function logout()
  {
	$string = random_string('numeric',5);
	$cart_row = 'CR-'.$string;

	if(count($this->cart->contents()) > 0){
		foreach ($this->cart->contents() as $items){
			$this->db->from('temp_cart');
			$this->db->set('cart_row', $cart_row);
			$this->db->set('id_pembeli', $this->session->userdata('id'));
			$this->db->set('id_produk', $items['id']);
			$this->db->set('nama_produk', $items['name']);
			$this->db->set('quantity', $items['qty']);
			$this->db->set('harga', $items['price']);
			$this->db->set('gambar', $items['image']);
			$this->db->set('url_produk', $items['url']);
			$this->db->insert();
		}
	}

    $this->session->sess_destroy();
    redirect('auth/login');
  }

}
?>
