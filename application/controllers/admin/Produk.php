<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Produk extends CI_Controller {

	function __construct()
	{
    parent::__construct();
		if($this->session->userdata('role_id') != '1')
    {
      redirect('Auth/login');
    }
	}

	//all product
	public function all()
	{
		$data['title'] = 'Semua Produk - L.U.M Admin';
		$data['produk'] = $this->db->query("SELECT * FROM produk pd, kategori kt
			WHERE pd.kategori_id=kt.id_kategori ORDER BY pd.date_updated DESC")->result();
		$data['kategori'] = $this->db->query("SELECT * FROM kategori ")->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/masterdata/produk_all', $data);
		$this->load->view('templates_admin/footer');
	}

	public function fetch_data()
	{
		if(!isset($_SESSION))
		{
				session_start();
		}

		$search = $this->input->post('search');
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->ModelAdmin->count_all_all($search);
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(4);
		$start = ($page - 1) * $config['per_page'];
		$output = array(
		 'pagination_link'  => $this->pagination->create_links(),
		 'product_list'   => $this->ModelAdmin->fetch_data_all($config["per_page"], $start, $search)
		);
		echo json_encode($output);
		session_write_close();
		sleep(1);
	}
	//end of all product

	//produk habis
	public function habis()
	{
		$data['title'] = 'Produk Habis - L.U.M Admin';
		$data['habis'] = $this->db->query("SELECT * FROM produk pd, kategori kt
			WHERE pd.kategori_id=kt.id_kategori AND pd.stok='0' ORDER BY pd.date_updated DESC")->result();
		$data['kategori'] = $this->db->query("SELECT * FROM kategori ")->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/masterdata/produk_habis', $data);
		$this->load->view('templates_admin/footer');
	}

	public function fetch_data_habis()
	{
		if(!isset($_SESSION))
		{
				session_start();
		}

		$search = $this->input->post('search');
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->ModelAdmin->count_all_habis($search);
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(4);
		$start = ($page - 1) * $config['per_page'];
		$output = array(
		 'pagination_link'  => $this->pagination->create_links(),
		 'product_list'   => $this->ModelAdmin->fetch_data_habis($config["per_page"], $start, $search)
		);
		echo json_encode($output);
		session_write_close();
		sleep(1);
	}
	// end of produk habis

	public function diarsipkan()
	{
		$data['title'] = 'Produk Diarsipkan - L.U.M Admin';
		$data['diarsipkan'] = $this->db->query("SELECT * FROM produk pd, kategori kt
			WHERE pd.kategori_id=kt.id_kategori AND pd.arsip='1' ORDER BY pd.date_updated DESC")->result();
		$data['kategori'] = $this->db->query("SELECT * FROM kategori ")->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/masterdata/produk_diarsipkan', $data);
		$this->load->view('templates_admin/footer');
	}

	public function fetch_data_arsip()
	{
		if(!isset($_SESSION))
		{
				session_start();
		}

		$search = $this->input->post('search');
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->ModelAdmin->count_all_arsip($search);
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(4);
		$start = ($page - 1) * $config['per_page'];
		$output = array(
		 'pagination_link'  => $this->pagination->create_links(),
		 'product_list'   => $this->ModelAdmin->fetch_data_arsip($config["per_page"], $start, $search)
		);
		echo json_encode($output);
		session_write_close();
		sleep(1);
	}

	public function tambah_produk()
	{
		$data['title'] = 'Tambah Produk - L.U.M Admin';
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/masterdata/tambah_produk');
		$this->load->view('templates_admin/footer');
	}

	public function tambah_produk_aksi()
	{
		$string = random_string('numeric', 5);
		$id = 'PD-'.$string;
		$nama = $this->input->post('nama');
		$deskripsi = $this->input->post('deskripsi');
		$kategori = $this->input->post('id_kategori');
		$brand = $this->input->post('merek');
		$stok = $this->input->post('stok');
		$harga = $this->input->post('harga');
		$sku = $this->input->post('sku');
		$created = date('Y-m-d h:i:s');
		$lower = strtolower($nama);
		$url = str_replace(' ', '-', $lower);

		$config['upload_path']   = './assets/uploads/produk/';
    	$config['allowed_types'] = 'jpg|png|jpeg';
    	$config['max_size']      = 2048;
		$config['max_width'] = '1080';
		$config['max_height'] = '1080';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('gambar'))
    	{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);die;
    	} else {
	    //$data = array('upload_data' => $this->upload->data());
	    $file_name = $this->upload->data('file_name');
	    /*here assuming that your column name for image is image_name, change it not*/
			$data = array(
				'id' => $id,
				'nama' => $nama,
				'deskripsi' => $deskripsi,
				'kategori_id' => $kategori,
				'merek' => $brand,
				'stok' => $stok,
				'harga' => $harga,
				'sku' => $sku,
				'date_created' => $created,
				'date_updated' => $created,
				'url_produk' => $url,
				'gambar' => $file_name
			);
			$this->ModelAdmin->insert_data($data, 'produk');
			$this->session->set_flashdata('sukses',
			'<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Data berhasil dibuat</strong>
			 </div>');
			redirect('admin/produk/all');
		}
 	}

	public function ubah_produk($id)
	{
		$data['title'] = 'Ubah Produk - L.U.M Admin';
		$data['produk'] = $this->db->query("SELECT * FROM produk pd, kategori kt
			WHERE pd.kategori_id=kt.id_kategori AND pd.id='$id'")->result();
		$data['kategori'] = $this->db->query("SELECT * FROM kategori")->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/masterdata/ubah_produk', $data);
		$this->load->view('templates_admin/footer');
	}

	public function ubah_produk_aksi()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$deskripsi = $this->input->post('deskripsi');
		$kategori = $this->input->post('id_kategori');
		$brand = $this->input->post('merek');
		$stok = $this->input->post('stok');
		$harga = $this->input->post('harga');
		$sku = $this->input->post('sku');
		$updated = date('Y-m-d h:i:s');
		$lower = strtolower($nama);
		$url = str_replace(' ', '-', $lower);

		$config['upload_path']   = './assets/uploads/produk/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']      = 2048;
		$config['max_width'] = '1080';
		$config['max_height'] = '1080';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

			$data = array(
				'nama' => $nama,
				'deskripsi' => $deskripsi,
				'kategori_id' => $kategori,
				'merek' => $brand,
				'stok' => $stok,
				'harga' => $harga,
				'sku' => $sku,
				'date_updated' => $updated,
				'url_produk' => $url
			);

			$where = array(
				'id' => $id
			);

			if(trim($this->upload->do_upload('gambar')) != '') {

				if ( ! $this->upload->do_upload('gambar'))
		    {
			    $error = array('error' => $this->upload->display_errors());
			    print_r($error);die;
		    }
		    else
		    {
			    //$data = array('upload_data' => $this->upload->data());
			    $file_name = $this->upload->data('file_name');
			    /*here assuming that your column name for image is image_name, change it not*/
					$data['gambar'] = $file_name;
				}
			}

			$this->ModelAdmin->update_data($where, $data, 'produk');
			$this->session->set_flashdata('sukses',
			'<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Data berhasil diubah</strong>
			 </div>');
			redirect('admin/produk/all');
	}

	public function arsipkan_produk($id)
	{
		$arsip = 1;

		$data = array(
			'arsip' => $arsip
		);

		$where = array(
			'id' => $id
		);

		$this->ModelAdmin->update_data($where, $data, 'produk');
		redirect('admin/produk/all');
	}

	public function tampilkan_produk($id)
	{
		$arsip = 0;

		$data = array(
			'arsip' => $arsip
		);

		$where = array(
			'id' => $id
		);

		$this->ModelAdmin->update_data($where, $data, 'produk');
		redirect('admin/produk/all');
	}

	public function delete_produk()
	{
		$id = $this->input->post('id');

		$where = array(
			'id' => $id
		);

		$this->ModelAdmin->delete_data($where, 'produk');
		$this->session->set_flashdata('sukses',
		'<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Data berhasil dihapus</strong>
		 </div>');
		redirect('admin/produk/all');
	}
}
