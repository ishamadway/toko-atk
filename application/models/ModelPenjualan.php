<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPenjualan extends CI_Model
{
    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function delete_data($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //kirim_barang
    function make_query_kirim_barang($search)
    {
      $query = "
      SELECT * FROM transaksi tr, user us, ekspedisi ep
      WHERE tr.id_pembeli=us.id
      AND tr.id_ekspedisi=ep.id_ekspedisi
      AND tr.status='Dikemas'
      ";

      if(isset($search))
      {
        $query .= "
         AND tr.order_id LIKE '%".$search."%'
         ORDER BY tr.settlement_time ASC
        ";
      }

      return $query;
    }

     function count_all_kirim_barang($search)
     {
      $query = $this->make_query_kirim_barang($search);
      $data = $this->db->query($query);
      return $data->num_rows();
     }

     function fetch_data_kirim_barang($limit, $start, $search)
     {
      $query = $this->make_query_kirim_barang($search);

      $query .= ' LIMIT '.$start.', ' . $limit;

      $data = $this->db->query($query);

      $output = '';
      if($data->num_rows() > 0)
      {
       $start = $start + 1;
       foreach($data->result_array() as $row)
       {
        $batas_pengiriman = date('Y-m-d', strtotime($row['settlement_time'] . ' +3 day'));

        $output .='
        <tr>
          <th><a href="'.base_url('admin/pesanan/detail/').$row['order_id'].'">'.$row['order_id'].'</a></th>
          <td>'.$row['nama'].'</td>
          <td>'.$row['nama_ekspedisi'].'-'.$row['jenis_ekspedisi'].'</td>
          <td>'.$row['alamat'].'</td>
          <td>'.$row['settlement_time'].'</td>
          <td>'.$batas_pengiriman.'</td>
          <td>
          <a class="btn btn-sm btn-primary" href="#" title="Atur Pengiriman"
             data-toggle="modal" data-target="#AturPengiriman'.$row['order_id'].'" role="button"><i class="fas fa-paper-plane"></i> Atur Pengiriman</a>
          </td>
          <td>
            <a class="btn btn-sm btn-danger" href="'.base_url('admin/kirim_produk/cetak_label/').$row['order_id'].'" target="_blank" title="Cetak Label Pengiriman"><i class="fas fa-file-pdf"></i> Cetak</a>
          </td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
         <td class="text-center" colspan="7">
            Pesanan tidak ditemukan
         </td>
       </tr>
       ';
      }
      return $output;
     }
     //end of kirim_barang

     //transaksi
     function make_query_transaksi($search)
     {
       $query = "
       SELECT * FROM transaksi tr, user us
       WHERE tr.id_pembeli=us.id
       ";

       if(isset($search))
       {
         $query .= "
          AND tr.order_id LIKE '%".$search."%'
          ORDER BY tr.transaction_time DESC
         ";
       }

       return $query;
     }

      function count_all_transaksi($search)
      {
       $query = $this->make_query_transaksi($search);
       $data = $this->db->query($query);
       return $data->num_rows();
      }

      function fetch_data_transaksi($limit, $start, $search)
      {
       $query = $this->make_query_transaksi($search);

       $query .= ' LIMIT '.$start.', ' . $limit;

       $data = $this->db->query($query);

       $output = '';
       if($data->num_rows() > 0)
       {
        $start = $start + 1;
        foreach($data->result_array() as $row)
        {
          //label badge
          if ($row['status_code'] == '201') {
            $badge = '<span class="badge badge-warning" style="width: 100px">PENDING</span>';
          } else if($row['status_code'] == '202') {
            $badge = '<span class="badge badge-danger" style="width: 100px">FAILURE</span><br>';
          } else {
            $badge = '<span class="badge badge-primary" style="width: 100px">SETTLEMENT</span><br>';
          }
          //END Label Badge

         $batas_pembayaran = date('Y-m-d H:i:s', strtotime($row['transaction_time'] . ' +1 day'));

         $output .='
         <tr>
           <th><a href="'.base_url('admin/pesanan/detail/').$row['order_id'].'">'.$row['order_id'].'</a></th>
           <td>Rp. '.number_format($row['grand_total'],0,",",".").'</td>
           <td>'.$row['payment_type'].'</td>
           <td>'.$row['bank'].'</td>
           <td>'.$row['transaction_time'].'</td>
           <td>'.$batas_pembayaran.'</td>
           <td>'.$row['settlement_time'].'</td>
           <td>'.$badge.'</td>
         </tr>
         ';
        }
       }
       else
       {
        $output = '
        <tr>
          <td class="text-center" colspan="8">
             Transaksi tidak ditemukan
          </td>
        </tr>
        ';
       }
       return $output;
      }
      //end of transaksi

      //pesanan
      function make_query_pesanan($search)
      {
        $query = "
        SELECT * FROM transaksi tr, user us, ekspedisi ep
        WHERE tr.id_pembeli=us.id
        AND tr.id_ekspedisi=ep.id_ekspedisi
        ";

        if(isset($search))
        {
          $query .= "
           AND tr.order_id LIKE '%".$search."%'
           ORDER BY tr.transaction_time DESC
          ";
        }

        return $query;
      }

       function count_all_pesanan($search)
       {
        $query = $this->make_query_pesanan($search);
        $data = $this->db->query($query);
        return $data->num_rows();
       }

       function fetch_data_pesanan($limit, $start, $search)
       {
        $query = $this->make_query_pesanan($search);

        $query .= ' LIMIT '.$start.', ' . $limit;

        $data = $this->db->query($query);

        $output = '';
        if($data->num_rows() > 0)
        {
         $start = $start + 1;
         foreach($data->result_array() as $row)
         {
           //label badge
           if ($row['status'] == 'Belum Bayar') {
             $badge = '<span class="badge badge-secondary" style="width: 100px">Belum bayar</span>';
           } else if($row['status'] == 'Dikemas') {
             $badge = '<span class="badge badge-warning" style="width: 100px">Dikemas</span><br>';
           } else if($row['status'] == 'Dikirim') {
             $badge = '<span class="badge badge-primary" style="width: 100px">Dikirim</span><br>';
           } else if($row['status'] == 'Selesai') {
             $badge = '<span class="badge badge-info" style="width: 100px">Selesai</span><br>';
           } else {
             $badge = '<span class="badge badge-danger" style="width: 100px">Dibatalkan</span><br>';
           }
           //END Label Badge

          $output .='
          <tr>
            <th><a href="'.base_url('admin/pesanan/detail/').$row['order_id'].'">'.$row['order_id'].'</a></th>
            <td>'.$row['transaction_time'].'</td>
            <td>Rp. '.number_format($row['grand_total'],0,",",".").'</td>
            <td>'.$row['nama_ekspedisi'].'-'.$row['jenis_ekspedisi'].'</td>
            <td>'.$badge.'</td>
          </tr>
          ';
         }
        }
        else
        {
         $output = '
         <tr>
           <td class="text-center" colspan="8">
              Pesanan tidak ditemukan
           </td>
         </tr>
         ';
        }
        return $output;
       }
       //end of pesanan

      //penjualan_produk
      function make_query_penjualan_produk($search)
      {
        $query = "
        SELECT pd.*, tr.terjual FROM produk pd LEFT JOIN (select item_pesanan.id_produk, count(item_pesanan.quantity) as terjual
        from item_pesanan join transaksi on transaksi.order_id=item_pesanan.order_id 
        where transaksi.status = 'Selesai' group by item_pesanan.id_produk) tr 
        ON tr.id_produk=pd.id
        ";

        if(isset($search))
        {
          $query .= "
           WHERE pd.nama LIKE '%".$search."%'
           OR pd.id LIKE '%".$search."%'
           OR pd.merek LIKE '%".$search."%'
           OR pd.sku LIKE '%".$search."%'
           ORDER BY tr.terjual DESC
          ";
        }

        return $query;
      }

       function count_all_penjualan_produk($search)
       {
        $query = $this->make_query_penjualan_produk($search);
        $data = $this->db->query($query);
        return $data->num_rows();
       }

       function fetch_data_penjualan_produk($limit, $start, $search)
       {
        $query = $this->make_query_penjualan_produk($search);

        $query .= ' LIMIT '.$start.', ' . $limit;

        $data = $this->db->query($query);

        $output = '';
        if($data->num_rows() > 0)
        {
         $start = $start + 1;
         foreach($data->result_array() as $row)
         {
          
          if($row['terjual'] == null){
            $terjual = '0';
          } else {
            $terjual = $row['terjual'];
          }

          $output .='
          <tr>
            <th>'.$start++.'</th>
            <td>'.$row['id'].'</td>
            <td>'.$row['nama'].'</td>
            <td>'.$row['merek'].'</td>
            <td>'.$row['sku'].'</td>
            <td>'.$terjual.'</td>
          </tr>
          ';
         }
        }
        else
        {
         $output = '
         <tr>
           <td class="text-center" colspan="8">
              Produk tidak ditemukan
           </td>
         </tr>
         ';
        }
        return $output;
       }
       //end of pesanan
}

?>
