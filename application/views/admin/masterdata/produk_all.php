<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Produk</h1>
                        <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item">MasterData</li>
                          <li class="breadcrumb-item active">Produk</li>
                        </ol>

                  <?php echo $this->session->flashdata('sukses') ?>
                  <?php echo $this->session->flashdata('gagal') ?>

                  <div class="row">
                    <div class="col-lg-6">
                      <a class="btn btn-primary mb-3" href="<?php echo base_url('admin/produk/tambah_produk') ?>" role="button"><i class="fas fa-plus"></i> Tambah Produk</a>
                    </div>
                    <div class="col-lg-6 text-right">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Search</span>
                            </div>
                            <input type="search" class="form-control" id="search_text" placeholder="Cari berdasarkan Nama Produk" style="width: 80%">
                          </div>
                    </div>
                  </div>

                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link active" href="#">Semua</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/produk/habis') ?>">Habis</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/produk/diarsipkan') ?>">Diarsipkan</a>
                      </li>
                    </ul>

                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Produk</th>
                          <th scope="col">Kategori</th>
                          <th scope="col">Stok</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody class="filter_data">

                      </tbody>
                    </table>

                      <div id="pagination_link">

                      </div>

                    </div>
                </main>

                <!-- Modal Hapus Data -->
                <?php foreach($produk as $row): ?>
                <form method="post" action="<?php echo base_url('admin/produk/delete_produk') ?>">
                <div class="modal fade" id="HapusData<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $row->id ?>">
                        Anda yakin ingin menghapus data dengan field nama <b><?php echo $row->nama ?>?</b>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
                <?php endforeach; ?>
                <!-- END Modal Hapus Data -->

                <script>
                $(document).ready(function(){

                    filter_data(1);

                    function filter_data(page)
                    {
                        var action = 'fetch_data';
                        var search = $('#search_text').val();
                        $.ajax({
                            url:"<?php echo base_url(); ?>admin/produk/fetch_data/"+page,
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
