<!doctype html>
<html lang="en">
 
<head>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/concept-master/assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <?php $this->load->view('_partials/head'); ?>
    <title>Data Meja</title>
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
                            <h2 class="pageheader-title">Data Meja</h2>
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
                                <h5 class="mb-0">Data Meja</h5>
                                <div>
                                    <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#tambah">Tambah</button>
                                    <button class="btn btn-secondary btn-sm d-none batal" data-toggle="collapse" data-target="#tambah">Batal</button>
                                </div>
                            </div>
                            <div class="card-body border-bottom collapse" id="tambah">
                                <form method="post" action="<?php echo site_url('meja/add') ?>">
                                    <div class="info"></div>
                                    <div class="form-group">
                                        <label>No Meja</label>
                                        <input type="number" class="form-control" name="no_meja" placeholder="No Meja" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Kursi</label>
                                        <input type="number" class="form-control" name="jumlah_kursi" placeholder="Jumlah Kursi" required>
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
                                                <th>No Meja</th>
                                                <th>Jumlah Kursi</th>
                                                <th>Status</th>
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
                <label>No Meja</label>
                <input type="number" class="form-control" name="no_meja" placeholder="No Meja" required>
            </div>
            <div class="form-group">
                <label>Jumlah Kursi</label>
                <input type="number" class="form-control" name="jumlah_kursi" placeholder="Jumlah Kursi" required>
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
        let read_url = '<?php echo site_url('meja/read') ?>'
        let edit_url = '<?php echo site_url('meja/edit') ?>'
        let hapus_url = '<?php echo site_url('meja/delete') ?>'
        let kosongkan_url = '<?php echo site_url('meja/kosongkan') ?>'
        $(document).ready(() => {
    let validator = $('form').parsley()
    let table = $('table').DataTable({
        ajax: read_url,
        columns: [
            { data: 'no_meja' },
            { data: 'jumlah_kursi' },
            { data: 'status' },
            { data: null }
        ],
        columnDefs: [
            {
                render: data => {
                    if (data === '0') {
                        return `<span class="badge badge-secondary">Kosong</span>`
                    } else {
                        return `<span class="badge badge-primary">Isi</span>`
                    }
                },
                targets: 2
            },
            {
                orderable: false,
                searchable: false,
                render: (data, type, row) => `
                    <button class="btn btn-success btn-sm edit"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm hapus"><i class="fa fa-trash"></i></button>
                    <button class="btn btn-danger btn-info kosongkan">Kosongkan</button>
                `,
                targets: 3
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
            error: err => $(this).find('.info').html(`<div class="alert alert-danger">No Meja Sudah Ada</div>`)
        })
    })
    $('tbody').on('click', '.edit', function() {
        let data = table.row($(this).parents('tr')).data()
        $('.modal').find('form').attr('action', `${edit_url}/${data.id}`)
        $('.modal').find('[name=no_meja]').val(data.no_meja)
        $('.modal').find('[name=jumlah_kursi]').val(data.jumlah_kursi)
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
    $('tbody').on('click', '.kosongkan', function() {
        let row = table.row($(this).parents('tr'))
        let id = row.data().id
        $.ajax({
            url: `${kosongkan_url}/${id}`,
            type: 'get',
            dataType: 'json',
            success: () => {
                $('.info').html(`<div class="alert alert-success alert-dismissible">
                    Sukses Mengkosongkan Meja
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                </div>`)
                reload()
            }
        })
    })
    $('#tambah').on('hidden.bs.collapse', () => $('form')[0].reset())
    $('#tambah').on('show.bs.collapse', () => $('.batal').removeClass('d-none'))
    $('#tambah').on('hide.bs.collapse', () => $('.batal').addClass('d-none'))
})
    </script>
</body>
 
</html>