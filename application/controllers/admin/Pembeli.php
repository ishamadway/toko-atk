<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli extends CI_Controller {

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
		$data['title'] = 'Data Pembeli - L.U.M Admin';
		$data['pembeli'] = $this->db->query("SELECT * FROM user WHERE role_id='3'")->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/masterdata/pembeli', $data);
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
		$config['total_rows'] = $this->ModelAdmin->count_all_pembeli($search);
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
		 'product_list'   => $this->ModelAdmin->fetch_data_pembeli($config["per_page"], $start, $search)
		);
		echo json_encode($output);
		session_write_close();
		sleep(1);
	}

	public function ubah_data_pembeli()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$no_telp = $this->input->post('no_telp');
		$alamat = $this->input->post('alamat');
		$kota = $this->input->post('kota');
		$kode_pos = $this->input->post('kode_pos');

		$data = array(
			'nama' => $nama,
			'email' => $email,
			'no_telp' => $no_telp,
			'alamat'=> $alamat,
			'kota' => $kota,
			'kode_pos' => $kode_pos
		);

		$where = array(
			'id' => $id
		);

		if(trim($this->input->post('password')) != ''){
			$data['password'] = md5(trim($this->input->post('password')));
		}

		$this->ModelAdmin->update_data($where,$data,'user');
		$this->session->set_flashdata('sukses',
		'<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Data berhasil diubah</strong>
		 </div>');
		redirect('admin/pembeli');
	}

	public function delete_data_pembeli()
	{
		$id = $this->input->post('id');

		$where = array(
			'id' => $id
		);

		$this->ModelAdmin->delete_data($where, 'user');
		$this->session->set_flashdata('sukses',
		'<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Data berhasil dihapus</strong>
		 </div>');
		redirect('admin/pembeli');
	}

}
