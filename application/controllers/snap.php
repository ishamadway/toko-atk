<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
				if($this->session->userdata('id') == NULL){
						redirect('Auth/login');
				}
        $params = array('server_key' => 'SB-Mid-server-PSo2WT_Zkxr1hicLwhqLuzlr', 'production' => false);
				$this->load->library('midtrans');
				$this->midtrans->config($params);
				$this->load->helper('url');
    }

    public function index()
    {
    	$this->load->view('checkout_snap');
    }

    public function token()
    {
			if(!empty($this->cart->total())){
				// Required
				$transaction_details = array(
				  'order_id' => rand(),
				  'gross_amount' =>  $this->cart->total(),
				);

				$cartItems = $this->cart->contents();

				// Cart items
				$item_details = array();
				$i=0;
				foreach($cartItems as $items){
						if(strlen($items['name']) > 47){
							$items['name'] = substr($items['name'], 0, 47) . '...';
						}
						$item_details[$i]['id'] = $items['id'];
						$item_details[$i]['price'] = $items["price"];
						$item_details[$i]['quantity'] = $items['qty'];
						$item_details[$i]['name'] = $items["name"];
						$i++;
				}

				$alamat = $this->session->userdata('alamat');
				$kota = $this->session->userdata('kota');
				$kode_pos = $this->session->userdata('kode_pos');

				$address = "$alamat, Kota $kota, $kode_pos";

				$shipping_address = array(
					'address'				=> $address
				);

				// Optional
				$customer_details = array(
				  'first_name'    => $this->session->userdata('nama'),
				  'email'         => $this->session->userdata('email'),
				  'phone'         => $this->session->userdata('no_telp'),
				  'shipping_address' => $shipping_address
				);


				// Data yang akan dikirim untuk request redirect_url.
		        $credit_card['secure'] = true;
		        //ser save_card true to enable oneclick or 2click
		        //$credit_card['save_card'] = true;

		        $time = time();
		        $custom_expiry = array(
		            'start_time' => date("Y-m-d H:i:s O",$time),
		            'unit' => 'days',
		            'duration'  => 1
		        );

		        $transaction_data = array(
		            'transaction_details'=> $transaction_details,
								'credit_card' 			 => $credit_card,
		            'item_details'       => $item_details,
		            'customer_details'   => $customer_details,
		            'expiry'             => $custom_expiry
		        );

					error_log(json_encode($transaction_data));
					$snapToken = $this->midtrans->getSnapToken($transaction_data);
					error_log($snapToken);
					echo $snapToken;
				}
			}

    public function finish()
    {
			$id_ekspedisi = $this->input->post('id_ekspedisi');
			$catatan = $this->input->post('catatan');

			if($id_ekspedisi == NULL){
			$this->session->set_flashdata(
				'gagal',
				'<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Pesanan gagal dibuat!</strong> Silahkan pilih jasa pengiriman.
				</div>'
			);
				redirect('checkout');
			} else {
			$result = json_decode($this->input->post('result_data'), true);

			$data = [
				'order_id' => $result['order_id'],
				'id_pembeli' => $this->session->userdata('id'),
				'id_ekspedisi' => $id_ekspedisi,
				'catatan' => $catatan,
				'grand_total' => $result['gross_amount'],
				'payment_type' => $result['payment_type'],
				'transaction_time' => $result['transaction_time'],
				'bank' => $result['va_numbers'][0]["bank"],
				'va_number' => $result['va_numbers'][0]["va_number"],
				'pdf_url' => $result['pdf_url'],
				'status_code' => $result['status_code'],
				'status' => 'Belum Bayar'
			];

			$transaction = $this->db->insert('transaksi', $data);
			if($transaction){
				$cartItems = $this->cart->contents();

				// Cart items
				$ordItemData = array();
				$i=0;
				$string = random_string('numeric', 5);
				$id = 'IP-'.$string;
				foreach($cartItems as $items){
						$ordItemData[$i]['order_id'] = $result['order_id'];
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

								$this->session->set_flashdata('sukses',
								'<div class="alert alert-info alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<strong>Pesanan berhasil dibuat!</strong> Silahkan bayar sebelum waktu yang ditentukan.
								 </div>');
								redirect('pesanan_saya');
						}
				}
			}
		}

    }
}
