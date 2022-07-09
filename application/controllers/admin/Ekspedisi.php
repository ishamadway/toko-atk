<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekspedisi extends CI_Controller {

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
		$data['ekspedisi'] = $this->db->query("SELECT * FROM ekspedisi")->result();

    	$data['title'] = 'Ekspedisi - L.U.M Admin';
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/masterdata/ekspedisi', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_ekspedisi()
	{
		$nama = $this->input->post('nama_eks');
		$jenis = $this->input->post('jenis_eks');

		$lower_nama = strtolower($nama);
		$lower_jenis = strtolower($jenis);
		$kode_nama = str_replace(' ', '-', $lower_nama);
		$kode_jenis = str_replace(' ', '-', $lower_jenis);

		$id_nama = "$kode_nama"."-";
		$id_jenis = "$kode_jenis";

		$id = $id_nama.$id_jenis;

		$data = array(
			'id_ekspedisi' => $id,
			'nama_ekspedisi' => $nama,
			'jenis_ekspedisi' => $jenis
		);
		$this->ModelAdmin->insert_data($data, 'ekspedisi');
		$this->session->set_flashdata('sukses',
		'<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Data berhasil dibuat</strong>
		 </div>');
		redirect('admin/ekspedisi');
	}

	public function delete_ekspedisi()
	{
		$id = $this->input->post('id_ekspedisi');

		$where = array(
			'id_ekspedisi' => $id
		);

		$this->ModelAdmin->delete_data($where, 'ekspedisi');
		$this->session->set_flashdata('sukses',
		'<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Data berhasil dihapus</strong>
		 </div>');
		redirect('admin/ekspedisi');
	}
}
