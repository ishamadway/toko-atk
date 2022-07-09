<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <div class="col-md-12">
        <h3 class="breadcrumb-header">Keranjang Saya</h3>
        <ul class="breadcrumb-tree">
          <li><a href="<?php echo base_url('homepage') ?>">Home</a></li>
          <li class="active">Keranjang</li>
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

      <!-- Order Tab -->
      <div class="col-md-12">
        <div class="products-tabs" id="view_cart">

        </div>
      </div>

    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Modal Success -->
<div class="modal fade" id="deleteSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-center" style="padding: 40px">
        <a class="text-success"><i class="fa fa-5x fa-check-circle-o" aria-hidden="true"></i><a/>
        <h5 style="padding-top: 20px">Dihapus dari keranjang!</h5>
      </div>
    </div>
  </div>
</div>
<!-- /Modal Success -->

<script>
$(document).ready(function(){
    $('#count_cart').load("<?php echo site_url('cart/count_cart');?>");
    $('#button_cart').load("<?php echo site_url('cart/show_button_cart');?>");
    $('#view_cart').load("<?php echo site_url('keranjang/load_cart');?>");

    //Hapus Item Cart
    $(document).on('click','.delete',function(){
        var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
        $.ajax({
            url : "<?php echo base_url(); ?>keranjang/delete_cart",
            method : "POST",
            data : {row_id : row_id},
            success :function(data){
                $('#view_cart').html(data);
                $('#count_cart').load("<?php echo site_url('cart/count_cart');?>");
                $('#detail_cart').load("<?php echo site_url('cart/load_cart');?>");
                $('#button_cart').load("<?php echo site_url('cart/show_button_cart');?>");
                $('#deleteSuccess').modal('show');
                setTimeout(function() {
                  $('#deleteSuccess').modal('hide')
                }, 3000);
            }
        });
    });

    //update_quantity_cart
    $(document).on('change', '.qty', function(){
       var qty = $(this).val();
       var row_id = $(this).attr("id");
       $.ajax({
          url:"<?php echo base_url(); ?>keranjang/update_cart",
          method:"POST",
          data:{row_id:row_id, qty:qty},
            success:function(data){
             $('#view_cart').html(data);
             $('#detail_cart').load("<?php echo site_url('cart/load_cart');?>");
            }
        });
    });

    $(document).on('click','.empty_cart',function(){
        $.ajax({
            url : "<?php echo base_url(); ?>keranjang/empty_cart",
            method : "POST",
            success :function(data){
                $('#view_cart').html(data);
                $('#count_cart').load("<?php echo site_url('cart/count_cart');?>");
                $('#detail_cart').load("<?php echo site_url('cart/load_cart');?>");
                $('#button_cart').load("<?php echo site_url('cart/show_button_cart');?>");
            }
        });
    });

});
</script>
