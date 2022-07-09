<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelProduk extends CI_Model
{
    public function get_produk()
    {
        return $this->db->get('produk');
    }

    public function insert_produk()
    {
        $this->db->insert('produk');
    }

    public function get_where_produk($url)
    {
        $result = $this->db->where('url_produk', $url)
                           ->get('produk');
        return $result->row();

    }

    function get_brand_filter($url)
    {
        $this->db->distinct();
        $this->db->select('pd.merek');
        $this->db->from('produk pd');
        $this->db->join('kategori kt', 'pd.kategori_id=kt.id_kategori');
        $this->db->where('kt.url', $url);
        return $this->db->get();
    }

    //alat-tulis
    function make_query_alat_tulis($minimum_price, $maximum_price, $brand, $search, $url)
    {
      $query = "
      SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
			LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
			join produk on ulasan.id_produk=produk.id where produk.kategori_id='1' group by ulasan.id_produk) ul
			on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id
      WHERE kt.url='".$url."'
      ";

      if(isset($minimum_price, $maximum_price) && !empty($minimum_price) &&  !empty($maximum_price))
      {
       $query .= "
        AND pd.harga BETWEEN '".$minimum_price."' AND '".$maximum_price."'
       ";
      }

      if(isset($brand))
      {
       $brand_filter = implode("','", $brand);
       $query .= "
        AND pd.merek IN('".$brand_filter."')
       ";
      }

      if(isset($search))
      {
        $query .= "
         AND pd.nama LIKE '%".$search."%'
         ORDER BY ul.total_ulasan DESC
        ";
      }
      return $query;
    }

     function count_alat_tulis($minimum_price, $maximum_price, $brand, $search, $url)
     {
      $query = $this->make_query_alat_tulis($minimum_price, $maximum_price, $brand, $search, $url);
      $data = $this->db->query($query);
      return $data->num_rows();
     }

     function fetch_alat_tulis($limit, $start, $minimum_price, $maximum_price, $brand, $search, $url)
     {
      $query = $this->make_query_alat_tulis($minimum_price, $maximum_price, $brand, $search, $url);

      $query .= ' LIMIT '.$start.', ' . $limit;

      $data = $this->db->query($query);

      $output = '';
      if($data->num_rows() > 0)
      {
       foreach($data->result_array() as $row)
       {

         //label badge
         if($row['avg_rating'] == '' || $row['avg_rating'] == NULL) {
           $rating = '
           <div class="product-rating">
             <i class="fa fa-star-o empty"></i>
             <i class="fa fa-star-o empty"></i>
             <i class="fa fa-star-o empty"></i>
             <i class="fa fa-star-o empty"></i>
             <i class="fa fa-star-o empty"></i>
           </div>
           ';
         } else if($row['avg_rating'] == 1 || $row['avg_rating'] < 2) {
           $rating = '
           <div class="product-rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o empty"></i>
             <i class="fa fa-star-o empty"></i>
             <i class="fa fa-star-o empty"></i>
             <i class="fa fa-star-o empty"></i>
           </div>
           ';
         } else if($row['avg_rating'] == 2 || $row['avg_rating'] < 3) {
           $rating = '
           <div class="product-rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o empty"></i>
             <i class="fa fa-star-o empty"></i>
             <i class="fa fa-star-o empty"></i>
           </div>
           ';
         } else if($row['avg_rating'] == 3 || $row['avg_rating'] < 4) {
           $rating = '
           <div class="product-rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o empty"></i>
             <i class="fa fa-star-o empty"></i>
           </div>
           ';
         } else if($row['avg_rating'] == 4 || $row['avg_rating'] < 5) {
           $rating = '
           <div class="product-rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o empty"></i>
           </div>
           ';
         } else {
           $rating = '
           <div class="product-rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
           </div>
           ';
         }
         //END Label Badge

        $output .= '
        <div class="col-md-4 col-xs-6">
          <div class="product" style="height: 450px">
            <div class="product-img">
              <img src="'.base_url('assets/uploads/produk/'). $row['gambar'].'" alt="">
            </div>
            <div class="product-body">
              <p class="product-category">'. $row['kategori']. '</p>
              <h3 class="product-name"><a href="' .base_url('produk/index/'). $row['url_produk']. '">' .$row['nama']. '</a></h3>
              <h4 class="product-price">Rp. '.number_format($row['harga'],2,",",".").'</h4>
              <div class="product-btns">
                '.$rating.'
              </div>
            </div>
          </div>
        </div>
        ';
       }
      }
      else
      {
       $output = '
          <div class="text-center" style="padding-top: 120px">
            <img src="'.base_url('assets/user/img').'/No_Product_Found.png" style="width: 40%">
          </div>
        ';
      }
      return $output;
     }
     //END alat-tulis

     //tinta
     function make_query_tinta($minimum_price, $maximum_price, $brand, $search, $url)
     {
       $query = "
       SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
 			 LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
 			 join produk on ulasan.id_produk=produk.id where produk.kategori_id='2' group by ulasan.id_produk) ul
 			 on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id
       WHERE kt.url='".$url."'
       ";

       if(isset($minimum_price, $maximum_price) && !empty($minimum_price) &&  !empty($maximum_price))
       {
        $query .= "
         AND pd.harga BETWEEN '".$minimum_price."' AND '".$maximum_price."'
        ";
       }

       if(isset($brand))
       {
        $brand_filter = implode("','", $brand);
        $query .= "
         AND pd.merek IN('".$brand_filter."')
        ";
       }

       if(isset($search))
       {
         $query .= "
          AND pd.nama LIKE '%".$search."%'
          ORDER BY ul.total_ulasan DESC
         ";
       }
       return $query;
     }

      function count_tinta($minimum_price, $maximum_price, $brand, $search, $url)
      {
       $query = $this->make_query_tinta($minimum_price, $maximum_price, $brand, $search, $url);
       $data = $this->db->query($query);
       return $data->num_rows();
      }

      function fetch_tinta($limit, $start, $minimum_price, $maximum_price, $brand, $search, $url)
      {
       $query = $this->make_query_tinta($minimum_price, $maximum_price, $brand, $search, $url);

       $query .= ' LIMIT '.$start.', ' . $limit;

       $data = $this->db->query($query);

       $output = '';
       if($data->num_rows() > 0)
       {
        foreach($data->result_array() as $row)
        {

          //label badge
          if($row['avg_rating'] == '' || $row['avg_rating'] == NULL) {
            $rating = '
            <div class="product-rating">
              <i class="fa fa-star-o empty"></i>
              <i class="fa fa-star-o empty"></i>
              <i class="fa fa-star-o empty"></i>
              <i class="fa fa-star-o empty"></i>
              <i class="fa fa-star-o empty"></i>
            </div>
            ';
          } else if($row['avg_rating'] == 1 || $row['avg_rating'] < 2) {
            $rating = '
            <div class="product-rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o empty"></i>
              <i class="fa fa-star-o empty"></i>
              <i class="fa fa-star-o empty"></i>
              <i class="fa fa-star-o empty"></i>
            </div>
            ';
          } else if($row['avg_rating'] == 2 || $row['avg_rating'] < 3) {
            $rating = '
            <div class="product-rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o empty"></i>
              <i class="fa fa-star-o empty"></i>
              <i class="fa fa-star-o empty"></i>
            </div>
            ';
          } else if($row['avg_rating'] == 3 || $row['avg_rating'] < 4) {
            $rating = '
            <div class="product-rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o empty"></i>
              <i class="fa fa-star-o empty"></i>
            </div>
            ';
          } else if($row['avg_rating'] == 4 || $row['avg_rating'] < 5) {
            $rating = '
            <div class="product-rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o empty"></i>
            </div>
            ';
          } else {
            $rating = '
            <div class="product-rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            ';
          }
          //END Label Badge

         $output .= '
         <div class="col-md-4 col-xs-6">
           <div class="product" style="height: 450px">
             <div class="product-img">
               <img src="'.base_url('assets/uploads/produk/'). $row['gambar'].'" alt="">
             </div>
             <div class="product-body">
               <p class="product-category">'. $row['kategori']. '</p>
               <h3 class="product-name"><a href="' .base_url('produk/index/'). $row['url_produk']. '">' .$row['nama']. '</a></h3>
               <h4 class="product-price">Rp. '.number_format($row['harga'],2,",",".").'</h4>
               '.$rating.'
             </div>
           </div>
         </div>
         ';
        }
       }
       else
       {
        $output = '
           <div class="text-center" style="padding-top: 120px">
             <img src="'.base_url('assets/user/img').'/No_Product_Found.png" style="width: 40%">
           </div>
         ';
       }
       return $output;
      }
      //END tinta

      //komputer & otomatisasi kantor
      function make_query_komputer($minimum_price, $maximum_price, $brand, $search, $url)
      {
        $query = "
        SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
  			LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
  			join produk on ulasan.id_produk=produk.id where produk.kategori_id='3' group by ulasan.id_produk) ul
  			on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id
        WHERE kt.url='".$url."'
        ";

        if(isset($minimum_price, $maximum_price) && !empty($minimum_price) &&  !empty($maximum_price))
        {
         $query .= "
          AND pd.harga BETWEEN '".$minimum_price."' AND '".$maximum_price."'
         ";
        }

        if(isset($brand))
        {
         $brand_filter = implode("','", $brand);
         $query .= "
          AND pd.merek IN('".$brand_filter."')
         ";
        }

        if(isset($search))
        {
          $query .= "
           AND pd.nama LIKE '%".$search."%'
           ORDER BY ul.total_ulasan DESC
          ";
        }
        return $query;
      }

       function count_komputer($minimum_price, $maximum_price, $brand, $search, $url)
       {
        $query = $this->make_query_komputer($minimum_price, $maximum_price, $brand, $search, $url);
        $data = $this->db->query($query);
        return $data->num_rows();
       }

       function fetch_komputer($limit, $start, $minimum_price, $maximum_price, $brand, $search, $url)
       {
        $query = $this->make_query_komputer($minimum_price, $maximum_price, $brand, $search, $url);

        $query .= ' LIMIT '.$start.', ' . $limit;

        $data = $this->db->query($query);

        $output = '';
        if($data->num_rows() > 0)
        {
         foreach($data->result_array() as $row)
         {

           //label badge
           if($row['avg_rating'] == '' || $row['avg_rating'] == NULL) {
             $rating = '
             <div class="product-rating">
               <i class="fa fa-star-o empty"></i>
               <i class="fa fa-star-o empty"></i>
               <i class="fa fa-star-o empty"></i>
               <i class="fa fa-star-o empty"></i>
               <i class="fa fa-star-o empty"></i>
             </div>
             ';
           } else if($row['avg_rating'] == 1 || $row['avg_rating'] < 2) {
             $rating = '
             <div class="product-rating">
               <i class="fa fa-star"></i>
               <i class="fa fa-star-o empty"></i>
               <i class="fa fa-star-o empty"></i>
               <i class="fa fa-star-o empty"></i>
               <i class="fa fa-star-o empty"></i>
             </div>
             ';
           } else if($row['avg_rating'] == 2 || $row['avg_rating'] < 3) {
             $rating = '
             <div class="product-rating">
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star-o empty"></i>
               <i class="fa fa-star-o empty"></i>
               <i class="fa fa-star-o empty"></i>
             </div>
             ';
           } else if($row['avg_rating'] == 3 || $row['avg_rating'] < 4) {
             $rating = '
             <div class="product-rating">
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star-o empty"></i>
               <i class="fa fa-star-o empty"></i>
             </div>
             ';
           } else if($row['avg_rating'] == 4 || $row['avg_rating'] < 5) {
             $rating = '
             <div class="product-rating">
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star-o empty"></i>
             </div>
             ';
           } else {
             $rating = '
             <div class="product-rating">
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
             </div>
             ';
           }
           //END Label Badge

          $output .= '
          <div class="col-md-4 col-xs-6">
            <div class="product" style="height: 450px">
              <div class="product-img">
                <img src="'.base_url('assets/uploads/produk/'). $row['gambar'].'" alt="">
              </div>
              <div class="product-body">
                <p class="product-category">'. $row['kategori']. '</p>
                <h3 class="product-name"><a href="' .base_url('produk/index/'). $row['url_produk']. '">' .$row['nama']. '</a></h3>
                <h4 class="product-price">Rp. '.number_format($row['harga'],2,",",".").'</h4>
                '.$rating.'
              </div>
            </div>
          </div>
          ';
         }
        }
        else
        {
         $output = '
            <div class="text-center" style="padding-top: 120px">
              <img src="'.base_url('assets/user/img').'/No_Product_Found.png" style="width: 40%">
            </div>
          ';
        }
        return $output;
       }
       //END komputer & otomatisasi kantor

       //berkas
       function make_query_berkas($minimum_price, $maximum_price, $brand, $search, $url)
       {
         $query = "
         SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
        LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
        join produk on ulasan.id_produk=produk.id where produk.kategori_id='4' group by ulasan.id_produk) ul
        on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id
         WHERE kt.url='".$url."'
         ";

         if(isset($minimum_price, $maximum_price) && !empty($minimum_price) &&  !empty($maximum_price))
         {
          $query .= "
           AND pd.harga BETWEEN '".$minimum_price."' AND '".$maximum_price."'
          ";
         }

         if(isset($brand))
         {
          $brand_filter = implode("','", $brand);
          $query .= "
           AND pd.merek IN('".$brand_filter."')
          ";
         }

         if(isset($search))
         {
           $query .= "
            AND pd.nama LIKE '%".$search."%'
            ORDER BY ul.total_ulasan DESC
           ";
         }
         return $query;
       }

        function count_berkas($minimum_price, $maximum_price, $brand, $search, $url)
        {
         $query = $this->make_query_berkas($minimum_price, $maximum_price, $brand, $search, $url);
         $data = $this->db->query($query);
         return $data->num_rows();
        }

        function fetch_berkas($limit, $start, $minimum_price, $maximum_price, $brand, $search, $url)
        {
         $query = $this->make_query_berkas($minimum_price, $maximum_price, $brand, $search, $url);

         $query .= ' LIMIT '.$start.', ' . $limit;

         $data = $this->db->query($query);

         $output = '';
         if($data->num_rows() > 0)
         {
          foreach($data->result_array() as $row)
          {

            //label badge
            if($row['avg_rating'] == '' || $row['avg_rating'] == NULL) {
              $rating = '
              <div class="product-rating">
                <i class="fa fa-star-o empty"></i>
                <i class="fa fa-star-o empty"></i>
                <i class="fa fa-star-o empty"></i>
                <i class="fa fa-star-o empty"></i>
                <i class="fa fa-star-o empty"></i>
              </div>
              ';
            } else if($row['avg_rating'] == 1 || $row['avg_rating'] < 2) {
              $rating = '
              <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o empty"></i>
                <i class="fa fa-star-o empty"></i>
                <i class="fa fa-star-o empty"></i>
                <i class="fa fa-star-o empty"></i>
              </div>
              ';
            } else if($row['avg_rating'] == 2 || $row['avg_rating'] < 3) {
              $rating = '
              <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o empty"></i>
                <i class="fa fa-star-o empty"></i>
                <i class="fa fa-star-o empty"></i>
              </div>
              ';
            } else if($row['avg_rating'] == 3 || $row['avg_rating'] < 4) {
              $rating = '
              <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o empty"></i>
                <i class="fa fa-star-o empty"></i>
              </div>
              ';
            } else if($row['avg_rating'] == 4 || $row['avg_rating'] < 5) {
              $rating = '
              <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o empty"></i>
              </div>
              ';
            } else {
              $rating = '
              <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
              ';
            }
            //END Label Badge

           $output .= '
           <div class="col-md-4 col-xs-6">
             <div class="product" style="height: 450px">
               <div class="product-img">
                 <img src="'.base_url('assets/uploads/produk/'). $row['gambar'].'" alt="">
               </div>
               <div class="product-body">
                 <p class="product-category">'. $row['kategori']. '</p>
                 <h3 class="product-name"><a href="' .base_url('produk/index/'). $row['url_produk']. '">' .$row['nama']. '</a></h3>
                 <h4 class="product-price">Rp. '.number_format($row['harga'],2,",",".").'</h4>
                 '.$rating.'
               </div>
             </div>
           </div>
           ';
          }
         }
         else
         {
          $output = '
             <div class="text-center" style="padding-top: 120px">
               <img src="'.base_url('assets/user/img').'/No_Product_Found.png" style="width: 40%">
             </div>
           ';
         }
         return $output;
        }
        //END berkas

        //furnitur
        function make_query_furnitur($minimum_price, $maximum_price, $brand, $search, $url)
        {
          $query = "
          SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
          LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
          join produk on ulasan.id_produk=produk.id where produk.kategori_id='5' group by ulasan.id_produk) ul
          on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id
          WHERE kt.url='".$url."'
          ";

          if(isset($minimum_price, $maximum_price) && !empty($minimum_price) &&  !empty($maximum_price))
          {
           $query .= "
            AND pd.harga BETWEEN '".$minimum_price."' AND '".$maximum_price."'
           ";
          }

          if(isset($brand))
          {
           $brand_filter = implode("','", $brand);
           $query .= "
            AND pd.merek IN('".$brand_filter."')
           ";
          }

          if(isset($search))
          {
            $query .= "
             AND pd.nama LIKE '%".$search."%'
             ORDER BY ul.total_ulasan DESC
            ";
          }
          return $query;
        }

         function count_furnitur($minimum_price, $maximum_price, $brand, $search, $url)
         {
          $query = $this->make_query_furnitur($minimum_price, $maximum_price, $brand, $search, $url);
          $data = $this->db->query($query);
          return $data->num_rows();
         }

         function fetch_furnitur($limit, $start, $minimum_price, $maximum_price, $brand, $search, $url)
         {
          $query = $this->make_query_furnitur($minimum_price, $maximum_price, $brand, $search, $url);

          $query .= ' LIMIT '.$start.', ' . $limit;

          $data = $this->db->query($query);

          $output = '';
          if($data->num_rows() > 0)
          {
           foreach($data->result_array() as $row)
           {

             //label badge
             if($row['avg_rating'] == '' || $row['avg_rating'] == NULL) {
               $rating = '
               <div class="product-rating">
                 <i class="fa fa-star-o empty"></i>
                 <i class="fa fa-star-o empty"></i>
                 <i class="fa fa-star-o empty"></i>
                 <i class="fa fa-star-o empty"></i>
                 <i class="fa fa-star-o empty"></i>
               </div>
               ';
             } else if($row['avg_rating'] == 1 || $row['avg_rating'] < 2) {
               $rating = '
               <div class="product-rating">
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star-o empty"></i>
                 <i class="fa fa-star-o empty"></i>
                 <i class="fa fa-star-o empty"></i>
                 <i class="fa fa-star-o empty"></i>
               </div>
               ';
             } else if($row['avg_rating'] == 2 || $row['avg_rating'] < 3) {
               $rating = '
               <div class="product-rating">
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star-o empty"></i>
                 <i class="fa fa-star-o empty"></i>
                 <i class="fa fa-star-o empty"></i>
               </div>
               ';
             } else if($row['avg_rating'] == 3 || $row['avg_rating'] < 4) {
               $rating = '
               <div class="product-rating">
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star-o empty"></i>
                 <i class="fa fa-star-o empty"></i>
               </div>
               ';
             } else if($row['avg_rating'] == 4 || $row['avg_rating'] < 5) {
               $rating = '
               <div class="product-rating">
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star-o empty"></i>
               </div>
               ';
             } else {
               $rating = '
               <div class="product-rating">
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
               </div>
               ';
             }
             //END Label Badge

            $output .= '
            <div class="col-md-4 col-xs-6">
              <div class="product" style="height: 450px">
                <div class="product-img">
                  <img src="'.base_url('assets/uploads/produk/'). $row['gambar'].'" alt="">
                </div>
                <div class="product-body">
                  <p class="product-category">'. $row['kategori']. '</p>
                  <h3 class="product-name"><a href="' .base_url('produk/index/'). $row['url_produk']. '">' .$row['nama']. '</a></h3>
                  <h4 class="product-price">Rp. '.number_format($row['harga'],2,",",".").'</h4>
                  '.$rating.'
                </div>
              </div>
            </div>
            ';
           }
          }
          else
          {
           $output = '
              <div class="text-center" style="padding-top: 120px">
                <img src="'.base_url('assets/user/img').'/No_Product_Found.png" style="width: 40%">
              </div>
            ';
          }
          return $output;
         }
         //END furnitur

}
