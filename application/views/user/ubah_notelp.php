		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Ubah No. Telepon</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">Akun Saya</a></li>
                            <li><a href="#">No. Telepon</a></li>
                            <li class="active">Ubah No. Telepon</li>
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
                    <div class="col-md-12">
                    <div class="header">
                        <h4>Ubah No. Telepon</h4>
                        <p>Silahkan masukkan Nomor Telepon baru pada akun Anda.</p>
                    </div>

                    <hr>

                    <div style="padding-left: 200px; padding-right: 200px; padding-top: 20px">
                        <?php foreach($pembeli as $data) { ?>
                        <form method="POST" action=<?php echo base_url('akun_saya/ubah_notelp_aksi/').$this->session->userdata('code_access'); ?>>

                            <input type="hidden" name="id_pembeli" value="<?php echo $data->id ?>">

                            <div class="form-group row" style="padding-bottom: 20px">
                                <label class="col-sm-2 col-form-label" style="font-weight: 400">Nomor telepon</label>
                                <div class="col-sm-10">
                                    <input type="number" name="no_telp" class="form-control">
                                    <?php echo form_error('no_telp','<span class="error">', '</span>'); ?>
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
                        <?php } ?>
                    </div>

                </div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->