<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
                <a href="#" class="active" id="login-form-link">Daftar</a>
            </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">

                <form id="login-form" action="<?php echo base_url('auth/daftar') ?>" method="post" role="form" style="display: block;">
                  <div class="form-group">
                    <input type="text" name="nama" tabindex="1" class="form-control" placeholder="*Nama Lengkap" required>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" tabindex="1" class="form-control" placeholder="*Email" required>
                  </div>
                  <div class="form-group">
                    <input type="number" name="no_telp" tabindex="1" class="form-control" placeholder="*No. Telp" required>
                  </div>
                  <div class="form-group">
                    <input type="text" name="alamat" tabindex="1" class="form-control" placeholder="*Alamat Rumah" required>
                  </div>
                  <div class="form-group">
                    <input type="text" name="kota" tabindex="1" class="form-control" placeholder="*Kota" required>
                  </div>
                  <div class="form-group">
                    <input type="number" name="kode_pos" tabindex="1" class="form-control" placeholder="*Kode Pos" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" tabindex="2" class="form-control" placeholder="*Password" required>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <button type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register">Daftar</button>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center">
                          <span href="#" tabindex="5" class="forgot-password">Sudah punya akun? <a href="<?php echo base_url('auth/login') ?>">Masuk</a></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>

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
</div>
