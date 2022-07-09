<div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Transaksi</h1>
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item">Laporan</li>
                  <li class="breadcrumb-item active">Transaksi</li>
                </ol>

                  <div class="row mb-4">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Search</span>
                          </div>
                          <input type="search" class="form-control" id="search_text" placeholder="Cari berdasarkan Order ID" style="width: 80%">
                        </div>
                    </div>
                  </div>

                  <?php echo $this->session->flashdata('sukses') ?>
                  <?php echo $this->session->flashdata('gagal') ?>

                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Order ID</th>
                          <th scope="col">Total Pesanan</th>
                          <th scope="col">Tipe Pembayaran</th>
                          <th scope="col">Bank</th>
                          <th scope="col">Waktu Transaksi</th>
                          <th scope="col">Batas Pembayaran</th>
                          <th scope="col">Waktu Pembayaran</th>
                          <th scope="col">Status</th>
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
                            url:"<?php echo base_url(); ?>admin/transaksi/fetch_data/"+page,
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
