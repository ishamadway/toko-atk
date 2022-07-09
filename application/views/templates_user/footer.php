<?php $kategori = $this->db->query("SELECT * FROM kategori")->result(); ?>

<!-- FOOTER -->
<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>LUM Store merupakan toko yang menyediakan kebutuhan Alat Tulis Kantor dengan mengedepankan kualitas dalam produknya.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>Jl. Kenangan NO. 12</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@gmail.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Kategori</h3>
								<ul class="footer-links">
									<?php foreach($kategori as $list) { ?>
									<li><a href="<?php echo base_url('kategori/index/'). $list->url ?>"><?php echo $list->kategori ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">Akun Saya</a></li>
									<li><a href="<?php echo base_url('keranjang') ?>">Lihat Keranjang</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright LUM store &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="<?php echo base_url('assets/user'); ?> /js/bootstrap.min.js"></script>
		<script src="<?php echo base_url('assets/user'); ?> /js/slick.min.js"></script>
		<script src="<?php echo base_url('assets/user'); ?> /js/nouislider.min.js"></script>
		<script src="<?php echo base_url('assets/user'); ?> /js/jquery.zoom.min.js"></script>
		<script src="<?php echo base_url('assets/user'); ?> /js/main.js"></script>

	</body>
</html>
