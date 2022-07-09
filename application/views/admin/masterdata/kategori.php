<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Kategori</h1>
                        <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item">MasterData</li>
                          <li class="breadcrumb-item active">Kategori</li>
                        </ol>

                    <?php echo $this->session->flashdata('sukses') ?>
                    <?php echo $this->session->flashdata('gagal') ?>

                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#TambahKategori" role="button"><i class="fas fa-plus"></i> Tambah Kategori</a>
                    
                    <table class="table mt-2">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Kategori</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($kategori as $row): ?>
                        <tr>
                          <th scope="row"><?php echo $no++ ?></th>
                          <td><?php echo $row->kategori ?></td>
                          <td>
                            <a class="btn btn-sm btn-white" href="#" title="Ubah"
                               data-toggle="modal" data-target="#UbahData<?php echo $row->id_kategori; ?>" role="button"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-sm btn-white" href="#" title="Hapus"
                               data-toggle="modal" data-target="#HapusData<?php echo $row->id_kategori ?>" role="button"><i class="fas fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    </div>
                </main>

                <!-- Modal -->
                <form method="post" action="<?php echo base_url('admin/kategori/tambah_kategori') ?>">
                  <div class="modal fade" id="TambahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Form Tambah Kategori</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_kategori">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Kategori</label>
                              <div class="col-sm-10">
                                <input type="text" name="kategori" class="form-control" id="staticEmail"
                                placeholder="Nama Kategori">
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

                <!-- Modal Ubah Data -->
                <?php foreach($kategori as $row) { ?>
                <form method="post" action="<?php echo base_url('admin/kategori/ubah_kategori') ?>">
                  <div class="modal fade" id="UbahData<?php echo $row->id_kategori; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_kategori" value="<?php echo $row->id_kategori ?>">
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Kategori</label>
                              <div class="col-sm-10">
                                <input type="text" name="kategori" value="<?php echo $row->kategori ?>" class="form-control" required>
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
                <?php } ?>
                <!-- END Modal Ubah Data -->

              <!-- Modal Hapus Data -->
              <?php foreach($kategori as $row1) { ?>
              <form method="post" action="<?php echo base_url('admin/kategori/delete_kategori') ?>">
                <div class="modal fade" id="HapusData<?php echo $row1->id_kategori; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="id_kategori" value="<?php echo $row1->id_kategori ?>">
                        Anda yakin ingin menghapus data dengan field nama <b><?php echo $row1->kategori ?>?</b>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <?php } ?>
              <!-- END Modal Hapus Data -->
