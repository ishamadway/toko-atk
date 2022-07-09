<?php

class Notifikasi extends CI_Controller{

  function read_all_notif(){
    $data = array(
        'read' => $this->input->post('read')
    );

    $where = array(
        'id_user' => $this->session->userdata('id'),
        'role' => 2
    );

    $this->db->update('notifikasi', $data, $where);
    echo $this->show_notif();
  }

  function delete_all_notif(){
    $where = array(
        'id_user' => $this->session->userdata('id'),
        'role' => 2
    );

    $this->db->delete('notifikasi', $where);
    echo $this->show_notif();
  }

  function show_notif(){ //Fungsi untuk menampilkan Cart
      $output = '';
      $id = $this->session->userdata('id');
      $notif = $this->db->query("SELECT * FROM notifikasi nt, transaksi tr  
                                 WHERE nt.order_id=tr.order_id AND nt.id_user='$id' AND nt.role=2 ORDER BY nt.created DESC")->result_array();
      $total_notif = count($notif);

      if($total_notif > 0) {
      foreach ($notif as $row)
        {
          if($row['status'] == 'Belum Bayar'){
            $header = 'Bayar Pesanan Anda';
            $desc = 'Bayar Pesanan <b>No. '.$row['order_id'].'</b> sebelum waktu yang ditentukan';
          } else if($row['status'] == 'Dibatalkan'){
            $header = 'Pesanan Dibatalkan';
            $desc = 'Pesanan <b>No. '.$row['order_id'].'</b> telah dibatalkan oleh sistem.';
          } else if($row['status'] == 'Dikemas'){
            $header = 'Pembayaran Dikonfirmasi';
            $desc = 'Pembayaran Pesanan <b>No. '.$row['order_id'].'</b> telah dikonfirmasi oleh sistem.';
          } else if($row['status'] == 'Dikirim'){
            $header = 'Pesanan telah Dikirimkan';
            $desc = 'Pesanan <b>No. '.$row['order_id'].'</b> telah dikirim oleh penjual.';
          } else if($row['status'] == 'Selesai'){
            $header = 'Pesanan telah Selesai';
            $desc = 'Pesanan <b>No. '.$row['order_id'].'</b> telah selesai, silahkan nilai produk.';
          }
          
          if($row['read'] == 0){
            $color = '';
            $icon = '<i class="fa fa-circle text-primary"></i>';
          } else if($row['read'] == 1){
            $color = 'color: grey';
            $icon = '';
          }

          $output .='
          <a href="'.base_url('pesanan_saya/detail/').$row['order_id'].'" style="'.$color.'">
            <div class="product-widget">
                <p style="font-weight: bold">'.$header.' '.$icon.'</p>
                <small>'.$row['created'].'</small>
                <p>'.$desc.'</p>
            </div>
          </a>
          <hr>
         ';
        }
      } else {
        $output .='
        <div class="product-widget" style="padding-top: 20px; padding-bottom: 10px">
            <h4>Tidak ada Notifikasi!</h4>
        </div>
        ';
      }

      return $output;
  }

  function count_notif(){ //Fungsi untuk menampilkan Cart
      $output = '';
      $id = $this->session->userdata('id');
      $notif = $this->db->query("SELECT count(nt.id_notif) as total_notif FROM notifikasi nt, transaksi tr  
                                 WHERE nt.order_id=tr.order_id AND nt.id_user='$id' AND nt.role=2 AND nt.read=0")->result_array();
      $total_notif = count($notif);

        foreach($notif as $row) {

        if($row['total_notif'] > 0){
            $view = '
            <i class="fa fa-bell"></i>
            <span>Notifikasi</span>
            <div class="qty">
                '.$row['total_notif'].'
            </div>
            ';
        } else {
            $view = '
            <i class="fa fa-bell-o"></i>
            <span>Notifikasi</span>
            ';
        }

        $output .= ''.$view.'';
        }
      return $output;
  }

  function load_notif(){
        echo $this->show_notif();
  }

  function notif_button(){
        echo $this->count_notif();
  }

  function delete_notif(){ //fungsi untuk menghapus item cart
      $data = array(
          'rowid' => $this->input->post('row_id'),
          'qty' => 0,
      );
      $this->cart->update($data);
      echo $this->show_notif();
  }

}
