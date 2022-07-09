<div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Profile</h1>

                <hr>

                <?php echo $this->session->flashdata('sukses') ?>
                <?php echo $this->session->flashdata('gagal') ?>

                <div class="row mb-4">

                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                Profile
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo base_url('admin/profile/ubah_profile') ?>">
                                    <?php foreach($admin as $data) { ?>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama" class="form-control" value="<?php echo $data->nama ?>">
                                            <?php echo form_error('nama','<span class="error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" value="<?php echo $data->email ?>">
                                            <?php echo form_error('email','<span class="error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <button style="float: right" type="submit" class="btn btn-primary"> Save</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                         <div class="card">
                            <div class="card-header">
                                Ubah Password
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo base_url('admin/profile/ubah_password') ?>">
                                    <?php foreach($admin as $data) { ?>
                                    <div class="form-group">
                                        <label>Password saat ini</label>
                                        <input type="password" name="old_password" class="form-control">
                                        <?php echo form_error('old_password','<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Password baru</label>
                                        <input type="password" name="password" class="form-control">
                                        <?php echo form_error('password','<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="password2" class="form-control">
                                        <?php echo form_error('password2','<span class="error">', '</span>'); ?>
                                    </div>
                                    <?php } ?>

                                    <button style="float: right" type="submit" class="btn btn-primary"> Save</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
