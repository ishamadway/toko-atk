<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Update_status extends CI_Controller {

    function update_status_expired_order()
    {
      $expired_order = $this->db->query("SELECT * FROM transaksi tr WHERE tr.status='Belum Bayar'")->result_array();

      //mengubah status pesanan yang sudah expired
      if($expired_order){
      
      $i=0;
      foreach($expired_order as $eo) {
          $expire_date = date('Y-m-d H:i:s', strtotime($eo['transaction_time'] . ' +1 day'));
          $expired_time = strtotime($expire_date);
          date_default_timezone_set('Asia/Jakarta');
          $time_now = strtotime(date('Y-m-d H:i:s'));
          $date_diff =  $time_now - $expired_time ;
          $diff = floor($date_diff/(1000*60*60*24));

          $expiredData[$i] = array(
          'order_id'  => $eo['order_id'],
          'status_code' => '202',
          'status'  => 'Dibatalkan'
          );

          $notif[$i] = array(
            'order_id' => $eo['order_id'],
            'read' => 0,
            'created' => date('Y-m-d H:i:s')
          );

          $i++;

              if($diff >= 0){
                  $result = $this->db->update_batch('transaksi', $expiredData,'order_id');
                  $this->db->update_batch('notifikasi', $notif, 'order_id');
              }
          }
      }
  }

  function update_status_expired_shipment()
  {
      $expired_before_send = $this->db->query("SELECT * FROM transaksi tr WHERE tr.status='Dikemas'")->result_array();

      //mengubah status pesanan yang sudah melebihi batas pengiriman
      if($expired_before_send){

      $i=0;
      foreach($expired_before_send as $row) {
              $expire_date_before_send = date('Y-m-d', strtotime($row['settlement_time'] . ' +3 day'));
              $expired_time_before_send = strtotime($expire_date_before_send);
              date_default_timezone_set('Asia/Jakarta');
              $time_now = strtotime(date('Y-m-d'));
              $date_diff = $time_now - $expired_time_before_send;
              $diff = floor($date_diff/(60*60*24));

              $expired_data_before_send[$i] = array(
                  'order_id'  => $row['order_id'],
                  'status'  => 'Dibatalkan',
                  'status_code' => '202'
              );

              $notif[$i] = array(
                'order_id' => $row['order_id'],
                'read' => 0,
                'created' => date('Y-m-d H:i:s')
              );

              $i++;

              if($diff >= 0){
                  $result = $this->db->update_batch('transaksi', $expired_data_before_send,'order_id');
                  $this->db->update_batch('notifikasi', $notif, 'order_id');
              }
          }
      }
  }

  function update_status_arrived_order()
  {
      $data = $this->db->query("SELECT * FROM transaksi tr, pengiriman pn
        WHERE tr.order_id=pn.order_id AND tr.status='Dikirim'")->result_array();
      
      if($data){
          
        $i = 0;
        foreach($data as $row){
            date_default_timezone_set('Asia/Jakarta');
            $expired_date = date('Y-m-d', strtotime($row['tgl_dikirim'] . ' +7 day'));
            $expired_time = strtotime($expired_date);
            $time_now = strtotime(date('Y-m-d'));
            $time_diff = $time_now - $expired_time;
            $diff = floor($time_diff/(1000*60*60*24));

            $transaksi[$i] = array(
                'order_id'  => $row['order_id'],
                'status'  => 'Selesai'
            );

            $pengiriman[$i] = array(
                'order_id' => $row['order_id'],
                'tgl_diterima' => date('Y-m-d H:i:s'),
                'status' => 1
            );

            $notif[$i] = array(
                'order_id' => $row['order_id'],
                'read' => 0,
                'created' => date('Y-m-d H:i:s')
            );

            $i++;

            if($diff >= 0){
                $this->db->update_batch('transaksi', $transaksi,'order_id');
                $this->db->update_batch('pengiriman', $pengiriman,'order_id');
                $this->db->update_batch('notifikasi', $notif, 'order_id');
            }
        }
     }
  }

}