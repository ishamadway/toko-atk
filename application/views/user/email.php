		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Email</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">Akun Saya</a></li>
                            <li class="active">Email</li>
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
                    <div class="col-md-12">
                    <div class="header">
                        <h4>Ubah Email</h4>
                        <p>Untuk mengubah email, silahkan masukkan password akun Anda.</p>
                    </div>

                    <hr>

                    <div style="padding-left: 200px; padding-right: 200px; padding-top: 20px">
                        <?php foreach($pembeli as $data) { ?>
                        <form method="POST" action=<?php echo base_url('akun_saya/check_password_for_email') ?>>

                            <input type="hidden" name="id_pembeli" value="<?php echo $data->id ?>">

                            <div class="form-group row" style="padding-bottom: 20px">
                                <label class="col-sm-2 col-form-label" style="font-weight: 400">Email Saat Ini</label>
                                <div class="col-sm-10">
                                    <?php echo preg_replace('/(?<=.[a-zA-Z0-9]).(?=.*@)/u','*',$data->email); ?>
                                </div>
                            </div>

                            <div class="form-group row" style="padding-bottom: 20px">
                                <label class="col-sm-2 col-form-label" style="font-weight: 400">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="old_password" class="form-control">
                                    <?php echo form_error('old_password','<span class="error">', '</span>'); ?>
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