<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $title ?></title>
        <link href="<?php echo base_url('assets/admin') ?> /css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <style>
        .text
        {
            font-size: 12px;
        }
    </style>

    <body>
        <main>
            <div class="container-fluid" style="border: 1px solid grey; padding: 10px">

                <?php foreach($pesanan as $data) {} ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <p class="text">No. Pesanan <?php echo $data->order_id ?></p>
                            <p class="text">Ekspedisi: <?php echo $data->nama_ekspedisi ?> - <?php echo $data->jenis_ekspedisi ?></p>
                        </div>
                        <div class="col-lg-6 text-right">
                            <img src="<?php echo base_url('assets/user/img/LUM_Logo-black.png') ?>" style="width: 100px">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p class="text">Pengirim:</p>
                            <p class="text" style="font-weight: bold">LUM Store</p>
                            <p class="text">Jl. Kenangan No.12<br>Kota Bekasi, 17414</p>
                            <p class="text">(021)234567890</p>
                        </div>
                        <div class="col-md-7 text-right">
                            <p class="text">Penerima:</p>
                            <p class="text" style="font-weight: bold"><?php echo $data->nama ?></p>
                            <p class="text"><?php echo $data->alamat ?><br>Kota <?php echo $data->kota ?>, <?php echo $data->kode_pos ?></p>
                            <p class="text"><?php echo $data->no_telp ?></p>
                        </div>
                    </div>

                    <div>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text" scope="col">#</th>
                                    <th class="text" scope="col">Produk</th>
                                    <th class="text" scope="col">Qty</th>
                                    <th class="text" scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($item as $list) { ?>
                                <tr>
                                    <th class="text"><?php echo $no++ ?></th>
                                    <td class="text"><?php echo $list->nama ?></td>
                                    <td class="text"><?php echo $list->quantity ?></td>
                                    <td class="text"><?php echo $list->sub_total ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

            </div>
        </main>
    </body>
</html>