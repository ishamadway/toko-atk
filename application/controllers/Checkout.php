<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

  function __construct()
	{
    parent::__construct();
		if($this->session->userdata('role_id') != '3')
    {
      redirect('Auth/login');
    }
    $this->load->library('form_validation');
    $this->load->helper('form');

    // Load cart library
    $this->load->library('cart');

    $this->controller = 'checkout';
	}

  function index()
  {
      if($this->cart->total_items() <= 0){
        redirect('homepage');
      }
      $data['ekspedisi'] = $this->db->query("SELECT * FROM ekspedisi")->result();
      $data['title'] = 'Checkout - L.U.M Office Stationery Store';
      $this->load->view('templates_user/header', $data);
      $this->load->view('templates_user/topbar',$data);
      $this->load->view('checkout', $data);
      $this->load->view('templates_user/footer');
  }

  function placeOrder()
  {
      // Insert order data
      $ordData = array(
          'id_pembeli' => $this->session->userdata('id'),
          'catatan' => $this->input->post('catatan'),
          'grand_total' => $this->cart->total()
      );
      $insertOrder = $this->ModelOrder->insertOrder($ordData);

      if($insertOrder){
          // Retrieve cart data from the session
          $cartItems = $this->cart->contents();

          // Cart items
          $ordItemData = array();
          $i=0;
          foreach($cartItems as $items){
              $ordItemData[$i]['id_pesanan'] = $insertOrder;
              $ordItemData[$i]['id_produk'] = $items['id'];
              $ordItemData[$i]['quantity'] = $items['qty'];
              $ordItemData[$i]['sub_total'] = $items["subtotal"];
              $i++;

          }

          $i=0;
          foreach($cartItems as $data){
            $produk = $this->ModelOrder->getProdukID($data['id']);
            $produkData[$i] = array(
              'id'  => $data['id'],
              'stok'  => $produk->stok - $data['qty']
            );
            $i++;
          }

          if(!empty($ordItemData)){
              // Insert order items
              $insertOrderItems = $this->ModelOrder->insertOrderItems($ordItemData);
              $this->db->update_batch('produk', $produkData,'id');

              if($insertOrderItems){
                  // Remove items from the cart
                  $this->cart->destroy();

                  // Return order ID
                  redirect($this->controller.'/pembayaran/'.$insertOrder);
              }
          }
      }
      return false;
  }

  function pembayaran($ordID)
  {
      // Fetch order data from the database
      $data['order'] = $this->ModelOrder->getOrder($ordID);

      // Load order details view
      $data['title'] = 'Pembayaran - L.U.M Office Stationery Store';
      $this->load->view('templates_user/header', $data);
      $this->load->view('pembayaran', $data);
  }

}

?>
