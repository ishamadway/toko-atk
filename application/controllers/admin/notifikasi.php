<?php

class Notifikasi extends CI_Controller{

  function read_all_notif(){
    $data = array(
        'read' => $this->input->post('read')
    );

    $where = array(
        'role' => 1
    );

    $this->db->update('notifikasi', $data, $where);
    echo $this->show_notif();
  }

  function delete_all_notif(){
    $where = array(
        'role' => 1
    );

    $this->db->delete('notifikasi', $where);
    echo $this->show_notif();
  }

  function show_notif(){ //Fungsi untuk menampilkan Cart
      $output = '';
      $notif = $this->db->query("SELECT * FROM notifikasi nt, transaksi tr  
        WHERE nt.order_id=tr.order_id AND nt.role=1 ORDER BY nt.created DESC")->result_array();
      $total_notif = count($notif);

      if($total_notif > 0) {
      foreach ($notif as $row)
        {
          if($row['status'] == 'Dikemas'){
            $header = 'Pesanan Baru';
            $desc = 'Segera kirim Pesanan <b>No. '.$row['order_id'].'</b> sebelum waktu yang ditentukan';
          } else if($row['status'] == 'Dibatalkan'){
            $header = 'Pesanan Dibatalkan';
            $desc = 'Pesanan <b>No. '.$row['order_id'].'</b> telah dibatalkan oleh sistem.';
          } else if($row['status'] == 'Dikirim'){
            $header = 'Pesanan telah dikirim';
            $desc = 'Pesanan <b>No. '.$row['order_id'].'</b> telah dikirim.';
          } else if($row['status'] == 'Selesai'){
            $header = 'Pesanan Selesai';
            $desc = 'Pesanan <b>No. '.$row['order_id'].'</b> telah selesai.';
          }
          
          if($row['read'] == 0){
            $btn = 'btn-light';
          } else if($row['read'] == 1){
            $btn = 'btn-white';
          }

          $output .='
          <div style="border-bottom: 1px solid lightgrey">
            <a class="btn '.$btn.' text-left" style="width: 100%" href="'.base_url('admin/pesanan/detail/').$row['order_id'].'" id="read_notif" data-id="'.$row['order_id'].'" data-read="1">
                <h6 class="dropdown-header text-decoration-none"><b>'.$header.'</b> <small>/'.$row['created'].'</small></h6>
                <h6 class="dropdown-header" style="font-weight: 300; font-size: 14px">'.$desc.'</h6>
            </a>
         </div>
         ';
        }
      } else {
        $output .='
        <div class="text-center py-4 px-4">
            <h6 class="dropdown-header">Tidak Ada Notifikasi</h6>
        </div>
        ';
      }

      return $output;
  }

  function count_notif(){ //Fungsi untuk menampilkan Cart
      $output = '';
      $notif = $this->db->query("SELECT count(nt.id_notif) as total_notif FROM notifikasi nt, transaksi tr  
                                 WHERE nt.order_id=tr.order_id AND nt.role=1 AND nt.read=0")->result_array();
      $total_notif = count($notif);

        foreach($notif as $row) {

        if($row['total_notif'] > 0){
            $button = '<i class="fas fa-bell"></i> <span class="badge badge-light">'.$row['total_notif'].'</span>';
        } else {
            $button = '<i class="far fa-bell"></i>';
        }

        $output .= ''.$button.'';
        }
      return $output;
  }

  function load_notif(){
        echo $this->show_notif();
  }

  function notif_button(){
        echo $this->count_notif();
  }

}
