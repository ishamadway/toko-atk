<div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Data Pembeli</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">MasterData</li>
                        <li class="breadcrumb-item active">Pembeli</li>
                    </ol>

                    <div class="row mb-4">
                      <div class="col-lg-6">
                        <!-- <a class="btn btn-primary mb-3" href="<?php echo base_url('admin/pembeli/tambah_user') ?>" role="button"><i class="fas fa-plus"></i> Tambah User</a> -->
                      </div>
                      <div class="col-lg-6 text-right">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Search</span>
                              </div>
                              <input type="search" class="form-control" id="search_text" placeholder="Cari berdasarkan Nama Lengkap atau ID" style="width: 80%">
                            </div>
                      </div>
                    </div>

                    <?php echo $this->session->flashdata('sukses') ?>
                    <?php echo $this->session->flashdata('gagal') ?>

                    <table class="table mt-2">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">ID</th>
                          <th scope="col">Nama Lengkap</th>
                          <th scope="col">Email</th>
                          <th scope="col">Alamat</th>
                          <th scope="col">No. Telp</th>
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

                <!-- Modal Tambah Data
                <form method="post" action="<?php echo base_url('admin/pembeli/tambah_user') ?>">
                <div class="modal fade" id="TambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="id">
                          <input type="hidden" name="role_id">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                              <input type="text" name="nama" class="form-control" placeholder="Nama User" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                              <textarea name="alamat" class="form-control" placeholder="Alamat" required></textarea>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                      </div>
                    </div>
                  </div>
                  </form>
                  END Modal Tambah Data -->

                  <!-- Modal Ubah Data -->
                  <?php foreach($pembeli as $row): ?>
                  <form method="post" action="<?php echo base_url('admin/pembeli/ubah_data_pembeli') ?>">
                  <div class="modal fade" id="UbahData<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $row->id ?>">
                            <input type="hidden" name="role_id" value="<?php echo $row->role_id ?>">
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                              <div class="col-sm-10">
                                <input type="text" name="nama" value="<?php echo $row->nama ?>" class="form-control" placeholder="Nama Lengkap" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <input type="email" name="email" value="<?php echo $row->email ?>" class="form-control" placeholder="Email" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">No. Telp</label>
                              <div class="col-sm-10">
                                <input type="number" name="no_telp" value="<?php echo $row->no_telp ?>" class="form-control" placeholder="No. Telp" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Alamat</label>
                              <div class="col-sm-10">
                                <textarea name="alamat" class="form-control" placeholder="Alamat" required><?php echo $row->alamat ?></textarea>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Kota</label>
                              <div class="col-sm-10">
                                <input type="text" name="kota" value="<?php echo $row->kota ?>" class="form-control" placeholder="Kota" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Kode Pos</label>
                              <div class="col-sm-10">
                                <input type="number" name="kode_pos" value="<?php echo $row->kode_pos ?>" class="form-control" placeholder="Kode Pos" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </form>
                  <?php endforeach; ?>
                  <!-- END Modal Ubah Data -->

                  <!-- Modal Hapus Data -->
                  <?php foreach($pembeli as $row): ?>
                  <form method="post" action="<?php echo base_url('admin/pembeli/delete_data_pembeli') ?>">
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
                              url:"<?php echo base_url(); ?>admin/pembeli/fetch_data/"+page,
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
