<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Kirim_produk extends CI_Controller {

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
    WHERE tr.id_pembeli=us.id AND tr.id_ekspedisi=ep.id_ekspedisi AND tr.status='Dikemas'")->result();

		$data['title'] = 'Kirimkan Produk - L.U.M Admin';
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/penjualan/kirim_produk', $data);
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
		$config['total_rows'] = $this->ModelPenjualan->count_all_kirim_barang($search);
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
		 'product_list'   => $this->ModelPenjualan->fetch_data_kirim_barang($config["per_page"], $start, $search)
		);
		echo json_encode($output);
		session_write_close();
		sleep(1);
	}

	public function atur_pengiriman()
	{
		$string = random_string('numeric', 5);
		$id = 'SH-'.$string;
		$order_id = $this->input->post('order_id');
		date_default_timezone_set('Asia/Jakarta');
		$tgl_dikirim = date('Y-m-d h:i:s');
		$penerima = $this->input->post('nama_pembeli');
		$no_resi = $this->input->post('no_resi');

		$data = array(
			'id_pengiriman' => $id,
			'order_id' => $order_id,
			'tgl_dikirim' => $tgl_dikirim,
			'penerima' => $penerima,
			'no_resi' => $no_resi
		);

		$data1 = array(
		'status' => 'Dikirim'
		);

		$where = array(
		'order_id' => $order_id
		);

		$notif = array(
		'read' => 0,
		'created' => date('Y-m-d H:i')
		);

		$where1= array(
		'order_id' => $order_id
		);

		$insert = $this->ModelPenjualan->insert_data($data, 'pengiriman');
		$update = $this->ModelPenjualan->update_data($where, $data1, 'transaksi');
		$this->db->update('notifikasi', $notif, $where1);

		$this->session->set_flashdata('sukses','<div class="alert alert-success
			alert-dismissible fade show" role"alert">
			Pengiriman Pesanan berhasil diatur!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span arla-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/kirim_produk');
	}

	public function cetak_label($id)
	{
		$this->load->library('pdfgenerator');
		date_default_timezone_set("Asia/Jakarta");

		$this->data['title'] = "Label No. $id - LUM Store";
		$this->data['pesanan'] = $this->db->query("SELECT * FROM transaksi tr, user us, ekspedisi ep WHERE tr.id_pembeli=us.id AND tr.id_ekspedisi=ep.id_ekspedisi AND tr.order_id='$id'")->result();
		$this->data['item'] = $this->db->query("SELECT * FROM item_pesanan ip, produk pd WHERE ip.id_produk=pd.id AND ip.order_id='$id'")->result();

		 // filename dari pdf ketika didownload
		 $filename = "Label No. $id - LUM Store";
  
		 $html = $this->load->view('admin/cetak_label', $this->data, true);
  
		 // run dompdf
		 $this->pdfgenerator->cetak_label($html,$filename);
	}

}
