		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Checkout</li>
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

					<form id="payment-form" method="post" action="<?= site_url() ?>/snap/finish">
						<input type="hidden" name="result_type" id="result-type" value="">
						<input type="hidden" name="result_data" id="result-data" value="">

						<div class="col-md-7">
							<!-- Shiping Details -->
							<div class="shiping-details">
								<div class="section-title">
									<h3 class="title">Alamat Pengiriman</h3>
								</div>
								<div class="order-notes">
									<textarea class="input" name="alamat" placeholder="Alamat Pengiriman" readonly><?php echo $this->session->userdata('alamat') ?>, Kota <?php echo $this->session->userdata('kota') ?>, <?php echo $this->session->userdata('kode_pos') ?></textarea>
								</div>
							</div>
							<!-- /Shiping Details -->

							<div class="section-title">
								<h3 class="title">Catatan</h3>
							</div>
							<!-- Order notes -->
							<div class="order-notes">
								<textarea class="input" name="catatan" placeholder="Catatan Pesanan"></textarea>
							</div>
							<!-- /Order notes -->
						</div>

						<!-- Order Details -->
						<div class="col-md-5 order-details">
							<div class="section-title text-center">
								<h3 class="title">Pesanan Anda</h3>
							</div>
							<div class="order-summary">
								<div class="order-col">
									<div><strong>PRODUK</strong></div>
									<div><strong>TOTAL</strong></div>
								</div>
								<?php foreach ($this->cart->contents() as $items) : ?>
									<div class="order-products">
										<div class="order-col">
											<div><b><?php echo $items['qty']; ?>x</b> <?php echo $items['name']; ?></div>
											<div>Rp. <?php echo number_format($items['price'], 0, ",", "."); ?></div>
										</div>
									</div>
								<?php endforeach; ?>
								<div style="padding-top: 20px; padding-bottom: 20px">
									<select class="form-control" name="id_ekspedisi" required>
										<option value="" selected>Pilih Jasa Kirim</option>
										<?php foreach ($ekspedisi as $list) { ?>
											<option value="<?php echo $list->id_ekspedisi ?>"><?php echo $list->nama_ekspedisi ?> - <?php echo $list->jenis_ekspedisi ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="order-col">
									<div>Ongkos Pengiriman</div>
									<div><strong>GRATIS</strong></div>
								</div>
								<div class="order-col">
									<div><strong>TOTAL</strong></div>
									<div><strong class="order-total">Rp. <?php echo number_format($this->cart->total(), 0, ",", "."); ?></strong></div>
								</div>
							</div>

							<button type="submit" id="pay-button" class="primary-btn order-submit" style="width: 100%">Buat Pesanan</button>
						</div>
						<!-- /Order Details -->

					</form>

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<script type="text/javascript">
			$('#pay-button').click(function(event) {
				event.preventDefault();

				$.ajax({
					url: '<?= site_url() ?>/snap/token',
					cache: false,

					success: function(data) {
						//location = data;

						console.log('token = ' + data);

						var resultType = document.getElementById('result-type');
						var resultData = document.getElementById('result-data');

						function changeResult(type, data) {
							$("#result-type").val(type);
							$("#result-data").val(JSON.stringify(data));
							//resultType.innerHTML = type;
							//resultData.innerHTML = JSON.stringify(data);
						}

						snap.pay(data, {

							onSuccess: function(result) {
								changeResult('success', result);
								console.log(result.status_message);
								console.log(result);
								$("#payment-form").submit();
							},
							onPending: function(result) {
								changeResult('pending', result);
								console.log(result.status_message);
								$("#payment-form").submit();
							},
							onError: function(result) {
								changeResult('error', result);
								console.log(result.status_message);
								$("#payment-form").submit();
							}
						});
					}
				});
			});
		</script>