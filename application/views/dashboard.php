<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">LUM Store</li>
                        </ol>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Summary
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h3><?php echo count($produk) ?></h3>
                                                <hr>
                                                <small>Total Produk</small>
                                            </div>
                                            <div class="col-lg-3">
                                                <?php foreach($penjualan as $a) {} ?>
                                                <h3>Rp. <?php echo number_format($a->total_amount,0,",",".") ?></h3>
                                                <hr>
                                                <small>Total Pendapatan Penjualan</small>
                                            </div>
                                            <div class="col-lg-3">
                                                <h3><?php echo $a->total_trans ?></h3>
                                                <hr>
                                                <small>Total Transaksi Selesai</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </main>