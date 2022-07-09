<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index($url)
	{
      $url = $this->uri->segment(3);
			$data['kategori'] = $this->ModelKategori->get_kategori()->result();
			$data['produk'] = $this->db->query("SELECT * FROM produk pd, kategori kt, ulasan ul WHERE pd.kategori_id=kt.id_kategori AND ul.id_produk=pd.id AND kt.url='$url' AND ul.bintang > 0 GROUP BY pd.id LIMIT 5")->result();
			$data['merek'] = $this->ModelProduk->get_brand_filter($url);
			$kategori = $this->ModelKategori->get_where_kategori($url);

			$url_title = $kategori->kategori;
			$data['title'] = $url_title.' - L.U.M Office Stationery Store';
      $this->load->view('templates_user/header', $data);
      $this->load->view('templates_user/topbar',$data);
      $this->load->view('kategori/'.$url, $data);
      $this->load->view('templates_user/footer');
	}

	public function fetch_alat_tulis()
	{
		if(!isset($_SESSION))
		{
				session_start();
		}
		$url = 'alat-tulis';
		$search = $this->input->post('search');
		$minimum_price = $this->input->post('minimum_price');
		$maximum_price = $this->input->post('maximum_price');
		$brand = $this->input->post('brand');
		$popular = $this->input->post('popular');
		$price_asc = $this->input->post('price_asc');
		$price_desc = $this->input->post('price_desc');
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->ModelProduk->count_alat_tulis($minimum_price, $maximum_price, $brand, $search, $url);
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
			$config['full_tag_open']    = '<div class="store-filter clearfix"><ul class="store-pagination">';
			$config['full_tag_close']   = '</ul></div>';
			$config['num_tag_open']     = '<li><a href="#">';
			$config['num_tag_close']    = '</a></li>';
			$config['cur_tag_open']     = '<li class="active">';
			$config['cur_tag_close']    = '</li>';
			$config['next_tag_open']    = '<li><a href="#">';
			$config['next_tagl_close']  = '&raquo;</a></li>';
			$config['prev_tag_open']    = '<li><a href="#">';
			$config['prev_tagl_close']  = 'Next</a></li>';
			$config['first_tag_open']   = '<li><a href="#">';
			$config['first_tagl_close'] = '</a></li>';
			$config['last_tag_open']    = '<li><a href="#">';
			$config['last_tagl_close']  = '</a></li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		$start = ($page - 1) * $config['per_page'];
		$output = array(
		 'pagination_link'  => $this->pagination->create_links(),
		 'product_list'   => $this->ModelProduk->fetch_alat_tulis($config["per_page"], $start, $minimum_price, $maximum_price, $brand, $search, $url)
		);
		echo json_encode($output);
		session_write_close();
		sleep(2);
	}

	public function fetch_tinta()
	{
		if(!isset($_SESSION))
		{
				session_start();
		}
		$url = 'tinta';
		$search = $this->input->post('search');
		$minimum_price = $this->input->post('minimum_price');
		$maximum_price = $this->input->post('maximum_price');
		$brand = $this->input->post('brand');
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->ModelProduk->count_alat_tulis($minimum_price, $maximum_price, $brand, $search, $url);
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
			$config['full_tag_open']    = '<div class="store-filter clearfix"><ul class="store-pagination">';
			$config['full_tag_close']   = '</ul></div>';
			$config['num_tag_open']     = '<li><a href="#">';
			$config['num_tag_close']    = '</a></li>';
			$config['cur_tag_open']     = '<li class="active">';
			$config['cur_tag_close']    = '</li>';
			$config['next_tag_open']    = '<li><a href="#">';
			$config['next_tagl_close']  = '&raquo;</a></li>';
			$config['prev_tag_open']    = '<li><a href="#">';
			$config['prev_tagl_close']  = 'Next</a></li>';
			$config['first_tag_open']   = '<li><a href="#">';
			$config['first_tagl_close'] = '</a></li>';
			$config['last_tag_open']    = '<li><a href="#">';
			$config['last_tagl_close']  = '</a></li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		$start = ($page - 1) * $config['per_page'];
		$output = array(
		 'pagination_link'  => $this->pagination->create_links(),
		 'product_list'   => $this->ModelProduk->fetch_alat_tulis($config["per_page"], $start, $minimum_price, $maximum_price, $brand, $search, $url)
		);
		echo json_encode($output);
		session_write_close();
		sleep(2);
	}

	public function fetch_komputer()
	{
		if(!isset($_SESSION))
		{
				session_start();
		}
		$url = 'komputer-otomatisasi-kantor';
		$search = $this->input->post('search');
		$minimum_price = $this->input->post('minimum_price');
		$maximum_price = $this->input->post('maximum_price');
		$brand = $this->input->post('brand');
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->ModelProduk->count_komputer($minimum_price, $maximum_price, $brand, $search, $url);
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
			$config['full_tag_open']    = '<div class="store-filter clearfix"><ul class="store-pagination">';
			$config['full_tag_close']   = '</ul></div>';
			$config['num_tag_open']     = '<li><a href="#">';
			$config['num_tag_close']    = '</a></li>';
			$config['cur_tag_open']     = '<li class="active">';
			$config['cur_tag_close']    = '</li>';
			$config['next_tag_open']    = '<li><a href="#">';
			$config['next_tagl_close']  = '&raquo;</a></li>';
			$config['prev_tag_open']    = '<li><a href="#">';
			$config['prev_tagl_close']  = 'Next</a></li>';
			$config['first_tag_open']   = '<li><a href="#">';
			$config['first_tagl_close'] = '</a></li>';
			$config['last_tag_open']    = '<li><a href="#">';
			$config['last_tagl_close']  = '</a></li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		$start = ($page - 1) * $config['per_page'];
		$output = array(
		 'pagination_link'  => $this->pagination->create_links(),
		 'product_list'   => $this->ModelProduk->fetch_komputer($config["per_page"], $start, $minimum_price, $maximum_price, $brand, $search, $url)
		);
		echo json_encode($output);
		session_write_close();
		sleep(2);
	}

	public function fetch_berkas()
	{
		if(!isset($_SESSION))
		{
				session_start();
		}
		$url = 'berkas';
		$search = $this->input->post('search');
		$minimum_price = $this->input->post('minimum_price');
		$maximum_price = $this->input->post('maximum_price');
		$brand = $this->input->post('brand');
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->ModelProduk->count_berkas($minimum_price, $maximum_price, $brand, $search, $url);
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
			$config['full_tag_open']    = '<div class="store-filter clearfix"><ul class="store-pagination">';
			$config['full_tag_close']   = '</ul></div>';
			$config['num_tag_open']     = '<li><a href="#">';
			$config['num_tag_close']    = '</a></li>';
			$config['cur_tag_open']     = '<li class="active">';
			$config['cur_tag_close']    = '</li>';
			$config['next_tag_open']    = '<li><a href="#">';
			$config['next_tagl_close']  = '&raquo;</a></li>';
			$config['prev_tag_open']    = '<li><a href="#">';
			$config['prev_tagl_close']  = 'Next</a></li>';
			$config['first_tag_open']   = '<li><a href="#">';
			$config['first_tagl_close'] = '</a></li>';
			$config['last_tag_open']    = '<li><a href="#">';
			$config['last_tagl_close']  = '</a></li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		$start = ($page - 1) * $config['per_page'];
		$output = array(
		 'pagination_link'  => $this->pagination->create_links(),
		 'product_list'   => $this->ModelProduk->fetch_berkas($config["per_page"], $start, $minimum_price, $maximum_price, $brand, $search, $url)
		);
		echo json_encode($output);
		session_write_close();
		sleep(2);
	}

	public function fetch_furnitur()
	{
		if(!isset($_SESSION))
		{
				session_start();
		}
		$url = 'furnitur';
		$search = $this->input->post('search');
		$minimum_price = $this->input->post('minimum_price');
		$maximum_price = $this->input->post('maximum_price');
		$brand = $this->input->post('brand');
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->ModelProduk->count_furnitur($minimum_price, $maximum_price, $brand, $search, $url);
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
			$config['full_tag_open']    = '<div class="store-filter clearfix"><ul class="store-pagination">';
			$config['full_tag_close']   = '</ul></div>';
			$config['num_tag_open']     = '<li><a href="#">';
			$config['num_tag_close']    = '</a></li>';
			$config['cur_tag_open']     = '<li class="active">';
			$config['cur_tag_close']    = '</li>';
			$config['next_tag_open']    = '<li><a href="#">';
			$config['next_tagl_close']  = '&raquo;</a></li>';
			$config['prev_tag_open']    = '<li><a href="#">';
			$config['prev_tagl_close']  = 'Next</a></li>';
			$config['first_tag_open']   = '<li><a href="#">';
			$config['first_tagl_close'] = '</a></li>';
			$config['last_tag_open']    = '<li><a href="#">';
			$config['last_tagl_close']  = '</a></li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		$start = ($page - 1) * $config['per_page'];
		$output = array(
		 'pagination_link'  => $this->pagination->create_links(),
		 'product_list'   => $this->ModelProduk->fetch_furnitur($config["per_page"], $start, $minimum_price, $maximum_price, $brand, $search, $url)
		);
		echo json_encode($output);
		session_write_close();
		sleep(2);
	}

}

?>
