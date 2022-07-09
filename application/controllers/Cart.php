<?php

class Cart extends CI_Controller{

  function add_to_cart(){ //fungsi Add To Cart
      $data = array(
        'id'      => $this->input->post('id'),
        'name'    => $this->input->post('nama'),
        'qty'     => $this->input->post('quantity'),
        'price'   => $this->input->post('harga'),
        'image'   => $this->input->post('gambar'),
        'url'   => $this->input->post('url')
      );
      $this->cart->insert($data);
      echo $this->show_cart(); //tampilkan cart setelah added
  }

  function show_cart(){ //Fungsi untuk menampilkan Cart
      $output = '';
      $cart = count($this->cart->contents());
      if($cart > 0) {
      $no = 0;
      foreach ($this->cart->contents() as $items) {
          $no++;
          $output .='
          <div class="product-widget">
            <div class="product-img">
              <img src="'.base_url('assets/uploads/produk/').$items['image'].'" alt="">
            </div>
            <div class="product-body">
              <h3 class="product-name"><a href="'.base_url('produk/index/'). $items['url'].'">'.$items['name'].'</a></h3>
              <h4 class="product-price"><span class="qty">x'.$items['qty'].'</span>'.number_format($items['price'],2,",",".").'</h4>
            </div>
          </div>
          ';
        }
      } else {
        $output .='
        <div class="product-widget" style="padding-top: 20px; padding-bottom: 20px">
          <h4>Keranjang Belanja kosong!</h4>
        </div>
        ';
      }
      $output .= '
      <div class="cart-summary">
      <h5>SUBTOTAL: Rp '.number_format($this->cart->total(),2,",",".").'</h5>
      </div>
      ';
      return $output;
  }

  function row_cart(){ //Fungsi untuk menampilkan Cart
      $output = '';
      $cart = count($this->cart->contents());
      $output .= ''.$cart.'';
      return $output;
  }

  function button_cart(){ //Fungsi untuk menampilkan Cart
      $output = '';
      $cart = count($this->cart->contents());
      if($cart > 0) {
        $output .= '
          <a href="'.base_url('keranjang').'">Lihat Keranjang</a>
          <a href="'.base_url('checkout').'">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
        ';
      } else {
        $output .= '
          <a href="'.base_url('keranjang').'">Lihat Keranjang</a>
          <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
        ';
      }
      return $output;
  }

  function load_cart(){ //load data cart
      echo $this->show_cart();
  }

  function count_cart(){
      echo $this->row_cart();
  }

  function show_button_cart(){
      echo $this->button_cart();
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
