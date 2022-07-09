<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Transaksi extends CI_Controller {

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
    $data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr, user us
    WHERE tr.id_pembeli=us.id")->result();

		$data['title'] = 'Transaksi - L.U.M Admin';
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/laporan/transaksi', $data);
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
		$config['total_rows'] = $this->ModelPenjualan->count_all_transaksi($search);
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
		 'product_list'   => $this->ModelPenjualan->fetch_data_transaksi($config["per_page"], $start, $search)
		);
		echo json_encode($output);
		session_write_close();
		sleep(1);
	}

}
