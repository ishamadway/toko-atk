    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-info">
            <a class="navbar-brand" href="<?php echo base_url('admin/dashboard') ?>"><b>L.U.M</b> Admin</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <div class="btn-group">
                    <button type="button" id="notif_button" class="btn btn-info notif-toggle dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu notif-menu dropdown-menu-right">
                        <div style="border-bottom: 1px solid lightgrey; padding-bottom: 10px">
                            <h6 class="dropdown-header">Notifikasi</h6>
                        </div>

                        <div style="overflow-y: scroll; overflow-x: hidden; height: 200px" id="show_notif"></div>
                        
                        <div style="padding-top: 10px">
                            <h6 class="dropdown-header text-right">
                                <a id="delete_all_notif" class="btn btn-sm btn-danger" title="Delete all read messages"><i class="fas fa-trash"></i></a>
                                <a id="read_all_notif" class="btn btn-sm btn-primary" data-read="1"><i class="fas fa-check"></i> Mark all as read</a></h6>
                        </div>
                    </div>
                </div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome, <?php echo $this->session->userdata('nama'); ?>
                      <img src="<?php echo base_url('assets/uploads/user/default-user-avatar.png')?>"
                      alt="..." class="rounded-circle" style="width: 25px"></a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                      <a class="dropdown-item" href="<?php echo base_url('admin/profile')?>">Profile</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
                  </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="<?php echo base_url('admin/dashboard') ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                                Master Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url('admin/pembeli') ?>">Pembeli</a>
                                    <a class="nav-link" href="<?php echo base_url('admin/produk/all') ?>">Produk</a>
                                    <a class="nav-link" href="<?php echo base_url('admin/kategori') ?>">Kategori</a>
                                    <a class="nav-link" href="<?php echo base_url('admin/Ekspedisi') ?>">Ekspedisi</a>
                                </nav>
                            </div>

                            <!-- penjualan -->
                            <div class="sb-sidenav-menu-heading">Penjualan</div>
                            <a class="nav-link" href="<?php echo base_url('admin/pesanan'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                                Pesanan
                            </a>
                            <a class="nav-link" href="<?php echo base_url('admin/kirim_produk'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                                Kirim Produk
                            </a>

                            <!-- laporan -->
                            <div class="sb-sidenav-menu-heading">Laporan</div>
                            <a class="nav-link" href="<?php echo base_url('admin/penjualan_produk'); ?>">
                                <div class="sb-nav-link-icon"><i class="far fa-chart-bar"></i></div>
                                Penjualan Produk
                            </a>
                            <a class="nav-link" href="<?php echo base_url('admin/transaksi'); ?>">
                                <div class="sb-nav-link-icon"><i class="fa fa-exchange-alt"></i></div>
                                Transaksi
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>

            <script type="text/javascript">
              var status_expired_order = window.setInterval(update_status_expired_order, 2000);
              var status_expired_shipment = window.setInterval(update_status_expired_shipment, 2000);
              var status_expired_arrived = window.setInterval(update_status_arrived_order, 2000);
              var new_order = window.setInterval(update_new_order, 2000);

              //cek pesanan yang sudah expired setiap 5 detik
              function update_status_expired_order() {
                  $.ajax({
                      url: "<?php echo site_url('update_status/update_status_expired_order');?>",
                      dataType: 'text',
                      success: function(data){
                            $('#show_notif').load("<?php echo site_url('admin/notifikasi/load_notif');?>");
                            $('#notif_button').load("<?php echo site_url('admin/notifikasi/notif_button');?>");
                      }
                  })
              }

              //cek pesanan yang sudah melbihi batas pengiriman setiap 5 detik
              function update_status_expired_shipment() {
                  $.ajax({
                      url: "<?php echo site_url('update_status/update_status_expired_shipment');?>",
                      dataType: 'text',
                      success: function(data){
                            $('#show_notif').load("<?php echo site_url('admin/notifikasi/load_notif');?>");
                            $('#notif_button').load("<?php echo site_url('admin/notifikasi/notif_button');?>");
                      }
                  })
              }

            //cek pesanan baru
            function update_new_order() {
                  $.ajax({
                      url: "<?php echo site_url('pesanan_saya/trial_bayar');?>",
                      dataType: 'text',
                      success: function(data){
                            $('#show_notif').load("<?php echo site_url('admin/notifikasi/load_notif');?>");
                            $('#notif_button').load("<?php echo site_url('admin/notifikasi/notif_button');?>");
                      }
                  })
              }

            //cek pesanan selesai
            function update_status_arrived_order() {
                  $.ajax({
                      url: "<?php echo site_url('update_status/update_status_arrived_order');?>",
                      dataType: 'text',
                      success: function(data){
                            $('#show_notif').load("<?php echo site_url('admin/notifikasi/load_notif');?>");
                            $('#notif_button').load("<?php echo site_url('admin/notifikasi/notif_button');?>");
                      }
                  })
              }
            </script>

            <script>
            $(document).ready(function(){

                $('#read_all_notif').click(function(){
                    var read = $(this).data("read");
						$.ajax({
								url : "<?php echo site_url('admin/notifikasi/read_all_notif');?>",
                                method : "POST",
								data : {read: read},
								success: function(data){
                                        $('#show_notif').load("<?php echo site_url('admin/notifikasi/load_notif');?>");
                                        $('#notif_button').load("<?php echo site_url('admin/notifikasi/notif_button');?>");
								}
						});
				});

                $('#delete_all_notif').click(function(){
						$.ajax({
								url : "<?php echo site_url('admin/notifikasi/delete_all_notif');?>",
								success: function(data){
                                        $('#show_notif').load("<?php echo site_url('admin/notifikasi/load_notif');?>");
                                        $('#notif_button').load("<?php echo site_url('admin/notifikasi/notif_button');?>");
								}
						});
				});

                $('#show_notif').load("<?php echo site_url('admin/notifikasi/load_notif');?>");
                $('#notif_button').load("<?php echo site_url('admin/notifikasi/notif_button');?>");

                $('.notif-menu').on('click', function(event) {
                    event.stopPropagation();
                });

            });
            
            </script>
