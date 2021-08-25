<!doctype html>
<html lang="en">
 
<head>
    <?php $this->load->view('_partials/head'); ?>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/concept-master/assets/vendor/datepicker/tempusdominus-bootstrap-4.css" />
    <title>Order Meja</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <?php $this->load->view('_includes/navbar'); ?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php $this->load->view('_includes/left-sidebar'); ?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Order Meja</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo site_url('') ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $this->uri->segment(1) ?></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <h5 class="card-header">Order</h5>
                            <div class="card-body">

                                <div class="info">
                                    <?php if ($this->session->flashdata('meja_exist')): ?>
                                        <div class="alert alert-danger">tanggal dan waktu order meja sudah ada</div>
                                    <?php endif ?>
                                </div>
                                <form method="post" action="<?php echo site_url('order/add') ?>">
                                    <div class="form-group">
                                        <label>Atas Nama*</label>
                                        <input type="text" name="nama" value="" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>No Meja</label>
                                        <select name="meja_id" class="form-control select2" required>
                                            <?php if ($meja === 'kosong'): ?>
                                                <option value="" class="d-none">Meja Isi Semua</option>
                                            <?php else: ?>
                                                <option value="" class="d-none">Pilih No Meja</option>
                                                <?php foreach ($meja as $key => $value): ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->no_meja ?> ( Kapasitas <?php echo $value->jumlah_kursi ?> Orang )</option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">  
                                            <div class="form-group">
                                                <label>Jam Masuk</label>
                                                <div class="input-group date" id="timepicker1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" name="jam_masuk" data-target="#timepicker1" />
                                                    <div class="input-group-append" data-target="#timepicker1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">  
                                            <div class="form-group">
                                                <label>Jam Keluar</label>
                                                <div class="input-group date" id="timepicker2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" name="jam_keluar" data-target="#timepicker2" />
                                                    <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="tanggal" min="<?= date('Y-m-d'); ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <?php if ($meja === 'kosong'): ?>
                                            <button class="btn btn-primary" disabled>Tambah</button>
                                        <?php else: ?>
                                            <button class="btn btn-primary">Tambah</button>
                                        <?php endif ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <h5 class="card-header">Data Order</h5>
                            <div class="card-body">
                               <?php if ($alert = $this->session->flashdata('sukses')): ?>
                                    <div class="alert alert-<?php echo $alert === 'tambah' ? 'primary' : 'danger' ?> ?>">Sukses <?php echo $alert === 'tambah' ? 'Menambah' : 'Menghapus' ?> Data</div>
                                <?php endif ?> 
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No Meja</th>
                                                <th>Nama</th>
                                                <th>Tanggal</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                <th>Keterangan</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($order === 'kosong'): ?>
                                                <tr>
                                                    <td colspan="7" align="center">Kosong</td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($order as $key => $value): ?>
                                                    <tr>
                                                        <td><?php echo $value->no_meja ?></td>
                                                        <td><?php echo $value->nama ?></td>
                                                        <td><?php echo $value->tanggal ?></td>
                                                        <td><?php echo $value->jam_masuk ?></td>
                                                        <td><?php echo $value->jam_keluar ?></td>
                                                        <td><?php echo $value->keterangan ?></td>
                                                        <td><a class="btn btn-danger btn-sm" href="<?php echo site_url('order/hapus?id=').$value->id.'&meja_id='.$value->id_meja ?>"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php $this->load->view('_includes/footer'); ?>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <div class="modal">
    <div class="modal-dialog">
    <div class="modal-content">
    <form method="post">
        <div class="modal-header">
            <h5 class="modal-title m-0">Edit Data</h5>
            <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Edit</button>
            <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
    </form>
    </div>
    </div>
    </div>
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php $this->load->view('_partials/foot'); ?>
    <script src="<?php echo base_url() ?>assets/concept-master/assets/vendor/parsley/parsley.js"></script>

    <script src="<?php echo base_url() ?>assets/concept-master/assets/vendor/datepicker/moment.js"></script>
    <script src="<?php echo base_url() ?>assets/concept-master/assets/vendor/datepicker/tempusdominus-bootstrap-4.js"></script>

    <script>
        $('form').parsley()


        if ($("#timepicker1").length) {

            $('#timepicker1').datetimepicker({
                 format: 'HH:mm',
                pickDate: false,
                pickSeconds: false,
                pick12HourFormat: false  
            });
        }
        if ($("#timepicker2").length) {

            $('#timepicker2').datetimepicker({
                 format: 'HH:mm',
                pickDate: false,
                pickSeconds: false,
                pick12HourFormat: false  
            });
        }
        if ($("#datepicker").length) {

            $('#datepicker').datetimepicker({ maxDate: $.now() });
        }
    </script>
</body>
 
</html>