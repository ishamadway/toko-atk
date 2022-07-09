<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelAdmin extends CI_Model
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

    //pembeli
    function make_query_pembeli($search)
    {
      $query = "
      SELECT * FROM user
      WHERE role_id=3
      ";

      if(isset($search))
      {
        $query .= "
        AND nama LIKE '%".$search."%'
        OR id LIKE '%".$search."%'
        AND role_id=3
        ORDER BY nama ASC
        ";
      }

      return $query;
    }

     function count_all_pembeli($search)
     {
      $query = $this->make_query_pembeli($search);
      $data = $this->db->query($query);
      return $data->num_rows();
     }

     function fetch_data_pembeli($limit, $start, $search)
     {
      $query = $this->make_query_pembeli($search);

      $query .= ' LIMIT '.$start.', ' . $limit;

      $data = $this->db->query($query);

      $output = '';
      if($data->num_rows() > 0)
      {
       $start = $start + 1;
       foreach($data->result_array() as $row)
       {
        $output .='
          <tr>
            <th scope="row">'.$start++.'</th>
            <td>'.$row['id'].'</td>
            <td>'.$row['nama'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['alamat'].'<br>Kota '.$row['kota'].', '.$row['kode_pos'].'</td>
            <td>'.$row['no_telp'].'</td>
            <td>
              <a class="btn btn-sm btn-white" href="#" title="Ubah"
                 data-toggle="modal" data-target="#UbahData'.$row['id'].'" role="button"><i class="fas fa-edit"></i></a>
              <a class="btn btn-sm btn-white" href="#" title="Hapus"
                 data-toggle="modal" data-target="#HapusData'.$row['id'].'" role="button"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
         <td class="text-center" colspan="6">
          Data tidak ditemukan
         </td>
       </tr>
       ';
      }
      return $output;
     }
     //end of pembeli

    //all product
    function make_query_all($search)
    {
      $query = "
      SELECT * FROM produk pd, kategori kt
      WHERE pd.kategori_id=kt.id_kategori
      ";

      if(isset($search))
      {
        $query .= "
         AND pd.nama LIKE '%".$search."%'
         ORDER BY pd.date_updated DESC
        ";
      }

      return $query;
    }

     function count_all_all($search)
     {
      $query = $this->make_query_all($search);
      $data = $this->db->query($query);
      return $data->num_rows();
     }

     function fetch_data_all($limit, $start, $search)
     {
      $query = $this->make_query_all($search);

      $query .= ' LIMIT '.$start.', ' . $limit;

      $data = $this->db->query($query);

      $output = '';
      if($data->num_rows() > 0)
      {
       $start = $start + 1;
       foreach($data->result_array() as $row)
       {
         //label badge
         if ($row['stok'] == '0' && $row['arsip'] == '1') {
           $badge = '<span class="badge badge-danger">Stok Habis</span>
           <span class="badge badge-secondary">Diarsipkan</span><br>';
         } else if($row['arsip'] == '1') {
           $badge = '<span class="badge badge-secondary">Diarsipkan</span><br>';
         } else if($row['stok'] == '0'){
           $badge = '<span class="badge badge-danger">Stok Habis</span><br>';
         } else {
           $badge = '';
         }
         //END Label Badge

         //Action
         if ($row['arsip'] == '0') {
           $action = '<a class="btn btn-sm btn-white" href="'.base_url('admin/produk/arsipkan_produk/'). $row['id'].'" title="Arsipkan"
           role="button"><i class="fas fa-eye-slash"></i></a>';
         } else {
           $action = '<a class="btn btn-sm btn-white" href="'.base_url('admin/produk/tampilkan_produk/'). $row['id'].'" title="Tampilkan"
             role="button"><i class="fas fa-eye"></i></a>';
         }
         //END of Action

        $output .='
        <tr>
        <th>'.$start++.'</th>
          <td>
            <a class="text-decoration-none text-dark" href="'.base_url('admin/produk/ubah_produk/'). $row['id'].'">
              <div class="row">
                <div class="col-lg-3">
                  <img src="'.base_url('assets/uploads/produk/'). $row['gambar'].'"
                    alt="..." class="img-thumbnail" style="width: 100px">
                </div>
                <div class="col-lg-9">
                  '.$badge.'
                  <b>'.$row['nama'].'</b>
                  <br>
                  <small>SKU : '.$row['sku'].'</small>
                  <br>
                </div>
              </div>
            </a>
          </td>
          <td>
            <span class="badge badge-pill badge-primary">'.$row['kategori'].'</span>
          </td>
          <td>'.$row['stok'].'</td>
          <td>Rp. '.number_format($row['harga'],2,",",".").'</td>
          <td>
          '.$action.'
            <a class="btn btn-sm btn-white" href="#" title="Hapus"
               data-toggle="modal" data-target="#HapusData'.$row['id'].'" role="button"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
         <td class="text-center" colspan="6">
          Produk tidak ditemukan
         </td>
       </tr>
       ';
      }
      return $output;
     }
     //end of all product

    //produk habis
    function make_query_habis($search)
    {
      $query = "
      SELECT * FROM produk pd, kategori kt
      WHERE pd.kategori_id=kt.id_kategori
      AND pd.stok=0
      ";

      if(isset($search))
      {
        $query .= "
         AND pd.nama LIKE '%".$search."%'
         ORDER BY pd.date_updated DESC
        ";
      }

      return $query;
    }

     function count_all_habis($search)
     {
      $query = $this->make_query_habis($search);
      $data = $this->db->query($query);
      return $data->num_rows();
     }

     function fetch_data_habis($limit, $start, $search)
     {
      $query = $this->make_query_habis($search);

      $query .= ' LIMIT '.$start.', ' . $limit;

      $data = $this->db->query($query);

      $output = '';
      if($data->num_rows() > 0)
      {
       $start = $start + 1;
       foreach($data->result_array() as $row)
       {
         //label badge
         if ($row['stok'] == '0' && $row['arsip'] == '1') {
           $badge = '<span class="badge badge-danger">Stok Habis</span>
           <span class="badge badge-secondary">Diarsipkan</span><br>';
         } else if($row['arsip'] == '1') {
           $badge = '<span class="badge badge-secondary">Diarsipkan</span><br>';
         } else if($row['stok'] == '0'){
           $badge = '<span class="badge badge-danger">Stok Habis</span><br>';
         } else {
           $badge = '';
         }
         //END Label Badge

         //Action
         if ($row['arsip'] == '0') {
           $action = '<a class="btn btn-sm btn-white" href="'.base_url('admin/produk/arsipkan_produk/'). $row['id'].'" title="Arsipkan"
           role="button"><i class="fas fa-eye-slash"></i></a>';
         } else {
           $action = '<a class="btn btn-sm btn-white" href="'.base_url('admin/produk/tampilkan_produk/'). $row['id'].'" title="Tampilkan"
             role="button"><i class="fas fa-eye"></i></a>';
         }
         //END of Action

        $output .='
        <tr>
        <th>'.$start++.'</th>
          <td>
            <a class="text-decoration-none text-dark" href="'.base_url('admin/produk/ubah_produk/'). $row['id'].'">
              <div class="row">
                <div class="col-lg-3">
                  <img src="'.base_url('assets/uploads/produk/'). $row['gambar'].'"
                    alt="..." class="img-thumbnail" style="width: 100px">
                </div>
                <div class="col-lg-9">
                  '.$badge.'
                  <b>'.$row['nama'].'</b>
                  <br>
                  <small>SKU : '.$row['sku'].'</small>
                  <br>
                </div>
              </div>
            </a>
          </td>
          <td>
            <span class="badge badge-pill badge-primary">'.$row['kategori'].'</span>
          </td>
          <td>'.$row['stok'].'</td>
          <td>Rp. '.number_format($row['harga'],2,",",".").'</td>
          <td>
          '.$action.'
            <a class="btn btn-sm btn-white" href="#" title="Hapus"
               data-toggle="modal" data-target="#HapusData'.$row['id'].'" role="button"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
         <td class="text-center" colspan="6">
          Produk tidak ditemukan
         </td>
       </tr>
       ';
      }
      return $output;
     }
     //end of produk habis

    //produk arsip
    function make_query_arsip($search)
    {
      $query = "
      SELECT * FROM produk pd, kategori kt
      WHERE pd.kategori_id=kt.id_kategori
      AND pd.arsip=1
      ";

      if(isset($search))
      {
        $query .= "
         AND pd.nama LIKE '%".$search."%'
         ORDER BY pd.date_updated DESC
        ";
      }

      return $query;
    }

     function count_all_arsip($search)
     {
      $query = $this->make_query_arsip($search);
      $data = $this->db->query($query);
      return $data->num_rows();
     }

     function fetch_data_arsip($limit, $start, $search)
     {
      $query = $this->make_query_arsip($search);

      $query .= ' LIMIT '.$start.', ' . $limit;

      $data = $this->db->query($query);

      $output = '';
      if($data->num_rows() > 0)
      {
       $start = $start + 1;
       foreach($data->result_array() as $row)
       {
         //label badge
         if ($row['stok'] == '0' && $row['arsip'] == '1') {
           $badge = '<span class="badge badge-danger">Stok Habis</span>
           <span class="badge badge-secondary">Diarsipkan</span><br>';
         } else if($row['arsip'] == '1') {
           $badge = '<span class="badge badge-secondary">Diarsipkan</span><br>';
         } else if($row['stok'] == '0'){
           $badge = '<span class="badge badge-danger">Stok Habis</span><br>';
         } else {
           $badge = '';
         }
         //END Label Badge

         //Action
         if ($row['arsip'] == '0') {
           $action = '<a class="btn btn-sm btn-white" href="'.base_url('admin/produk/arsipkan_produk/'). $row['id'].'" title="Arsipkan"
           role="button"><i class="fas fa-eye-slash"></i></a>';
         } else {
           $action = '<a class="btn btn-sm btn-white" href="'.base_url('admin/produk/tampilkan_produk/'). $row['id'].'" title="Tampilkan"
             role="button"><i class="fas fa-eye"></i></a>';
         }
         //END of Action

        $output .='
        <tr>
        <th>'.$start++.'</th>
          <td>
            <a class="text-decoration-none text-dark" href="'.base_url('admin/produk/ubah_produk/'). $row['id'].'">
              <div class="row">
                <div class="col-lg-3">
                  <img src="'.base_url('assets/uploads/produk/'). $row['gambar'].'"
                    alt="..." class="img-thumbnail" style="width: 100px">
                </div>
                <div class="col-lg-9">
                  '.$badge.'
                  <b>'.$row['nama'].'</b>
                  <br>
                  <small>SKU : '.$row['sku'].'</small>
                  <br>
                </div>
              </div>
            </a>
          </td>
          <td>
            <span class="badge badge-pill badge-primary">'.$row['kategori'].'</span>
          </td>
          <td>'.$row['stok'].'</td>
          <td>Rp. '.number_format($row['harga'],2,",",".").'</td>
          <td>
          '.$action.'
            <a class="btn btn-sm btn-white" href="#" title="Hapus"
               data-toggle="modal" data-target="#HapusData'.$row['id'].'" role="button"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
         <td class="text-center" colspan="6">
          Produk tidak ditemukan
         </td>
       </tr>
       ';
      }
      return $output;
     }
     //end of produk arsip

     public function insertNotif1($data = array()) {

      // Insert order items
      $insert = $this->db->insert_batch('notifikasi', $data);
    
      // Return the status
      return $insert?true:false;
    }

    public function insertNotif2($data = array()) {

      // Insert order items
      $insert = $this->db->insert_batch('notifikasi', $data);
    
      // Return the status
      return $insert?true:false;
    }
}

?>
