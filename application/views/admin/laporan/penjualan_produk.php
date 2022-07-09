<div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Penjualan Produk</h1>
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item">Laporan</li>
                  <li class="breadcrumb-item active">Penjualan Produk</li>
                </ol>

                  <div class="row mb-4">
                     <div class="col-lg-6">
                     </div>
                     <div class="col-lg-6 text-right">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Search</span>
                          </div>
                          <input type="search" class="form-control" id="search_text" placeholder="Cari..." style="width: 80%">
                        </div>
                     </div>
                  </div>

                  <?php echo $this->session->flashdata('sukses') ?>
                  <?php echo $this->session->flashdata('gagal') ?>

                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">ID</th>
                          <th scope="col">Nama Produk</th>
                          <th scope="col">Merek</th>
                          <th scope="col">SKU</th>
                          <th scope="col">Terjual</th>
                        </tr>
                      </thead>
                      <tbody class="filter_data">

                      </tbody>
                    </table>

                      <div id="pagination_link">

                      </div>

                    </div>
                </main>

                <script>
                $(document).ready(function(){

                    filter_data(1);

                    function filter_data(page)
                    {
                        var action = 'fetch_data';
                        var search = $('#search_text').val();
                        $.ajax({
                            url:"<?php echo base_url(); ?>admin/penjualan_produk/fetch_data/"+page,
                            method:"POST",
                            dataType:"JSON",
                            data:{action:action, search:search},
                            success:function(data)
                            {
                                $('.filter_data').html(data.product_list);
                                $('#pagination_link').html(data.pagination_link);
                            }
                        })
                    }

                    $(document).on('click', '.pagination li a', function(event){
                        event.preventDefault();
                        var page = $(this).data('ci-pagination-page');
                        filter_data(page);
                    });

                    $('#search_text').keyup(function(){
                        filter_data(1);
                    });

                });
                </script>
