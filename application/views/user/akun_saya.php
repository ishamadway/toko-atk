<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <div class="col-md-12">
        <h3 class="breadcrumb-header">Akun Saya</h3>
        <ul class="breadcrumb-tree">
          <li><a href="<?php echo base_url('homepage') ?>">Home</a></li>
          <li class="active">Akun Saya</li>
        </ul>
      </div>
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <?php echo $this->session->flashdata('sukses') ?>
      <?php echo $this->session->flashdata('gagal') ?>

      <ul class="nav nav-tabs nav-justified" id="profile">
        <li class="active"><a data-toggle="tab" href="#tab1">Profil Saya</a></li>
        <li><a data-toggle="tab" href="#tab2">Ubah Password</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">

        <div class="tab-pane active" id="tab1">
          <div style="padding: 40px">

            <div class="header">
              <h4>Profil Saya</h4>
              <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun.</p>
            </div>

            <hr>

            <form method="POST" action="<?php echo base_url('akun_saya/ubah_profil') ?>" enctype="multipart/form-data">
            <div class="row" style="padding-top: 20px">

            <?php foreach($pembeli as $data) { ?>

              <div class="col-md-9" style="padding-right: 20px; border-right: 1px solid lightgrey">
                <div class="form-group row" style="padding-bottom: 20px">
                  <label class="col-sm-2 col-form-label" style="font-weight: 400">Nama Lengkap</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id" value="<?php echo $data->id ?>">
                    <input type="text" name="nama" value="<?php echo $data->nama ?>" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row" style="padding-bottom: 20px">
                  <label class="col-sm-2 col-form-label" style="font-weight: 400">Email</label>
                  <div class="col-sm-10">
                    <?php echo preg_replace('/(?<=.[a-zA-Z0-9]).(?=.*@)/u','*',$data->email); ?>
                    <a style="text-decoration: underline" href="<?php echo base_url('akun_saya/email') ?>">Ubah</a>
                  </div>
                </div>
                <div class="form-group row" style="padding-bottom: 20px">
                  <label class="col-sm-2 col-form-label" style="font-weight: 400">Nomor Telepon</label>
                  <div class="col-sm-10">
                    <?php echo preg_replace('/.(?=.*[0-9][0-9])/','*',$data->no_telp); ?>
                    <a style="text-decoration: underline" href="<?php echo base_url('akun_saya/no_telp') ?>">Ubah</a>
                  </div>
                </div>
                <div class="form-group row" style="padding-bottom: 20px">
                  <label class="col-sm-2 col-form-label" style="font-weight: 400">Alamat</label>
                  <div class="col-sm-10">
                    <textarea name="alamat" class="form-control" required><?php echo $data->alamat ?></textarea>
                  </div>
                </div>
                <div class="form-group row" style="padding-bottom: 20px">
                  <label class="col-sm-2 col-form-label" style="font-weight: 400">Kota</label>
                  <div class="col-sm-10">
                    <input type="text" name="kota" value="<?php echo $data->kota ?>" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row" style="padding-bottom: 20px">
                  <label class="col-sm-2 col-form-label" style="font-weight: 400">Kode Pos</label>
                  <div class="col-sm-10">
                    <input type="number" name="kode_pos" value="<?php echo $data->kode_pos ?>" class="form-control" required>
                  </div>
                </div>
              </div>

              <div class="col-md-3 text-center" style="padding-left: 20px">
                <img id="image_upload_preview" src="<?php echo base_url('assets/uploads/user/').$data->foto ?>" alt="Foto Profil" class="img-circle"
                  style="width: 150px; height: 150px">
                <div style="padding-top: 20px">
                  <label>Foto Profil</label>
                  <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <small>Max: 2mb</small>
              </div>

            <?php } ?>

            </div>
            
            <div class="form-group">
              <div class="row">
                <div class="col-sm-3">
                  <button type="submit" tabindex="4" class="form-control btn btn-register">Simpan</button>
                </div>
              </div>
            </div>
            </form>

            <hr>

          </div>
        </div>

        <div class="tab-pane" id="tab2">
          <div style="padding: 40px">

            <div class="header">
              <h4>Ubah Password</h4>
              <p>Untuk keamanan akun Anda, mohon untuk tidak menyebarkan password Anda ke orang lain.</p>
            </div>
            <hr>

            <div style="padding-left: 200px; padding-right: 200px; padding-top: 20px">
              <form method="POST" action=<?php echo base_url('akun_saya/ubah_password') ?>>

                <input type="hidden" name="id_pembeli" value="<?php echo $this->session->userdata('id') ?>">
                <div class="form-group row" style="padding-bottom: 20px">
                  <label class="col-sm-2 col-form-label" style="font-weight: 400">Password Saat Ini</label>
                  <div class="col-sm-10">
                    <input type="password" name="old_password" class="form-control">
                    <?php echo form_error('old_password','<span class="error">', '</span>'); ?>
                  </div>
                </div>

                <div class="form-group row" style="padding-bottom: 20px">
                  <label class="col-sm-2 col-form-label" style="font-weight: 400">Password baru</label>
                  <div class="col-sm-10">
                    <input type="password" name="new_password" class="form-control">
                    <?php echo form_error('new_password','<span class="error">', '</span>'); ?>
                  </div>
                </div>

                <div class="form-group row" style="padding-bottom: 20px">
                  <label class="col-sm-2 col-form-label" style="font-weight: 400">Konfirmasi Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="new_password2" class="form-control">
                    <?php echo form_error('new_password2','<span class="error">', '</span>'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                    <button type="submit" tabindex="4" class="form-control btn btn-register">Konfirmasi</button>
                    </div>
                  </div>
                </div>

              </form>
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
  $(document).ready(function(){
      $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
          localStorage.setItem('activeTab', $(e.target).attr('href'));
      });
      var activeTab = localStorage.getItem('activeTab');
      if(activeTab){
          $('#profile a[href="' + activeTab + '"]').tab('show');
      }
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#image_upload_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#foto").change(function () {
    readURL(this);
  });
</script>
