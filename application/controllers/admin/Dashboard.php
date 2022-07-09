<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$data['produk'] = $this->db->query("SELECT * FROM produk")->result();
		$data['penjualan'] = $this->db->query("SELECT sum(grand_total) as total_amount, count(order_id) as total_trans FROM transaksi WHERE status='Selesai'")->result();

		$data['title'] = 'Dashboard - L.U.M Admin';
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('dashboard');
		$this->load->view('templates_admin/footer');
	}
}
