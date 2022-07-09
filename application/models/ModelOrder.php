<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelOrder extends CI_Model{

    function __construct() {
        $this->proTable = 'produk';
        $this->custTable = 'user';
        $this->ordTable = 'pesanan';
        $this->ordItemsTable = 'item_pesanan';
    }

    /*
     * Fetch order data from the database
     * @param id returns a single record of the specified ID
     */
    public function getOrder($id){
        $this->db->select('o.id as id_order, o.*, c.*');
        $this->db->from($this->ordTable.' as o');
        $this->db->join($this->custTable.' as c', 'c.id = o.id_pembeli', 'left');
        $this->db->where('o.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();

        // Get order items
        $this->db->select('i.*, p.gambar, p.nama, p.harga');
        $this->db->from($this->ordItemsTable.' as i');
        $this->db->join($this->proTable.' as p', 'p.id = i.id_produk', 'left');
        $this->db->where('i.id_pesanan', $id);
        $query2 = $this->db->get();
        $result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();

        // Return fetched data
        return !empty($result)?$result:false;
    }

    /*
     * Insert order data in the database
     * @param data array
     */
    public function insertOrder($data){
        // Add created and modified date if not included
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }

            $data['id'] = rand();

        // Insert order data
        $insert = $this->db->insert($this->ordTable, $data);

        // Return the status
        return $insert?$this->db->insert_id():false;
    }

    /*
     * Insert order items data in the database
     * @param data array
     */
    public function insertOrderItems($data = array()) {

        // Insert order items
        $insert = $this->db->insert_batch($this->ordItemsTable, $data);

        // Return the status
        return $insert?true:false;
    }

    public function getProdukID($data) {
      $result = $this->db->where('id', $data)
                         ->get('produk');
      return $result->row();
    }

}
