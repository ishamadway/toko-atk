<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row" style="padding-left: 150px; padding-right: 150px; padding-bottom: 20px">
      <div class="row">
        <div class="col-lg-6">
          <h2>Beri Nilai</h2>
        </div>
        <div class="col-lg-6 text-right">
          <a href="<?php echo base_url('pesanan_saya') ?>" style="text-decoration: underline">Beri nilai lain kali</a>
        </div>
      </div>
      <hr>
      <div id="review-form">
        <form class="review-form" method="post" action="<?php echo base_url('pesanan_saya/beri_nilai') ?>">
          <?php $i = 0;
          foreach ($pesanan as $row) { ?>
            <div>
              <div class="row" style="padding-bottom: 20px">
                <div class="col-lg-2">
                  <img src="<?php echo base_url('assets/uploads/produk/') . $row->gambar ?>" class="img-thumbnail" style="height: 100px; width: 100px">
                </div>
                <div class="col-lg-9">
                  <p style="font-weight: 500; font-size: 16px"><?php echo $row->nama ?></p>
                  <p>Subtotal: Rp. <?php echo number_format($row->sub_total, 0, ",", ".") ?></p>
                  <p>x<?php echo $row->quantity ?>
                  <p>
                </div>
              </div>
              <input class="input" type="hidden" name="id_produk[<?php echo $i ?>]" value="<?php echo $row->id_produk ?>">
              <input class="input" type="hidden" name="id_user" value="<?php echo $row->id_pembeli ?>">
              <input class="input" type="hidden" name="order_id" value="<?php echo $row->order_id ?>">
              <textarea class="input" name="komentar[<?php echo $i ?>]" placeholder="Your Review"></textarea>
              <div class="input-rating">
                <span>Your Rating: </span>
                <div class="stars">
                  <input id="star5<?php echo $i ?>" name="bintang[<?php echo $i ?>]" value="5" type="radio"><label for="star5<?php echo $i ?>"></label>
                  <input id="star4<?php echo $i ?>" name="bintang[<?php echo $i ?>]" value="4" type="radio"><label for="star4<?php echo $i ?>"></label>
                  <input id="star3<?php echo $i ?>" name="bintang[<?php echo $i ?>]" value="3" type="radio"><label for="star3<?php echo $i ?>"></label>
                  <input id="star2<?php echo $i ?>" name="bintang[<?php echo $i ?>]" value="2" type="radio"><label for="star2<?php echo $i ?>"></label>
                  <input id="star1<?php echo $i ?>" name="bintang[<?php echo $i ?>]" value="1" type="radio"><label for="star1<?php echo $i ?>"></label>
                </div>
              </div>
              <hr>
            </div>
          <?php $i++;
          } ?>
          <button type="submit" class="primary-btn">Submit</button>
        </form>
      </div>
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->