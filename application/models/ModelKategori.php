<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelKategori extends CI_Model
{
    public function get_kategori()
    {
        return $this->db->get('kategori');
    }

    public function insert_kategori($data)
    {
        $this->db->insert($data, 'kategori');
    }

    public function get_where_kategori($url)
    {
        $result = $this->db->where('url', $url)
                           ->get('kategori');
        return $result->row();

    }

}
