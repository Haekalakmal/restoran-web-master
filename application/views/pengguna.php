<!doctype html>
<html lang="en">
 
<head>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/concept-master/assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <?php $this->load->view('_partials/head'); ?>
    <title>Data Pengguna</title>
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
                            <h2 class="pageheader-title">Data Pengguna</h2>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Data Pengguna</h5>
                                <div>
                                    <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#tambah">Tambah</button>
                                    <button class="btn btn-secondary btn-sm d-none batal" data-toggle="collapse" data-target="#tambah">Batal</button>
                                </div>
                            </div>
                            <div class="card-body border-bottom collapse" id="tambah">
                                <form method="post" action="<?php echo site_url('pengguna/add') ?>">
                                    <div class="info"></div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role" class="form-control">
                                            <option value="Admin">Admin</option>
                                            <option value="Dapur">Dapur</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Tambah</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="info"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                        </thead>
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
            <div class="info"></div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label>Password ( kosongkan jika tidak ingin merubah password )</label>
                <input type="password" class="form-control" name="password" placeholder="Password" value="">
            </div>

            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control" id="role">
                    <option value="Admin">Admin</option>
                    <option value="Dapur">Dapur</option>
                </select>
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
    <script src="<?php echo base_url() ?>assets/concept-master/assets/vendor/datatables/js/data-table.js"></script>
    <script src="<?php echo base_url() ?>assets/concept-master/assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script>
        let read_url = '<?php echo site_url('pengguna/read') ?>'
        let edit_url = '<?php echo site_url('pengguna/edit') ?>'
        let hapus_url = '<?php echo site_url('pengguna/delete') ?>'


        $(document).ready(() => {
            let validator = $('form').parsley()
            let table = $('table').DataTable({
                ajax: read_url,
                columns: [
                    { data: 'username' },
                    { data: 'role' },
                    { data: null }
                ],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        render: (data, type, row) => `
                            <button class="btn btn-success btn-sm edit"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm hapus"><i class="fa fa-trash"></i></button>
                        `,
                        targets: 2
                    }
                ],
                responsive: true
            })
            function reload() {
                table.ajax.reload()
            }
            $('form').on('submit', function(e) {
                e.preventDefault()
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: (res) => {
                        reload()
                        if (res === 'tambah') {
                            $('#tambah').collapse('hide')
                            $(this).find('.info').html(`<div class="alert alert-primary alert-dismissible">
                                Sukses Menambahkan Data
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                            </div>`)
                        } else {
                            $(this).find('.info').html(`<div class="alert alert-primary alert-dismissible">
                                Sukses Mengedit Data
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                            </div>`)
                            $('.modal').modal('hide')
                        }
                    },
                    error: () => $(this).find('.info').html(`<div class="alert alert-danger">Username Sudah Ada</div>`)
                })
            })
            $('tbody').on('click', '.edit', function() {
                let data = table.row($(this).parents('tr')).data()
                $('.modal').find('form').attr('action', `${edit_url}/${data.id}`)
                $('.modal').find('[name=username]').val(data.username);

                $('.modal #role option[value="' + data.role + '"]').attr('selected','selected');
                $('.modal').modal('show')
            })
            $('tbody').on('click', '.hapus', function() {
                let row = table.row($(this).parents('tr'))
                let id = row.data().id
                $.ajax({
                    url: `${hapus_url}/${id}`,
                    type: 'get',
                    dataType: 'json',
                    success: () => {
                        row.remove().draw()
                        $('.info').html(`<div class="alert alert-danger alert-dismissible">
                            Sukses Menghapus Data
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                        </div>`)
                    }
                })
            })
            $('.modal').on('hidden.bs.modal', () => $('form')[1].reset())
            $('#tambah').on('hidden.bs.collapse', () => $('form')[0].reset())
            $('#tambah').on('show.bs.collapse', () => $('.batal').removeClass('d-none'))
            $('#tambah').on('hide.bs.collapse', () => $('.batal').addClass('d-none'))
        })
    </script>
</body>
 
</html>