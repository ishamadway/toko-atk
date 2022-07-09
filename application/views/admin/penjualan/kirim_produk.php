<div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Kirim Produk</h1>
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item">Penjualan</li>
                  <li class="breadcrumb-item active">Kirim Produk</li>
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

                    <table class="table" style="overflow-x: scroll">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Order ID</th>
                          <th scope="col">Nama Pembeli</th>
                          <th scope="col">Ekspedisi</th>
                          <th scope="col">Alamat Pembeli</th>
                          <th scope="col">Waktu Dibayar</th>
                          <th scope="col">Batas Pengiriman</th>
                          <th scope="col">Atur Pengiriman</th>
                          <th scope="col">Label</th>
                        </tr>
                      </thead>
                      <tbody class="filter_data">

                      </tbody>
                    </table>

                      <div id="pagination_link">

                      </div>

                    </div>
                </main>

                <!-- Modal Atur Pengiriman -->
                <?php foreach($pesanan as $row): ?>
                <form method="post" action="<?php echo base_url('admin/kirim_produk/atur_pengiriman') ?>">
                <div class="modal fade" id="AturPengiriman<?php echo $row->order_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Atur Pegiriman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="order_id" value="<?php echo $row->order_id ?>">
                        <input type="hidden" name="nama_pembeli" value="<?php echo $row->nama ?>">
                        <b>Order ID: <?php echo $row->order_id ?></b>
                        <hr>
                        <table class="table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">Nama Ekspedisi</th>
                              <th scope="col">Jenis Ekspedisi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php echo $row->nama_ekspedisi ?></td>
                              <td><?php echo $row->jenis_ekspedisi ?></td>
                            </tr>
                          </tbody>
                        </table>
                        <hr>
                        <input type="text" name="no_resi" class="form-control" placeholder="Masukan nomor resi" required>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
                <?php endforeach; ?>
                <!-- END Modal Atur Pengiriman -->

                <script>
                $(document).ready(function(){

                    filter_data(1);

                    function filter_data(page)
                    {
                        var action = 'fetch_data';
                        var search = $('#search_text').val();
                        $.ajax({
                            url:"<?php echo base_url(); ?>admin/kirim_produk/fetch_data/"+page,
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
