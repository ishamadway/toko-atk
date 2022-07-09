<?php 
$id = $this->session->userdata('id');
$user = $this->db->query("SELECT * FROM user WHERE id='$id'")->result();

foreach($user as $us) {} ?>

<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-info"></i> Tentang Asylum Store</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Map Toko Offline</a></li>
						<li><a href="#"><i class="fa fa-envelope"></i> Email</a></li>
					</ul>
					<ul class="header-links pull-right">
						<?php if ($this->session->userdata('id') == '') { ?>
							<li><a href="<?php echo base_url('auth/login') ?>"><i class="fa fa-sign-in"></i> Masuk</a></li>
							<li><a href="<?php echo base_url('auth/register') ?>"><i class="fa fa-sign-in"></i> Daftar</a></li>
						<?php } else { ?>
							<li><a href="<?php echo base_url('akun_saya') ?>"><img src="<?php echo base_url('assets/uploads/user/'). $us->foto ?>" class="img-circle"
                  				   style="width: 15px; height: 15px"> <?php echo $us->nama ?></a></li>
              				<li><a href="<?php echo base_url('pesanan_saya') ?>"><i class="fa fa-envelope"></i> Pesanan Saya</a></li>
							<li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="<?php echo base_url('') ?>" class="logo">
									<img src="<?php echo base_url('assets/user')?> /img/LUM_Logo-01.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-3">
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-6 clearfix">
							<div class="header-ctn">

								<?php if($this->session->userdata('id') != NULL){ ?>
								<!-- Notif -->
								<div class="dropdown">
									<a class="dropdown-toggle" id="icon_notif" data-toggle="dropdown" aria-expanded="true">
									</a>
									<div class="cart-dropdown">
										<div class="cart-list" id="detail_notif">
										</div>
										<div class="cart-btns">
											<a href="#" id="delete_all_notif">Delete all</a>
          									<a href="#" id="read_all_notif" data-read="1">Mark all as read</a>
										</div>
									</div>
								</div>
								<!-- /Notif -->
								<?php } ?>

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Keranjang</span>
										<div class="qty" id="count_cart">
										</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list" id="detail_cart">
										</div>
										<div class="cart-btns" id="button_cart">
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="<?php if($this->uri->segment(1) == 'homepage' || $this->uri->segment(1) == '') { echo 'active'; } else {echo ''; } ?>"><a href="<?php echo base_url('homepage')?>">Home</a></li>
						<li class="<?php if($this->uri->segment(3) == 'alat-tulis') { echo 'active'; } else {echo ''; } ?>"><a href="<?php echo base_url('kategori/index/alat-tulis') ?>">Alat Tulis</a></li>
						<li class="<?php if($this->uri->segment(3) == 'tinta') { echo 'active'; } else {echo ''; } ?>"><a href="<?php echo base_url('kategori/index/tinta') ?>">Tinta</a></li>
						<li class="<?php if($this->uri->segment(3) == 'komputer-otomatisasi-kantor') { echo 'active'; } else {echo ''; } ?>"><a href="<?php echo base_url('kategori/index/komputer-otomatisasi-kantor') ?>">Komputer & Otomatisasi Kantor</a></li>
						<li class="<?php if($this->uri->segment(3) == 'berkas') { echo 'active'; } else {echo ''; } ?>"><a href="<?php echo base_url('kategori/index/berkas') ?>">Berkas</a></li>
						<li class="<?php if($this->uri->segment(3) == 'furnitur') { echo 'active'; } else {echo ''; } ?>"><a href="<?php echo base_url('kategori/index/furnitur') ?>">Furnitur</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- Modal Success -->
		<div class="modal fade" id="ModalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-body text-center" style="padding: 40px">
						<a class="text-success"><i class="fa fa-5x fa-check-circle-o" aria-hidden="true"></i></a>
						<h5 style="padding-top: 20px">Ditambahkan kedalam keranjang!</h5>
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal Success -->

		<!-- Modal addWishlist -->
		<div class="modal fade" id="addWishlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-body text-center" style="padding: 40px">
						<a class="text-success"><i class="fa fa-5x fa-check-circle-o" aria-hidden="true"></i></a>
						<h5 style="padding-top: 20px">Ditambahkan kedalam wishlist!</h5>
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal addWishlist -->

		<script>
		$(document).ready(function(){
				$('#count_cart').load("<?php echo site_url('cart/count_cart');?>");
        		$('#button_cart').load("<?php echo site_url('cart/show_button_cart');?>");
				$('.add-to-cart-btn').click(function(){
					var id = $(this).data("id");
					var nama = $(this).data("nama");
					var harga = $(this).data("harga");
					var gambar = $(this).data("gambar");
					var url = $(this).data("url");
					var quantity = $('#' + id).val();
						$.ajax({
								url : "<?php echo site_url('cart/add_to_cart');?>",
								method : "POST",
								data : {id: id, nama: nama, harga: harga, quantity: quantity, gambar: gambar, url: url},
								success: function(data){
										$('#detail_cart').html(data);
										$('#count_cart').load("<?php echo site_url('cart/count_cart');?>");
                    					$('#button_cart').load("<?php echo site_url('cart/show_button_cart');?>");
										$('#ModalSuccess').modal('show');
										setTimeout(function() {
											$('#ModalSuccess').modal('hide')
										}, 3000);
								}
						});
				});

				$('#read_all_notif').click(function(){
                    var read = $(this).data("read");
						$.ajax({
								url : "<?php echo site_url('notifikasi/read_all_notif');?>",
                                method : "POST",
								data : {read: read},
								success: function(data){
									$('#detail_notif').load("<?php echo site_url('notifikasi/load_notif');?>");
									$('#icon_notif').load("<?php echo site_url('notifikasi/notif_button');?>");
								}
						});
				});

                $('#delete_all_notif').click(function(){
						$.ajax({
								url : "<?php echo site_url('notifikasi/delete_all_notif');?>",
								success: function(data){
									$('#detail_notif').load("<?php echo site_url('notifikasi/load_notif');?>");
									$('#icon_notif').load("<?php echo site_url('notifikasi/notif_button');?>");
								}
						});
				});

				// Load shopping cart
				$('#detail_notif').load("<?php echo site_url('notifikasi/load_notif');?>");
				$('#icon_notif').load("<?php echo site_url('notifikasi/notif_button');?>");
				$('#detail_cart').load("<?php echo site_url('cart/load_cart');?>");

		});
		</script>

		<script type="text/javascript">
			var status_expired_order = window.setInterval(update_status_expired_order, 2000);
			var status_expired_shipment = window.setInterval(update_status_expired_shipment, 2000);
			var status_expired_arrived = window.setInterval(update_status_arrived_order, 2000);

			//cek pesanan yang sudah expired setiap 2 detik
			function update_status_expired_order() {
					$.ajax({
							url: "<?php echo site_url('update_status/update_status_expired_order');?>",
							dataType: 'text',
								success: function(data){
								$('#detail_notif').load("<?php echo site_url('notifikasi/load_notif');?>");
								$('#icon_notif').load("<?php echo site_url('notifikasi/notif_button');?>");
                      }
					})
			}

			//cek pesanan yang sudah melbihi batas pengiriman setiap 2 detik
			function update_status_expired_shipment() {
					$.ajax({
							url: "<?php echo site_url('update_status/update_status_expired_shipment');?>",
							dataType: 'text',
								success: function(data){
								$('#detail_notif').load("<?php echo site_url('notifikasi/load_notif');?>");
								$('#icon_notif').load("<?php echo site_url('notifikasi/notif_button');?>");
                      }
					})
			}

			//cek pesanan selesai
			function update_status_arrived_order() {
                  $.ajax({
                      url: "<?php echo site_url('update_status/update_status_arrived_order');?>",
                      dataType: 'text',
                      		success: function(data){
							$('#detail_notif').load("<?php echo site_url('notifikasi/load_notif');?>");
							$('#icon_notif').load("<?php echo site_url('notifikasi/notif_button');?>");
                      }
                  })
              }
		</script>
