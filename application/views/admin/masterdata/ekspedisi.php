<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Ekspedisi</h1>
                        <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item">MasterData</li>
                          <li class="breadcrumb-item active">Ekspedisi</li>
                        </ol>

                    <?php echo $this->session->flashdata('sukses') ?>
                    <?php echo $this->session->flashdata('gagal') ?>

                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#TambahEkspedisi" role="button"><i class="fas fa-plus"></i> Tambah Ekspedisi</a>

                    <table class="table mt-2">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Jenis</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($ekspedisi as $row): ?>
                        <tr>
                          <th scope="row"><?php echo $no++ ?></th>
                          <td><?php echo $row->nama_ekspedisi ?></td>
                          <td><?php echo $row->jenis_ekspedisi ?></td>
                          <td>
                            <a class="btn btn-sm btn-white" href="#" title="Hapus"
                               data-toggle="modal" data-target="#HapusData<?php echo $row->id_ekspedisi; ?>" role="button"><i class="fas fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    </div>
                </main>

                <!-- Modal -->
                <form method="post" action="<?php echo base_url('admin/ekspedisi/tambah_ekspedisi') ?>">
                <div class="modal fade" id="TambahEkspedisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Ekspedisi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ekspedisi</label>
                            <div class="col-sm-10">
                              <input type="text" name="nama_ekspedisi" class="form-control" placeholder="Nama Ekspedisi">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jenis Ekspedisi</label>
                            <div class="col-sm-10">
                              <input type="text" name="jenis_ekspedisi" class="form-control" placeholder="cth: Regular, Ekonomis, dll..">
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

              <!-- Modal Hapus Data -->
              <?php foreach($ekspedisi as $row): ?>
              <form method="post" action="<?php echo base_url('admin/kategori/delete_kategori') ?>">
              <div class="modal fade" id="HapusData<?php echo $row->id_ekspedisi; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Hapus Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="id_ekspedisi" value="<?php echo $row->id_ekspedisi ?>">
                      Anda yakin ingin menghapus Ekspedisi <b><?php echo $row->nama_ekspedisi ?>?</b>
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
