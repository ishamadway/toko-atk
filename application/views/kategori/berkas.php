<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb-tree">
          <li><a href="<?php echo base_url('homepage') ?>">Home</a></li>
          <li><a href="#">Kategori</a></li>
          <li class="active">Berkas</li>
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
      <!-- ASIDE -->
      <div id="aside" class="col-md-3">
        <!-- aside Widget -->
        <h2>Berkas</h2>
        <hr>
        <div class="aside">
          <h3 class="aside-title">Brand</h3>
          <div class="checkbox-filter">
            <?php $id = 1; $for = 1;
            foreach($merek->result_array() as $merek) { ?>
            <div class="input-checkbox">
              <input type="checkbox" class="common_selector brand" value="<?php echo $merek['merek']; ?>" id="category-<?php echo $id++; ?>">
              <label for="category-<?php echo $for++; ?>">
                <span></span>
                <?php echo $merek['merek']; ?>
              </label>
            </div>
            <?php } ?>
          </div>
        </div>
        <!-- /aside Widget -->

        <!-- aside Widget -->
        <div class="aside">
          <h3 class="aside-title">Price</h3>
          <input type="hidden" id="hidden_minimum_price" value="5000" />
          <input type="hidden" id="hidden_maximum_price" value="1000000" />
          <p id="price_show">5000 - 1000000</p>
          <div id="price_range" style="margin-left: 10px">
          </div>
        </div>
        <!-- /aside Widget -->

        <?php if(count($produk) == NULL) { ?>
        <?php } else { ?>
        <!-- aside Widget -->
        <div class="aside">
          <h3 class="aside-title">Top selling</h3>
          <?php foreach($produk as $top): ?>
          <div class="product-widget">
            <div class="product-img">
              <img src="<?php echo base_url('assets/uploads/produk/'). $top->gambar ?>" alt="">
            </div>
            <div class="product-body">
              <p class="product-category"><?php echo $top->kategori ?></p>
              <h3 class="product-name"><a href="<?php echo base_url('produk/index/'). $top->url_produk ?>"><?php echo $top->nama ?></a></h3>
              <h4 class="product-price">Rp. <?php echo number_format($top->harga,2,",",".") ?></h4>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
        <!-- /aside Widget -->
        <?php } ?>
      </div>
      <!-- /ASIDE -->

      <!-- STORE -->
      <div id="store" class="col-md-9">
        <!-- store top filter -->
        <div class="store-filter clearfix">
          <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-9">
              <div class="store-grid">
                <form class="form-inline">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Cari</span>
                    <input class="form-control mr-sm-2" type="search" id="search_text" placeholder="Cari Berkas" style="width: 400px"  aria-describedby="basic-addon1">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /store top filter -->

        <!-- store products -->
        <div class="row filter_data">
        </div>
        <!-- /store products -->

        <!-- store bottom filter -->
        <div id="pagination_link">
        </div>
        <!-- /store bottom filter -->
      </div>
      <!-- /STORE -->
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->

<script>
$(document).ready(function(){

    filter_data(1);

    function filter_data(page)
    {
        $('.filter_data').html('<div class="text-center" style="padding-top: 150px; padding-bottom: 150px"><img src="<?php echo base_url('assets/user/img') ?>/loading.gif" style="height: 80px; width: 80px;"></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        var search = $('#search_text').val();
        var url = "<?php echo $this->uri->segment(3) ?>";
        $.ajax({
            url:"<?php echo base_url(); ?>kategori/fetch_berkas/"+page,
            method:"POST",
            dataType:"JSON",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, search:search, url:url},
            success:function(data)
            {
                $('.filter_data').html(data.product_list);
                $('#pagination_link').html(data.pagination_link);
            }
        })
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $(document).on('click', '.store-pagination li a', function(event){
        event.preventDefault();
        var page = $(this).data('ci-pagination-page');
        filter_data(page);
    });

    $('.common_selector').click(function(){
        filter_data(1);
    });

    $('#search_text').keyup(function(){
        filter_data(1);
    });

    $('#price_range').slider({
        range:true,
        min:5000,
        max:1000000,
        values:[5000,1000000],
        step:5000,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data(1);
        }

    });

});
</script>
