
<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">

      <!-- section title -->
      <div class="col-md-12" style="padding-left: 150px; padding-right: 150px">
        <?php echo $this->session->flashdata('sukses') ?>
        <?php echo $this->session->flashdata('gagal') ?>
        <div class="section-title">
          <h3 class="title">Pesanan Saya</h3>
          <div class="section-nav">
            <ul class="section-tab-nav tab-nav" id="myTab">
              <li class="active"><a data-toggle="tab" href="#tab1">Belum Bayar</a></li>
              <li><a data-toggle="tab" href="#tab2">Dikemas</a></li>
              <li><a data-toggle="tab" href="#tab3">Dikirim</a></li>
              <li><a data-toggle="tab" href="#tab4">Selesai</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /section title -->

      <!-- Order Tab -->
      <div class="col-md-12" style="padding-left: 150px; padding-right: 150px">
        <div class="products-tabs">

              <!-- tab1 -->
              <div id="tab1" class="tab-pane active">
                <?php if(count($belum_bayar) == NULL) { ?>
                  <div class="product text-center" style="padding: 20px;">
                    <h5 style="padding-top: 107px; padding-bottom: 107px">Tidak Ada Pesanan!</h5>
                  </div>
                <?php } else { ?>

                <?php foreach($belum_bayar as $a): ?>
                  <?php
                  $order_id = $a->order_id;
                  $item_pesanan = $this->db->query("SELECT * FROM item_pesanan ip, produk pr
                     WHERE order_id='$order_id' AND ip.id_produk=pr.id")->result();
                  $batas_pembayaran = date('Y-m-d H:i', strtotime($a->transaction_time . ' +1 day'));
                  ?>

              <div class="panel panel-default">
                <div class="panel-heading">No. Pesanan: <?php echo $a->order_id ?></div>
                  <div class="panel-body">
                  <!-- Item Pesanan -->
                  <?php foreach($item_pesanan as $list) : ?>
                  <div class="row">
                    <div class="col-lg-2">
                      <img src="<?php echo base_url('assets/uploads/produk/'). $list->gambar ?>" class="img-thumbnail" style="height: 100px; width: 100px">
                    </div>
                    <div class="col-lg-9">
                      <p style="font-weight: 500; font-size: 16px"><?php echo $list->nama ?></p>
                      <p>Subtotal: Rp. <?php echo number_format($list->sub_total,0,",",".") ?></p>
                      <p>x<?php echo $list->quantity ?><p>
                    </div>
                  </div>
                  <hr>
                  <?php endforeach; ?>
                  <!-- /Item Pesanan -->

                  <div>
                    <div class="text-right" style="padding-bottom: 20px">
                      <p style="font-size: 16px">Total Pesanan: <a style="font-weight: 500; font-size: 24px">Rp. <?php echo number_format($a->grand_total,0,",",".") ?></a></p>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <p>Bayar Sebelum <a style="font-weight: 600"><?php echo $batas_pembayaran ?></a></p>
                      </div>
                      <div class="col-lg-6 text-right">
                        <a href="#" data-toggle="modal" data-target="#bayar<?php echo $a->order_id ?>" class="btn btn-primary">Bayar Sekarang</a>
                        <a href="<?php echo base_url('pesanan_saya/detail/'). $a->order_id ?>" class="btn btn-default">Detail</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                <!-- Modal Bayar -->
                <div class="modal fade bd-example-modal-lg" id="bayar<?php echo $a->order_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pembayaran</h5>
                      </div>
                      <div class="modal-body" style="padding-left: 100px;padding-right: 100px;padding-bottom: 40px">
                        <div class="row" style="padding-top: 20px">
                          <div class="col-lg-3">
                            <p>Total Pembayaran</p>
                          </div>
                          <div class="col-lg-9 text-right">
                            <a style="font-weight: 500; font-size: 18px">Rp. <?php echo number_format($a->grand_total,0,",",".") ?></a>
                          </div>
                        </div>

                        <hr>

                        <div>
                          <?php if($a->bank == 'bca') { ?>
                          <img src="<?php echo base_url('assets/user/img/bca.png') ?>" style="width: 80px">
                          <br>
                          <br>
                          <?php } else if ($a->bank == 'bni') { ?>
                          <img src="<?php echo base_url('assets/user/img/bni.png') ?>" style="width: 80px">
                          <br>
                          <br>
                          <?php } else { ?>
                          <img src="<?php echo base_url('assets/user/img/bri.png') ?>" style="width: 80px">
                          <br>
                          <br>
                          <?php } ?>
                          <small>No. Rekening:</small>
                          <p style="font-weight: 600; font-size: 24px; color: #0048ff"><?php echo $a->va_number ?></p>
                          <br>
                          <p>Bayar Sebelum <a style="font-weight: 600"><?php echo $batas_pembayaran ?></a>, atau pesanan akan otomatis dibatalkan oleh sistem.</p>
                          <br>
                          <a href="<?php echo $a->pdf_url ?>" target="_blank">Klik disini untuk <b>Panduan Pembayaran</b></a>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="<?php echo base_url('pesanan_saya/trial_bayar') ?>">
                        <input type="hidden" name="order_id" value="<?php echo $a->order_id ?>">
                        <button type="submit" class="btn btn-primary">Trial Bayar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Modal Bayar -->

                <?php endforeach; ?>
                <?php } ?>
              </div>
              <!-- /tab1 -->

            <!-- tab2 -->
            <div id="tab2" class="tab-pane">
              <?php if(count($dikemas) == NULL) { ?>
                <div class="product text-center" style="padding: 20px;">
                  <h5 style="padding-top: 107px; padding-bottom: 107px">Tidak Ada Pesanan!</h5>
                </div>
              <?php } else { ?>

              <?php foreach($dikemas as $b): ?>
                <?php
                $order_id = $b->order_id;
                $item_pesanan = $this->db->query("SELECT * FROM item_pesanan ip, produk pr
                   WHERE order_id='$order_id' AND ip.id_produk=pr.id")->result();
                $dikirim_sebelum = date('Y-m-d', strtotime($b->settlement_time . ' +3 day'));
                ?>

            <div class="panel panel-warning">
              <div class="panel-heading">No. Pesanan: <?php echo $b->order_id ?></div>
                <div class="panel-body">
                <!-- Item Pesanan -->
                <?php foreach($item_pesanan as $list) : ?>
                <div class="row">
                  <div class="col-lg-2">
                    <img src="<?php echo base_url('assets/uploads/produk/'). $list->gambar ?>" class="img-thumbnail" style="height: 100px; width: 100px">
                  </div>
                  <div class="col-lg-9">
                    <p style="font-weight: 500; font-size: 16px"><?php echo $list->nama ?></p>
                    <p>Subtotal: Rp. <?php echo number_format($list->sub_total,0,",",".") ?></p>
                    <p>x<?php echo $list->quantity ?><p>
                  </div>
                </div>
                <hr>
                <?php endforeach; ?>
                <!-- /Item Pesanan -->

                <div>
                  <div class="text-right" style="padding-bottom: 20px">
                    <p style="font-size: 16px">Total Pesanan: <a style="font-weight: 500; font-size: 24px">Rp. <?php echo number_format($b->grand_total,0,",",".") ?></a></p>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <p>Produk akan dikirimkan sebelum <a style="font-weight: 600"><?php echo $dikirim_sebelum ?></a></p>
                    </div>
                    <div class="col-lg-6 text-right">
                      <a href="<?php echo base_url('pesanan_saya/detail/'). $b->order_id ?>" class="btn btn-default">Detail</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php endforeach; ?>
            <?php } ?>
            </div>
            <!-- /tab2 -->

            <!-- tab3 -->
            <div id="tab3" class="tab-pane">
              <?php if(count($dikirim) == NULL) { ?>
                <div class="product text-center" style="padding: 20px;">
                  <h5 style="padding-top: 107px; padding-bottom: 107px">Tidak Ada Pesanan!</h5>
                </div>
              <?php } else { ?>

              <?php foreach($dikirim as $c): ?>

                <?php
                $order_id = $c->order_id;
                $item_pesanan = $this->db->query("SELECT * FROM item_pesanan ip, produk pr
                   WHERE order_id='$order_id' AND ip.id_produk=pr.id")->result();
                ?>

            <div class="panel panel-info">
              <div class="panel-heading">No. Pesanan: <?php echo $c->order_id ?></div>
                <div class="panel-body">
                <!-- Item Pesanan -->
                <?php foreach($item_pesanan as $list) : ?>
                <div class="row">
                  <div class="col-lg-2">
                    <img src="<?php echo base_url('assets/uploads/produk/'). $list->gambar ?>" class="img-thumbnail" style="height: 100px; width: 100px">
                  </div>
                  <div class="col-lg-9">
                    <p style="font-weight: 500; font-size: 16px"><?php echo $list->nama ?></p>
                    <p>Subtotal: Rp. <?php echo number_format($list->sub_total,0,",",".") ?></p>
                    <p>x<?php echo $list->quantity ?><p>
                  </div>
                </div>
                <hr>
                <?php endforeach; ?>
                <!-- /Item Pesanan -->

                <?php
                    $pengiriman = $this->db->query("SELECT * FROM pengiriman pn, transaksi tr
                      WHERE pn.order_id=tr.order_id AND pn.order_id='$order_id'")->result();
                    foreach($pengiriman as $sh){}

                    $estimated_time = date('Y-m-d', strtotime($sh->tgl_dikirim . ' +2 day'));

                    $estimated_time_real = date('Y-m-d', strtotime($sh->tgl_dikirim . ' +1 day'));
                    $expired_time = strtotime($estimated_time_real);
                    date_default_timezone_set('Asia/Jakarta');
                    $time_now = strtotime(date('Y-m-d H:i:s'));
                    $date_diff =  $time_now - $expired_time ;
                    $diff = floor($date_diff/(1000*60*60*24));
                ?>

                <div>
                  <div class="text-right" style="padding-bottom: 20px">
                    <p style="font-size: 16px">Total Pesanan: <a style="font-weight: 500; font-size: 24px">Rp. <?php echo number_format($c->grand_total,0,",",".") ?></a></p>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <p>Estimasi barang sampai <a><b><?php echo $estimated_time ?></b></a></p>
                    </div>
                    <div class="col-lg-6 text-right">
                      <?php if($diff >= 0){ ?>
                      <a href="#" data-toggle="modal" data-target="#selesai<?php echo $c->order_id ?>" class="btn btn-primary">Terima Pesanan</a>
                      <?php } else { ?>
                      <a href="#"<?php echo $c->order_id ?>" class="btn btn-primary disabled">Terima Pesanan</a>
                      <?php } ?>
                      <a href="<?php echo base_url('pesanan_saya/detail/'). $c->order_id ?>" class="btn btn-default">Detail</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <!-- Modal Selesai -->
              <form method="post" action="<?php echo base_url('pesanan_saya/selesaikan_pesanan') ?>">
              <div class="modal fade" id="selesai<?php echo $c->order_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Terima Pesanan</h5>
                    </div>
                    <div class="modal-body">
                      Apakah anda yakin ingin selesaikan pesanan?
                      <input type="hidden" name="order_id" value="<?php echo $c->order_id ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                      <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                  </div>
                </div>
              </div>
              </form>
              <!-- /Modal Selesai -->

              <?php endforeach; ?>
              <?php } ?>
            </div>
            <!-- /tab3 -->

            <!-- tab4 -->
            <div id="tab4" class="tab-pane">
              <?php if(count($selesai) == NULL) { ?>
                <div class="product text-center" style="padding: 20px;">
                  <h5 style="padding-top: 107px; padding-bottom: 107px">Tidak Ada Pesanan!</h5>
                </div>
              <?php } else { ?>

              <?php foreach($selesai as $d): ?>

                <?php
                $order_id = $d->order_id;
                $item_pesanan = $this->db->query("SELECT * FROM item_pesanan ip, produk pr
                   WHERE order_id='$order_id' AND ip.id_produk=pr.id")->result();
                $ulasan = $this->db->query("SELECT * FROM ulasan ul, item_pesanan ip, produk pr
                   WHERE order_id='$order_id' AND ip.id_produk=pr.id AND ul.id_produk=pr.id")->result();
                ?>

            <div class="panel panel-primary">
              <div class="panel-heading">No. Pesanan: <?php echo $d->order_id ?></div>
                <div class="panel-body">
                <!-- Item Pesanan -->
                <?php foreach($item_pesanan as $list) : ?>
                <div class="row">
                  <div class="col-lg-2">
                    <img src="<?php echo base_url('assets/uploads/produk/'). $list->gambar ?>" class="img-thumbnail" style="height: 100px; width: 100px">
                  </div>
                  <div class="col-lg-9">
                    <p style="font-weight: 500; font-size: 16px"><?php echo $list->nama ?></p>
                    <p>Subtotal: Rp. <?php echo number_format($list->sub_total,0,",",".") ?></p>
                    <p>x<?php echo $list->quantity ?><p>
                  </div>
                </div>
                <hr>
                <?php endforeach; ?>
                <!-- /Item Pesanan -->

                <div>
                  <div class="text-right" style="padding-bottom: 20px">
                    <p style="font-size: 16px">Total Pesanan: <a style="font-weight: 500; font-size: 24px">Rp. <?php echo number_format($d->grand_total,0,",",".") ?></a></p>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <?php if(!empty($ulasan)) { ?>
                      <p>Terimakasih atas penilaian anda!</p>
                      <?php } else { ?>
                      <p>Produk telah sampai, silahkan nilai produk</p>
                      <?php } ?>
                    </div>
                    <div class="col-lg-6 text-right">
                      <?php if(!empty($ulasan)) { ?>
                      <a href="#" class="btn btn-default disabled">Telah Dinilai</a>
                      <?php } else { ?>
                      <a href="<?php echo base_url('pesanan_saya/penilaian/'). $d->order_id ?>" class="btn btn-primary">Beri Nilai</a>
                      <?php } ?>
                      <a href="<?php echo base_url('pesanan_saya/detail/'). $d->order_id ?>" class="btn btn-default">Detail</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <?php endforeach; ?>
              <?php } ?>
            </div>
            <!-- /tab4 -->

        </div>
      </div>
      <!-- /Order tab -->

    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->

<script>
$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>
