<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <div class="col-md-12">

        <?php foreach($transaksi as $data) {
          $batas_pembayaran = date('Y-m-d H:i', strtotime($data->transaction_time . ' +1 day'));
          $dikirim_sebelum = date('Y-m-d', strtotime($data->settlement_time . ' +3 day'));
          ?>
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                <a href="#" onclick="goBack()"><i class="fa fa-chevron-left" aria-hidden="true"></i> KEMBALI</a>
              </div>
              <div class="col-lg-6 text-right">
                <a>NO. PESANAN: <?php echo $data->order_id ?> | <b><?php echo $data->status ?></b></a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php foreach($pengiriman as $p)
          {
            $estimated_time = date('Y-m-d', strtotime($p->tgl_dikirim . ' +3 day'));
          }
        ?>

        <?php foreach($notif as $n){
            $waktu_dibatalkan = $n->created;
          }
        ?>

        <div class="panel panel-default">
          <div class="panel-body">

            <div class="row" style="border-bottom: 1px solid lightgrey; padding-bottom: 15px">
              <div class="col-lg-12">
                <?php if($data->status == 'Belum Bayar') { ?>
                  <a>Bayar pesanan kamu sebelum <b><?php echo $batas_pembayaran ?></b></a>
                <?php } else if($data->status == 'Dikemas') { ?>
                  <a>Pesanan kamu akan dikirim sebelum <b><?php echo $dikirim_sebelum ?></b></a>
                <?php } else if($data->status == 'Dikirim') { ?>
                  <a>Estimasi Barang sampai <b><?php echo $estimated_time ?></b></a>
                <?php } else if($data->status == 'Selesai') { ?>
                  <a>Terimakasih atas pesanan anda!</a>
                <?php } else if($data->status == 'Dibatalkan' && $data->settlement_time != NULL) { ?>
                  <a>Pesanan dibatalkan oleh sistem karena penjual tidak mengirimkan pesanan.</a>
                <?php } else if($data->status == 'Dibatalkan' && $data->settlement_time == NULL) { ?>
                  <a>Pesanan dibatalkan oleh sistem karena pembayaran tidak bisa dikonfirmasi.</a>
                <?php } ?>
              </div>
            </div>

              <div class="row" style="padding-top: 20px">
                <div class="col-lg-6">
                  <p style="font-size: 18px">Alamat Pengiriman</p>
                </div>
                <div class="col-lg-6 text-right">
                  <?php echo $data->jenis_ekspedisi ?> - <?php echo $data->nama_ekspedisi ?>
                  <?php if($data->status == 'Dikirim' || $data->status == 'Selesai') { ?>
                    <p><?php echo $p->no_resi ?></p>
                  <?php } ?>
                </div>
              </div>

              <div class="row" style="padding-top: 20px; border-bottom: 1px solid lightgrey">
                <div class="col-lg-4" style="border-right: 1px solid lightgrey">
                  <h5
                  ><?php echo $data->nama ?></h5>
                  <br>
                  <p><?php echo $data->no_telp ?></p>
                  <p><?php echo $data->alamat ?></p>
                  <p><?php echo $data->kota ?>, <?php echo $data->kode_pos ?></p>
                </div>
                <div class="col-lg-8">
                  <?php if($data->status == 'Belum Bayar') { ?>
                  <ul class="fa-ul">
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $data->transaction_time ?></b>
                      <p>Pesanan dibuat</p>
                    </li>
                  </ul>
                  <?php } else if($data->status == 'Dibatalkan' && $data->settlement_time == NULL) { ?>
                    <ul class="fa-ul">
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $data->transaction_time ?></b>
                      <p>Pesanan dibuat</p>
                    </li>
                  </ul>
                  <?php } else if($data->status == 'Dibatalkan' && $data->settlement_time != NULL) { ?>
                    <ul class="fa-ul">
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $data->transaction_time ?></b>
                      <p>Pesanan dibuat</p>
                    </li>
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $waktu_dibatalkan ?></b>
                      <p>Pesanan dibatalkan</p>
                    </li>
                  </ul>
                  <?php } else if($data->status == 'Dikemas') { ?>
                  <ul class="fa-ul">
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $data->transaction_time ?></b>
                      <p>Pesanan Dibuat</p>
                    </li>
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $data->settlement_time ?></b>
                      <p>Pembayaran Dikonfirmasi.</p>
                    </li>
                  </ul>
                  <?php } else if($data->status == 'Dikirim') { ?>
                  <ul class="fa-ul">
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $data->transaction_time ?></b>
                      <p>Pesanan Dibuat</p>
                    </li>
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $data->settlement_time ?></b>
                      <p>Pembayaran Dikonfirmasi.</p>
                    </li>
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $p->tgl_dikirim ?></b>
                      <p>Pesanan Dikirimkan.</p>
                    </li>
                  </ul>
                <?php } else if($data->status == 'Selesai') { ?>
                  <ul class="fa-ul">
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $data->transaction_time ?></b>
                      <a>Pesanan Dibuat</a>
                    </li>
                    <br>
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $data->settlement_time ?></b>
                      <a>Pembayaran Dikonfirmasi</a>
                    </li>
                    <br>
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $p->tgl_dikirim ?></b>
                      <a>Pesanan Dikirimkan</a>
                    </li>
                    <br>
                    <li><i class="fa-li fa fa-circle text-primary"></i>
                      <b><?php echo $p->tgl_diterima ?></b>
                      <a>Pesanan Diterima</a>
                    </li>
                    <br>
                  </ul>
                <?php } ?>
                </div>
              </div>

              <?php foreach($item_pesanan as $list) { ?>
              <div class="row" style="padding-bottom: 20px; padding-top: 20px; background-color: #fafafa">
                <div class="col-lg-1">
                  <img class="img-thumbnail" src="<?php echo base_url('assets/uploads/produk/'). $list->gambar ?>" style="width: 150px">
                </div>
                <div class="col-lg-11">
                  <a href="<?php echo base_url('produk/index/'). $list->url_produk ?>" style="font-size: 16px"><?php echo $list->nama ?></a>
                  <div class="row">
                    <div class="col-lg-6">
                      <p>x <?php echo $list->quantity ?></p>
                    </div>
                    <div class="col-lg-6 text-right">
                      <a>Rp. <?php echo number_format($list->sub_total,0,",",".") ?></a>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>

              <div class="row" style="border-top: 1px solid lightgrey; padding-top: 30px">
                <div class="col-lg-12 text-right">
                  <p style="font-weight: 500">Subtotal: Rp. <?php echo number_format($data->grand_total,0,",",".") ?></p>
                  <p style="font-weight: 500">Ongkir: Rp. 0</p>
                  <p style="font-weight: 500">Metode Pembayaran: Bank Transfer</p>
                </div>
                <div class="col-lg-6">
                  <p style="font-weight: 600; font-size: 18px">Total Pesanan : Rp. <?php echo number_format($data->grand_total,0,",",".") ?></p>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->

<script>
function goBack() {
  window.history.back();
}
</script>
