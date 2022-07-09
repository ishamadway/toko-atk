<?php foreach ($pesanan as $p) {
    if ($p['status_code'] == '200') {
        $status = '<h3 class="badge badge-pill badge-primary">SETTLEMENT</h3>';
    } else if ($p['status_code'] == '201') {
        $status = '<h3 class="badge badge-pill badge-warning">PENDING</h3>';
    } else if ($p['status_code'] == '202') {
        $status = '<h3 class="badge badge-pill badge-danger">FAILURE</h3>';
    }

    $batas_pembayaran = date('Y-m-d H:i:s', strtotime($p['transaction_time'] . ' +1 day'));
} ?>

<?php foreach ($pengiriman as $pn) {
} ?>

<?php foreach ($dibatalkan as $db) {
} ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Detail Pesanan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Penjualan</li>
                <li class="breadcrumb-item">Pesanan</li>
                <li class="breadcrumb-item active">Detail Pesanan</li>
            </ol>

            <div class="mb-4">
                <a class="btn btn-white" onclick="goBack()"><i class="fas fa-chevron-left"></i> Kembali</a>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Informasi Pembayaran
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-3">
                            <div style="padding: 20px; background-color: #fafafa">
                                <h5 class="card-title">Order ID</h5>
                                <p class="card-text"><?php echo $p['order_id'] ?></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div style="padding: 20px; background-color: #fafafa">
                                <h5 class="card-title">Total Pesanan</h5>
                                <p class="card-text">Rp. <?php echo number_format($p['grand_total'], 0, ",", ".") ?></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div style="padding: 20px; background-color: #fafafa">
                                <h5 class="card-title">Metode Pembayaran</h5>
                                <p class="card-text"><?php echo $p['payment_type'] ?></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div style="padding: 20px; background-color: #fafafa">
                                <h5 class="card-title">Status Transaksi</h5>
                                <?php echo $status ?>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Detail Order
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Order ID</b>
                                <span><?php echo $p['order_id'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Tipe Pembayaran</b>
                                <span><?php echo $p['payment_type'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Jumlah</b>
                                <span>Rp. <?php echo number_format($p['grand_total'], 0, ",", ".") ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Waktu Dibuat</b>
                                <span><?php echo $p['transaction_time'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Status</b>
                                <span><?php echo $status ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Detail Pembeli
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Nama</b>
                                <span><?php echo $p['nama'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>No. Telp</b>
                                <span><?php echo $p['no_telp'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Email</b>
                                <span><?php echo $p['email'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Alamat</b>
                                <span><?php echo $p['alamat'] ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Detail Pembayaran
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Virtual Account</b>
                                <span><?php echo $p['va_number'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Bank</b>
                                <span><?php echo $p['bank'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Expired Time</b>
                                <span><?php echo $batas_pembayaran ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Item Pesanan
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nama produk</th>
                                <th scope="col">Jumlah</th>
                                <th class="text-right" scope="col">Harga</th>
                                <th class="text-right" scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($item_pesanan as $ip) { ?>
                                <tr>
                                    <th scope="col"><?php echo $ip['id'] ?></th>
                                    <td><?php echo $ip['nama'] ?></td>
                                    <td><?php echo $ip['quantity'] ?></td>
                                    <td class="text-right">Rp. <?php echo number_format($ip['harga'], 0, ",", ".") ?></td>
                                    <td class="text-right">Rp. <?php echo number_format($ip['sub_total'], 0, ",", ".") ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Histori Pesanan
                </div>
                <div class="card-body">
                    <table class="table">

                        <?php if ($p['status'] == 'Belum Bayar') { ?>
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col"><?php echo $p['transaction_time'] ?></th>
                                    <td>Pesanan Dibuat</td>
                                    <td>Belum Bayar</td>
                                </tr>
                            </tbody>
                        <?php } ?>

                        <?php if ($p['status'] == 'Dikemas') { ?>
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col"><?php echo $p['transaction_time'] ?></th>
                                    <td>Pesanan Dibuat</td>
                                    <td>Belum Bayar</td>
                                </tr>
                                <tr>
                                    <th scope="col"><?php echo $p['settlement_time'] ?></th>
                                    <td>Pembayaran Dikonfirmasi</td>
                                    <td>Dikemas</td>
                                </tr>
                            </tbody>
                        <?php } ?>

                        <?php if ($p['status'] == 'Dikirim') { ?>
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col"><?php echo $p['transaction_time'] ?></th>
                                    <td>Pesanan Dibuat</td>
                                    <td>Belum Bayar</td>
                                </tr>
                                <tr>
                                    <th scope="col"><?php echo $p['settlement_time'] ?></th>
                                    <td>Pembayaran Dikonfirmasi</td>
                                    <td>Dikemas</td>
                                </tr>
                                <tr>
                                    <th scope="col"><?php echo $pn['tgl_dikirim'] ?></th>
                                    <td>Pesanan Dikirim</td>
                                    <td>Dikirim</td>
                                </tr>
                            </tbody>
                        <?php } ?>

                        <?php if ($p['status'] == 'Selesai') { ?>
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col"><?php echo $p['transaction_time'] ?></th>
                                    <td>Pesanan Dibuat</td>
                                    <td>Belum Bayar</td>
                                </tr>
                                <tr>
                                    <th scope="col"><?php echo $p['settlement_time'] ?></th>
                                    <td>Pembayaran Dikonfirmasi</td>
                                    <td>Dikemas</td>
                                </tr>
                                <tr>
                                    <th scope="col"><?php echo $pn['tgl_dikirim'] ?></th>
                                    <td>Pesanan Dikirim</td>
                                    <td>Dikirim</td>
                                </tr>
                                <tr>
                                    <th scope="col"><?php echo $pn['tgl_diterima'] ?></th>
                                    <td>Pesanan Selesai</td>
                                    <td>Selesai</td>
                                </tr>
                            </tbody>
                        <?php } ?>

                        <?php if ($p['status'] == 'Dibatalkan' && $p['settlement_time'] == NULL) { ?>
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col"><?php echo $p['transaction_time'] ?></th>
                                    <td>Pesanan Dibuat</td>
                                    <td>Belum Bayar</td>
                                </tr>
                                <tr>
                                    <th scope="col"><?php echo $db['created'] ?></th>
                                    <td>Pesanan Dibatalkan</td>
                                    <td>Dibatalkan</td>
                                </tr>
                            </tbody>
                        <?php } ?>

                        <?php if ($p['status'] == 'Dibatalkan' && $p['settlement_time'] != NULL) { ?>
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col"><?php echo $p['transaction_time'] ?></th>
                                    <td>Pesanan Dibuat</td>
                                    <td>Belum Bayar</td>
                                </tr>
                                <tr>
                                    <th scope="col"><?php echo $p['settlement_time'] ?></th>
                                    <td>Pembayaran Dikonfirmasi</td>
                                    <td>Dikemas</td>
                                </tr>
                                <tr>
                                    <th scope="col"><?php echo $db['created'] ?></th>
                                    <td>Pesanan Dibatalkan</td>
                                    <td>Dibatalkan</td>
                                </tr>
                            </tbody>
                        <?php } ?>

                    </table>
                </div>
            </div>

    </main>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>