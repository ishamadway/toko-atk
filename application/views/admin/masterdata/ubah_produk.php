<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Ubah Produk</h1>
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item">MasterData</li>
                          <li class="breadcrumb-item"><a class="text-decoration-none" href="<?php echo base_url('admin/produk/all') ?>">Produk</a></li>
                          <li class="breadcrumb-item active">Ubah Produk</li>
                        </ol>

                        <?php foreach($produk as $row): ?>
                        <form method="post" action="<?php echo base_url('admin/produk/ubah_produk_aksi') ?>" enctype="multipart/form-data">
                          <div class="card mb-4">
                            <div class="card-body">
                              <input type="hidden" name="id" value="<?php echo $row->id ?>">
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                  <input type="text" name="nama" value="<?php echo $row->nama ?>" class="form-control"
                                  placeholder="Nama Produk" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-10">
                                  <div class="row">
                                    <div class="col-lg-3">
                                      <a id="image_preview_link" href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><img id="image_upload_preview" src="<?php echo base_url('assets/uploads/produk/'). $row->gambar; ?>"
                                        alt="..." class="img-thumbnail" style="width: 200px"></a>
                                    </div>
                                    <div class="col-lg-9">
                                      <input type="file" name="gambar" id="inputFile" class="form-control">
                                      <small class="text-dark"><b>Ketentuan : </b>
                                        <br>
                                        1. Max. Size : 2 MB
                                        <br>
                                        2. Supported file : png | jpg | jpeg
                                        <br>
                                        3. Max. width : 1080px
                                        <br>
                                        4. Max. height : 1080px
                                      </small>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                  <textarea name="deskripsi" value="<?php echo $row->deskripsi ?>" class="form-control" rows="10" required><?php echo $row->deskripsi ?></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                  <select class="form-control" name="id_kategori" required>
                                    <?php foreach($kategori as $data): ?>
                                    <option <?php if($data->id_kategori == $row->kategori_id) { echo 'selected="selected"'; } ?> value="<?php echo $data->id_kategori ?>">
                                      <?php echo $data->kategori ?>
                                    </option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Merek</label>
                                <div class="col-sm-10">
                                  <input type="text" name="merek" value="<?php echo $row->merek ?>" class="form-control" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Stok</label>
                                <div class="col-sm-10">
                                  <input type="number" name="stok" value="<?php echo $row->stok ?>" class="form-control" required>
                                </div>
                              </div>
                               <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                  <input type="text" name="harga" value="<?php echo $row->harga ?>" class="form-control" required>
                                </div>
                              </div>
                               <div class="form-group row">
                                <label class="col-sm-2 col-form-label">SKU</label>
                                <div class="col-sm-10">
                                  <input type="text" name="sku" value="<?php echo $row->sku ?>" class="form-control" required>
                                </div>
                              </div>
                              <button type="submit" class="btn btn-primary btn-sm mt-4 ml-2" style="float: right; width: 120px">Save Changes</button>
                              <?php if($row->arsip == '0') { ?>
                              <a type="button" href="<?php echo base_url('admin/produk/arsipkan_produk/'). $row->id ?>" class="btn btn-outline-primary btn-sm mt-4 ml-2" style="float: right; width: 120px">Arsipkan</a>
                              <?php } else { ?>
                              <a type="button" href="<?php echo base_url('admin/produk/tampilkan_produk/'). $row->id ?>" class="btn btn-primary btn-sm mt-4 ml-2" style="float: right; width: 120px">Tampilkan</a>
                              <?php } ?>
                              <a type="button" href="javascript:window.history.go(-1);" class="btn btn-outline-primary btn-sm mt-4" style="float: right; width: 120px">Kembali</a>
                            </div>
                          </div>
                        </form>
                        <?php endforeach; ?>

                    </div>
                </main>

                <!-- Modal Preview Image -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Image Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <img id="image_upload_preview_modal" src="<?php echo base_url('assets/uploads/produk/'). $row->gambar; ?>"
                        alt="..." class="img-fluid"></a>
                    </div>
                  </div>
                </div>
                <!-- END Modal Preview Image -->

                <script>
                  function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#image_upload_preview').attr('src', e.target.result);
                            $('#image_upload_preview_modal').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                  }

                  $("#inputFile").change(function () {
                    readURL(this);
                  });
                </script>
