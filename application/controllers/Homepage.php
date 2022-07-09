<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function index()
	{
			$data['kategori'] = $this->ModelKategori->get_kategori()->result();

			$data['top_produk'] = $this->db->query("SELECT pd.*, ul.avg_rating, ul.total_ulasan, tr.terjual, kt.* FROM produk pd
				LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
				join produk on ulasan.id_produk=produk.id group by ulasan.id_produk) ul
				on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id
				LEFT JOIN (select item_pesanan.id_produk, count(item_pesanan.quantity) as terjual from item_pesanan
				join transaksi on transaksi.order_id=item_pesanan.order_id where transaksi.status='Selesai' group by item_pesanan.id_produk) tr
				on tr.id_produk=pd.id HAVING tr.terjual >= 1 ORDER BY tr.terjual DESC")->result();

			$data['alat_tulis'] = $this->db->query("SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
				LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
				join produk on ulasan.id_produk=produk.id where produk.kategori_id='1' group by ulasan.id_produk) ul
				on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id WHERE kt.id_kategori='1'")->result();

			$data['tinta'] = $this->db->query("SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
				LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
				join produk on ulasan.id_produk=produk.id where produk.kategori_id='2' group by ulasan.id_produk) ul
				on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id WHERE kt.id_kategori='2'")->result();

			$data['komputer'] = $this->db->query("SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
				LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
				join produk on ulasan.id_produk=produk.id where produk.kategori_id='3' group by ulasan.id_produk) ul
				on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id WHERE kt.id_kategori='3'")->result();

			$data['berkas'] = $this->db->query("SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
				LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
				join produk on ulasan.id_produk=produk.id where produk.kategori_id='4' group by ulasan.id_produk) ul
				on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id WHERE kt.id_kategori='4'")->result();

			$data['furnitur'] = $this->db->query("SELECT pd.*, ul.avg_rating, ul.total_ulasan, kt.* FROM produk pd
				LEFT JOIN (select ulasan.id_produk, avg(ulasan.bintang) as avg_rating, count(ulasan.id_ulasan) as total_ulasan from ulasan
				join produk on ulasan.id_produk=produk.id where produk.kategori_id='5' group by ulasan.id_produk) ul
				on ul.id_produk=pd.id LEFT JOIN kategori kt ON kt.id_kategori=pd.kategori_id WHERE kt.id_kategori='5'")->result();

			$data['title'] = 'L.U.M - Toko Online untuk kebutuhan Alat Tulis Kantor';
      $this->load->view('templates_user/header',$data);
      $this->load->view('templates_user/topbar',$data);
      $this->load->view('index',$data);
      $this->load->view('templates_user/footer');
	}
}

?>
