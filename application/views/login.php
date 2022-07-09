		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<?php echo $this->session->flashdata('sukses') ?>
						<?php echo $this->session->flashdata('gagal') ?>
						<div class="panel panel-login">
							<div class="panel-heading">
								<div class="row">
										<a href="#" class="active" id="login-form-link">Masuk</a>
								</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">

										<form id="login-form" action="<?php echo base_url('auth/masuk') ?>" method="post" role="form" style="display: block;">
											<div class="form-group">
												<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" required>
											</div>
											<div class="form-group">
												<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-sm-6 col-sm-offset-3">
													<button type="submit" tabindex="4" class="form-control btn btn-register">Masuk</button>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-lg-12">
														<div class="text-center">
															<span href="#" tabindex="5" class="forgot-password">Belum punya akun? <a href="<?php echo base_url('auth/register') ?>">Daftar</a></span>
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
