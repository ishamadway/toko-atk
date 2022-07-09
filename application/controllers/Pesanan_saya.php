<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      if($this->session->userdata('id') == NULL){
          redirect('Auth/login');
      }
  }

  public function index()
  {
    $pembeli = $this->session->userdata('id');

    $data['belum_bayar'] = $this->db->query("SELECT * FROM transaksi tr
      WHERE tr.status='Belum Bayar' AND tr.id_pembeli='$pembeli' ORDER BY tr.transaction_time DESC")->result();
    $data['dikemas'] = $this->db->query("SELECT * FROM transaksi tr
      WHERE tr.status='Dikemas' AND tr.id_pembeli='$pembeli'")->result();
    $data['dikirim'] = $this->db->query("SELECT * FROM transaksi tr, pengiriman pg
      WHERE pg.order_id=tr.order_id AND tr.status='Dikirim' AND tr.id_pembeli='$pembeli'")->result();
    $data['selesai'] = $this->db->query("SELECT * FROM transaksi tr, pengiriman pg
      WHERE pg.order_id=tr.order_id AND tr.status='Selesai' AND tr.id_pembeli='$pembeli'")->result();
    $data['pengiriman'] = $this->db->query("SELECT * FROM pengiriman pn, transaksi tr
      WHERE pn.order_id=tr.order_id AND tr.id_pembeli='$pembeli'")->result();

    $data['title'] = 'Pesanan Saya - L.U.M Office Stationery Store';
    $this->load->view('templates_user/header', $data);
    $this->load->view('templates_user/topbar', $data);
    $this->load->view('pesanan_saya', $data);
    $this->load->view('templates_user/footer');
  }

  public function detail($id)
  {
    $data = array(
      'read' => '1'
    );

    $where = array(
        'order_id' => $id,
        'role' => 2
    );

    $this->db->update('notifikasi', $data, $where);

    $data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr, ekspedisi ep, user us
      WHERE tr.id_ekspedisi=ep.id_ekspedisi AND tr.id_pembeli=us.id AND order_id='$id'")->result();
    $data['notif'] = $this->db->query("SELECT * FROM transaksi tr, notifikasi nt WHERE tr.order_id='$id'")->result();
    $data['item_pesanan'] = $this->db->query("SELECT * FROM item_pesanan ip, produk pd
      WHERE ip.id_produk=pd.id AND order_id='$id'")->result();
    $data['pengiriman'] = $this->db->query("SELECT * FROM pengiriman pn, transaksi tr
      WHERE pn.order_id=tr.order_id AND pn.order_id='$id'")->result();

    $data['title'] = 'Detail Pesanan - L.U.M Office Stationery Store';
    $this->load->view('templates_user/header', $data);
    $this->load->view('templates_user/topbar', $data);
    $this->load->view('detail_pesanan', $data);
    $this->load->view('templates_user/footer');
  }

  public function trial_bayar()
  {
    $id_pembeli = $this->session->userdata('id');
    $order_id = $this->input->post('order_id');
    date_default_timezone_set('Asia/Jakarta');
    $settlement_time = date('Y-m-d H:i:s');
    $status_code = '200';
    $status = 'Dikemas';

    $data = array(
      'settlement_time' => $settlement_time,
      'status_code' => $status_code,
      'status' => $status
    );

    $where = array(
      'order_id' => $order_id
    );

    $notif = array(
      array(
        'order_id' => $order_id,
        'id_user' => $id_pembeli,
        'role' => 1,
        'created' => date('Y-m-d H:i')
      ),
      array(
        'order_id' => $order_id,
        'id_user' => $id_pembeli,
        'role' => 2,
        'created' => date('Y-m-d H:i')
      )
    );

    if($order_id != NULL){
      $this->db->update('transaksi', $data, $where);
      $this->db->insert_batch('notifikasi', $notif);
      redirect('pesanan_saya');
    }
  }

  public function selesaikan_pesanan()
  {
    $order_id = $this->input->post('order_id');
    date_default_timezone_set('Asia/Jakarta');
    $tgl_diterima = date('Y-m-d H:i:s');
    $status = 'Selesai';

    $trans = array(
      'status' => $status
    );

    $pengiriman = array(
      'tgl_diterima' => $tgl_diterima,
      'status' => '1'
    );

    $notif = array(
      'read' => 0,
      'created' => date('Y-m-d H:i:s')
    );

    $where = array(
      'order_id' => $order_id
    );

    $this->db->update('pengiriman', $pengiriman, $where);
    $this->db->update('transaksi', $trans, $where);
    $this->db->update('notifikasi', $notif, $where);
    redirect('pesanan_saya/penilaian/'.$order_id);
  }

  public function penilaian($order_id)
  {
    $data['pesanan'] = $this->db->query("SELECT * FROM transaksi tr, item_pesanan ip, produk pr
    WHERE tr.order_id=ip.order_id AND ip.id_produk=pr.id AND tr.order_id='$order_id' ORDER BY ip.id")->result();

    $data['title'] = 'Beri Nilai - L.U.M Office Stationery Store';
    $this->load->view('templates_user/header', $data);
    $this->load->view('templates_user/topbar', $data);
    $this->load->view('beri_nilai', $data);
    $this->load->view('templates_user/footer');
  }

  public function beri_nilai()
  {
    date_default_timezone_set('Asia/Jakarta');
    $id_produk = $this->input->post('id_produk');
    $bintang = $this->input->post('bintang');
    $komentar = $this->input->post('komentar');
    $id_produk = $this->input->post('id_produk');
    $order_id = $this->input->post('order_id');

    $data = array();

    for ($i=0; $i < count($id_produk); $i++) {

        $data[] = array(
          'order_id' => $order_id,
          'id_produk'  => $id_produk[$i],
          'id_user' => $this->input->post('id_user'),
          'bintang' => $bintang[$i],
          'komentar' => $komentar[$i],
          'date_posted' => date('Y-m-d')
        );

    }

    $insert = $this->db->insert_batch('ulasan', $data);
    redirect('pesanan_saya');
  }
}
