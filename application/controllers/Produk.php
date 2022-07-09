<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function index($url)
	{
      $url = $this->uri->segment(3);
			
		$data['produk'] = $this->db->query("SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
			LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
			join produk on ulasan.id_produk=produk.id where produk.url_produk='$url' group by ulasan.id_produk) ul
			on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id WHERE pd.url_produk='$url' GROUP BY pd.id")->result();

		$data['ulasan'] = $this->db->query("SELECT ul.*, pd.*, us.nama as nama_user, us.foto FROM ulasan ul, user us, produk pd
			WHERE ul.id_user=us.id AND ul.id_produk=pd.id AND pd.url_produk='$url'")->result();
		$produk = $this->ModelProduk->get_where_produk($url);
		$url_title = $produk->nama;
		$data['title'] = $url_title.' - L.U.M Office Stationery Store';
      $this->load->view('templates_user/header', $data);
      $this->load->view('templates_user/topbar',$data);
      $this->load->view('produk', $data);
      $this->load->view('templates_user/footer');
	}
}

?>
