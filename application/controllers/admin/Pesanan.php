<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Pesanan extends CI_Controller {

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
    $data['pesanan'] = $this->db->query("SELECT * FROM transaksi tr, user us, ekspedisi ep
    WHERE tr.id_pembeli=us.id AND tr.id_ekspedisi=ep.id_ekspedisi")->result();

		$data['title'] = 'Pesanan - L.U.M Admin';
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/penjualan/pesanan', $data);
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
		$config['total_rows'] = $this->ModelPenjualan->count_all_pesanan($search);
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
		 'product_list'   => $this->ModelPenjualan->fetch_data_pesanan($config["per_page"], $start, $search)
		);
		echo json_encode($output);
		session_write_close();
		sleep(1);
	}

  public function detail($order_id)
  {
	$data = array(
        'read' => '1'
    );

    $where = array(
        'order_id' => $order_id,
		'role' => 1
    );

    $this->db->update('notifikasi', $data, $where);

    $data['pesanan'] = $this->db->query("SELECT * FROM transaksi tr, user us, ekspedisi ep
    WHERE tr.id_pembeli=us.id AND tr.id_ekspedisi=ep.id_ekspedisi AND tr.order_id='$order_id'")->result_array();

	$data['item_pesanan'] = $this->db->query("SELECT * FROM item_pesanan ip, transaksi tr, ekspedisi ep, produk pd
	WHERE tr.id_ekspedisi=ep.id_ekspedisi AND ip.id_produk=pd.id AND ip.order_id='$order_id' GROUP BY ip.id")->result_array();

	$data['pengiriman'] = $this->db->query("SELECT * FROM pengiriman pn, transaksi tr WHERE pn.order_id='$order_id'")->result_array();

	$data['dibatalkan'] = $this->db->query("SELECT * FROM transaksi tr, notifikasi nt WHEre tr.order_id='$order_id'")->result_array();

    $data['title'] = 'Detail Pesanan - L.U.M Admin';
    $this->load->view('templates_admin/header', $data);
    $this->load->view('templates_admin/sidebar');
    $this->load->view('admin/penjualan/detail_pesanan', $data);
    $this->load->view('templates_admin/footer');
  }

}
