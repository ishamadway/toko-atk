		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Produk Baru</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav" id="produkBaru">
									<li class="active"><a data-toggle="tab" href="#tab1">Alat Tulis</a></li>
									<li><a data-toggle="tab" href="#tab2">Tinta</a></li>
									<li><a data-toggle="tab" href="#tab3">Produk Komputer & Otomatisasi Kantor</a></li>
									<li><a data-toggle="tab" href="#tab4">Berkas</a></li>
									<li><a data-toggle="tab" href="#tab5">Furnitur</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">

								<!-- tab1 -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">

										<?php foreach ($alat_tulis as $at) : ?>
										<!-- product -->
										<div class="product" style="height: 450px">
											<div class="product-img">
												<img src="<?php echo base_url('assets/uploads/produk/'). $at->gambar ?>" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo $at->kategori ?></p>
												<h3 class="product-name"><a href="<?php echo base_url('produk/index/'). $at->url_produk ?>"><?php echo $at->nama ?></a></h3>
												<h4 class="product-price">Rp. <?php echo number_format($at->harga,2,",",".") ?></h4>
												<?php if($at->avg_rating == '' || $at->avg_rating == NULL) { ?>
													<div class="product-rating">
														<i class="fa fa-star-o empty"></i>
														<i class="fa fa-star-o empty"></i>
														<i class="fa fa-star-o empty"></i>
														<i class="fa fa-star-o empty"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												<?php } else { ?>
												<div class="product-rating">
													<?php if($at->avg_rating == 1 || $at->avg_rating < 2) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($at->avg_rating == '2' || $at->avg_rating < 3) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($at->avg_rating == '3' || $at->avg_rating < 4) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($at->avg_rating == '4' || $at->avg_rating < 5) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<?php } else { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<?php } ?>
												</div>
												<?php } ?>
											</div>
										</div>
										<!-- /product -->
										<?php endforeach; ?>

									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab1 -->

								<!-- tab2 -->
								<div id="tab2" class="tab-pane">
									<div class="products-slick" data-nav="#slick-nav-2">

										<?php foreach ($tinta as $tnt) : ?>
										<!-- product -->
										<div class="product" style="height: 450px">
											<div class="product-img">
												<img src="<?php echo base_url('assets/uploads/produk/'). $tnt->gambar ?>" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo $tnt->kategori ?></p>
												<h3 class="product-name"><a href="<?php echo base_url('produk/index/'). $tnt->url_produk ?>"><?php echo $tnt->nama ?></a></h3>
												<h4 class="product-price">Rp. <?php echo number_format($tnt->harga,2,",",".") ?></h4>
												<?php if($tnt->avg_rating == '' || $tnt->avg_rating == NULL) { ?>
												<div class="product-rating">
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												</div>
												<?php } else { ?>
												<div class="product-rating">
													<?php if($tnt->avg_rating == 1 || $tnt->avg_rating < 2) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($tnt->avg_rating == '2' || $tnt->avg_rating < 3) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($tnt->avg_rating == '3' || $tnt->avg_rating < 4) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($tnt->avg_rating == '4' || $tnt->avg_rating < 5) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<?php } else { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<?php } ?>
												</div>
												<?php } ?>
											</div>
										</div>
										<!-- /product -->
										<?php endforeach; ?>

									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab2 -->

								<!-- tab3 -->
								<div id="tab3" class="tab-pane">
									<div class="products-slick" data-nav="#slick-nav-3">

										<?php foreach ($komputer as $komp) : ?>
										<!-- product -->
										<div class="product" style="height: 450px">
											<div class="product-img">
												<img src="<?php echo base_url('assets/uploads/produk/'). $komp->gambar ?>" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo $komp->kategori ?></p>
												<h3 class="product-name"><a href="<?php echo base_url('produk/index/'). $komp->url_produk ?>"><?php echo $komp->nama ?></a></h3>
												<h4 class="product-price">Rp. <?php echo number_format($komp->harga,2,",",".") ?></h4>
												<?php if($komp->avg_rating == '' || $komp->avg_rating == NULL) { ?>
												<div class="product-rating">
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												</div>
												<?php } else { ?>
												<div class="product-rating">
													<?php if($komp->avg_rating == 1 || $komp->avg_rating < 2) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($komp->avg_rating == '2' || $komp->avg_rating < 3) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($komp->avg_rating == '3' || $komp->avg_rating < 4) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($komp->avg_rating == '4' || $komp->avg_rating < 5) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<?php } else { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<?php } ?>
												</div>
												<?php } ?>
											</div>
										</div>
										<!-- /product -->
										<?php endforeach; ?>

									</div>
									<div id="slick-nav-3" class="products-slick-nav"></div>
								</div>
								<!-- /tab3 -->

								<!-- tab4 -->
								<div id="tab4" class="tab-pane">
									<div class="products-slick" data-nav="#slick-nav-4">

										<?php foreach ($berkas as $berkas) : ?>
										<!-- product -->
										<div class="product" style="height: 450px">
											<div class="product-img">
												<img src="<?php echo base_url('assets/uploads/produk/'). $berkas->gambar ?>" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo $berkas->kategori ?></p>
												<h3 class="product-name"><a href="<?php echo base_url('produk/index/'). $berkas->url_produk ?>"><?php echo $berkas->nama ?></a></h3>
												<h4 class="product-price">Rp. <?php echo number_format($berkas->harga,2,",",".") ?></h4>
												<?php if($berkas->avg_rating == '' || $berkas->avg_rating == NULL) { ?>
												<div class="product-rating">
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												</div>
												<?php } else { ?>
												<div class="product-rating">
													<?php if($berkas->avg_rating == 1 || $berkas->avg_rating < 2) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($berkas->avg_rating == '2' || $berkas->avg_rating < 3) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($berkas->avg_rating == '3' || $berkas->avg_rating < 4) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($berkas->avg_rating == '4' || $berkas->avg_rating < 5) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<?php } else { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<?php } ?>
												</div>
												<?php } ?>
											</div>
										</div>
										<!-- /product -->
										<?php endforeach; ?>

									</div>
									<div id="slick-nav-4" class="products-slick-nav"></div>
								</div>
								<!-- /tab4 -->

								<!-- tab5 -->
								<div id="tab5" class="tab-pane">
									<div class="products-slick" data-nav="#slick-nav-5">

										<?php foreach ($furnitur as $furnitur) : ?>
										<!-- product -->
										<div class="product" style="height: 450px">
											<div class="product-img">
												<img src="<?php echo base_url('assets/uploads/produk/'). $furnitur->gambar ?>" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo $furnitur->kategori ?></p>
												<h3 class="product-name"><a href="<?php echo base_url('produk/index/'). $furnitur->url_produk ?>"><?php echo $furnitur->nama ?></a></h3>
												<h4 class="product-price">Rp. <?php echo number_format($furnitur->harga,2,",",".") ?></h4>
												<?php if($furnitur->avg_rating == '' || $furnitur->avg_rating == NULL) { ?>
												<div class="product-rating">
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												</div>
												<?php } else { ?>
												<div class="product-rating">
													<?php if($furnitur->avg_rating == 1 || $furnitur->avg_rating < 2) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($furnitur->avg_rating == '2' || $furnitur->avg_rating < 3) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($furnitur->avg_rating == '3' || $furnitur->avg_rating < 4) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<i class="fa fa-star-o empty"></i>
												<?php } else if($furnitur->avg_rating == '4' || $furnitur->avg_rating < 5) { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
													<?php } else { ?>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<?php } ?>
												</div>
												<?php } ?>
											</div>
										</div>
										<!-- /product -->
										<?php endforeach; ?>

									</div>
									<div id="slick-nav-5" class="products-slick-nav"></div>
								</div>
								<!-- /tab5 -->

							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<h2 class="text-uppercase">Gratis Ongkir SEJABODETABEK</h2>
							<p>Belanja sekarang juga!</p>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Produk Terlaris</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-6">

										<?php foreach ($top_produk as $list) : ?>
											<!-- product -->
											<div class="product" style="height: 450px">
												<div class="product-img">
													<img src="<?php echo base_url('assets/uploads/produk/'). $list->gambar ?>" alt="">
													<div class="product-label">
														<span class="new">TOP</span>
													</div>
												</div>
												<div class="product-body">
													<p class="product-category"><?php echo $list->kategori ?></p>
													<h3 class="product-name"><a href="<?php echo base_url('produk/index/'). $list->url_produk ?>"><?php echo $list->nama ?></a></h3>
													<h4 class="product-price">Rp. <?php echo number_format($list->harga,2,",",".") ?></h4>
													<?php if($list->avg_rating == '' || $list->avg_rating == NULL) { ?>
														<div class="product-rating">
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													<?php } else { ?>
													<div class="product-rating">
														<?php if($list->avg_rating == 1 || $list->avg_rating < 2) { ?>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
														<i class="fa fa-star-o empty"></i>
														<i class="fa fa-star-o empty"></i>
														<i class="fa fa-star-o empty"></i>
													<?php } else if($list->avg_rating == '2' || $list->avg_rating < 3) { ?>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
														<i class="fa fa-star-o empty"></i>
														<i class="fa fa-star-o empty"></i>
													<?php } else if($list->avg_rating == '3' || $list->avg_rating < 4) { ?>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
														<i class="fa fa-star-o empty"></i>
													<?php } else if($list->avg_rating == '4' || $list->avg_rating < 5) { ?>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
														<?php } else { ?>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<?php } ?>
													</div>
													<?php } ?>
													<div class="product-btns">
														<small>Terjual <?php echo $list->terjual ?></small>
													</div>
												</div>
											</div>
											<!-- /product -->
											<?php endforeach; ?>

									</div>
									<div id="slick-nav-6" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

					<div class="clearfix visible-sm visible-xs"></div>

		<script>
		$(document).ready(function(){
		    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		        localStorage.setItem('activeTab', $(e.target).attr('href'));
		    });
		    var activeTab = localStorage.getItem('activeTab');
		    if(activeTab){
		        $('#produkBaru a[href="' + activeTab + '"]').tab('show');
		    }
		});
		</script>
