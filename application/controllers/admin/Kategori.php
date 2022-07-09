<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

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
		$data['title'] = 'Kategori - L.U.M Admin';
		$data['kategori'] = $this->db->query("SELECT * FROM kategori")->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/masterdata/kategori', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_kategori()
	{
		$kategori = $this->input->post('kategori');
		$lower = strtolower($kategori);
		$url = str_replace(' ', '-', $lower);

		$data = array(
			'kategori' => $kategori,
			'url' => $url
		);
		$this->ModelAdmin->insert_data($data, 'kategori');
		$this->session->set_flashdata('sukses',
		'<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Data berhasil dibuat</strong>
		 </div>');
		redirect('admin/kategori');
	}

	public function ubah_kategori()
	{
		$id = $this->input->post('id_kategori');
		$kategori = $this->input->post('kategori');
		$lower = strtolower($kategori);
		$url = str_replace(' ', '-', $lower);

		$data = array(
			'kategori' => $kategori,
			'url' => $url
		);

		$where = array(
			'id_kategori' => $id
		);

		$this->ModelAdmin->update_data($where,$data,'kategori');
		$this->session->set_flashdata('sukses',
		'<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Data berhasil diubah</strong>
		 </div>');
		redirect('admin/kategori');
	}

	public function delete_kategori()
	{
		$id = $this->input->post('id');

		$where = array(
			'id' => $id
		);

		$this->ModelAdmin->delete_data($where, 'kategori');
		$this->session->set_flashdata('sukses',
		'<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Data berhasil dihapus</strong>
		 </div>');
		redirect('admin/kategori');
	}
}
