<?php

class Keranjang extends CI_Controller{

  public function index()
  {
    $data['title'] = 'Keranjang Saya - L.U.M Office Stationery Store';
    $this->load->view('templates_user/header', $data);
    $this->load->view('templates_user/topbar',$data);
    $this->load->view('keranjang', $data);
    $this->load->view('templates_user/footer');
  }

  function show_cart(){ //Fungsi untuk menampilkan Cart
      $output = '';
      $cart = count($this->cart->contents());
      if($cart > 0) {
      $no = 0;
      foreach ($this->cart->contents() as $items) {

          $id_produk = $items['id'];
          $produk = $this->db->query("SELECT * FROM produk WHERE id='$id_produk'")->row();
          $stok = $produk->stok;
          $subtotal = $items['price'] * $items['qty'];

          $no++;
          $output .='

          <hr>
          <div class="row">
            <div class="col-lg-2">
              <img src="'.base_url('assets/uploads/produk/').$items['image'].'" style="width: 200px" class="img-thumbnail">
            </div>
            <div class="col-lg-10">
              <div class="row">
                <div class="col-lg-10">
                  <a href="'.base_url('produk/index/'). $items['url'].'" style="font-weight: 500; font-size: 16px">'.$items['name'].'</a>
                  <p style="padding-top: 10px">Stok: '.$stok.'</p>
                </div>
                <div class="col-lg-2 text-right">
                  <a class="delete btn" id="'.$items['rowid'].'"><i class="fa fa-times fa-lg" aria-hidden="true"></i></a>
                </div>
              </div>
              <p style="padding-top: 20px">Qty:</p>
              <div class="qty-label" style="width: 80px">
                  <input type="number" name="qty" min="1" max="'.$stok.'" class="qty form-control" id="'.$items['rowid'].'" value="'.$items['qty'].'">
              </div>

              <div class="text-right">
                <h5>Subtotal: Rp. '.number_format($subtotal,0,",",".").'</h5>
              </div>

            </div>
          </div>
          <hr>
          ';
        }
      } else {
        $output .='
        <div class="text-center" style="padding-top: 80px; padding-bottom: 100px">
          <h4>Keranjang belanja kosong!</h4>
        </div>
        <hr>
        ';
      }
      if(!empty($this->cart->contents())){
        $checkout = '
          <a class="empty_cart btn btn-default">Kosongkan</a>
          <a href="'.base_url('checkout').'" class="btn btn-info" style="background-color: #0048ff">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
        ';
      } else {
        $checkout = '';
      }
      $output .= '
        <div class="row">
          <div class="col-lg-6">
            <h5>Total Pesanan: Rp. '.number_format($this->cart->total(),0,",",".").'</h5>
          </div>
          <div class="col-lg-6 text-right">
            '.$checkout.'
          </div>
        </div>
      ';
      return $output;
  }

  function load_cart(){ //load data cart
      echo $this->show_cart();
  }

  function update_cart(){
    $data = array(
        'rowid' => $this->input->post('row_id'),
        'qty' => $this->input->post('qty')
    );
    $this->cart->update($data);
    echo $this->show_cart();
  }

  function delete_cart(){ //fungsi untuk menghapus item cart
      $data = array(
          'rowid' => $this->input->post('row_id'),
          'qty' => 0,
      );
      $this->cart->update($data);
      echo $this->show_cart();
  }

  function empty_cart()
  {
      $this->cart->destroy();
      echo $this->show_cart();
  }
}
