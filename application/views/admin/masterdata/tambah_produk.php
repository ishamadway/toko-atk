<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Tambah Produk</h1>
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item">MasterData</li>
                          <li class="breadcrumb-item"><a class="text-decoration-none" href="<?php echo base_url('admin/produk/all') ?>">Produk</a></li>
                          <li class="breadcrumb-item active">Tambah Produk</li>
                        </ol>

                        <form method="post" action="<?php echo base_url('admin/produk/tambah_produk_aksi') ?>" enctype="multipart/form-data">
                          <div class="card mb-4">
                            <div class="card-body">
                              <input type="hidden" name="id" >
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                  <input type="text" name="nama" class="form-control"
                                  placeholder="Nama Produk" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-10">
                                  <div class="row">
                                    <div class="col-lg-3">
                                      <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><img id="image_upload_preview" src="<?php echo base_url('assets/uploads/produk/600x600.png')?>"
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
                                  <textarea name="deskripsi" class="form-control" placeholder="Deskripsi..." rows="10" required></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                  <select class="form-control" name="id_kategori" required>
                                    <option selected>Pilih Kategori</option>
                                    <option value="1">Alat Tulis</option>
                                    <option value="2">Tinta</option>
                                    <option value="3">Produk Komputer & Otomatisasi Kantor</option>
                                    <option value="4">Berkas</option>
                                    <option value="5">Furnitur</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Merek</label>
                                <div class="col-sm-10">
                                  <input type="text" name="merek" class="form-control" placeholder="Merek" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Stok</label>
                                <div class="col-sm-10">
                                  <input type="number" name="stok" class="form-control" placeholder="Stok" required>
                                </div>
                              </div>
                               <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                  <input type="text" name="harga" class="form-control" placeholder="Harga" required>
                                </div>
                              </div>
                               <div class="form-group row">
                                <label class="col-sm-2 col-form-label">SKU</label>
                                <div class="col-sm-10">
                                  <input type="text" name="sku" class="form-control" placeholder="SKU" required>
                                </div>
                              </div>
                              <button type="submit" class="btn btn-primary btn-sm mt-4 ml-2" style="float: right; width: 120px">Save Changes</button>
                              <a type="button" href="javascript:window.history.go(-1);" class="btn btn-outline-primary btn-sm mt-4" style="float: right; width: 120px">Kembali</a>
                            </div>
                          </div>
                        </form>

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
                      <img id="image_upload_preview_modal" src="<?php echo base_url('assets/uploads/produk/600x600.png')?>"
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
