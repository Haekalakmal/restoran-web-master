<!doctype html>
<html lang="en">
 
<head>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/concept-master/assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/concept-master/assets/vendor/select2/css/select2.css">
    <?php $this->load->view('_partials/head'); ?>
    <title>Masakan</title>
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
                            <h2 class="pageheader-title">Data Masakan</h2>
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
                                <h5 class="mb-0">Data Masakan</h5>
                                <div>
                                    <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#tambah">Tambah</button>
                                    <button class="btn btn-secondary btn-sm d-none batal" data-toggle="collapse" data-target="#tambah">Batal</button>
                                </div>
                            </div>
                            <div class="card-body border-bottom collapse" id="tambah">
                                <form method="post" action="<?php echo site_url('masakan/add') ?>">
                                    <div class="info"></div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control select2" name="id_kategori" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" class="form-control" name="gambar" required>
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
                                                <th>Gambar</th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
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
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control select2" name="id_kategori" required></select>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" placeholder="Harga" required>
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" class="form-control" name="gambar">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control select2" name="status" id="status">
                    <option value="1">Ada</option>
                    <option value="0">Habis</option>
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
    <script src="<?php echo base_url() ?>assets/concept-master/assets/vendor/select2/js/select2.min.js"></script>
    <script>
        let read_url = '<?php echo site_url('masakan/read') ?>';
        let edit_url = '<?php echo site_url('masakan/edit') ?>';
        let hapus_url = '<?php echo site_url('masakan/delete') ?>';
        let get_kategori_url = '<?php echo site_url('kategori_masakan/get_kategori') ?>';
        let base_url = '<?php echo base_url() ?>';
        $(document).ready(() => {
            let validator = $('form').parsley()
            let table = $('table').DataTable({
                ajax: read_url,
                columns: [
                    { data: 'gambar' },
                    { data: 'nama' },
                    { data: 'kategori' },
                    { data: 'harga' },
                    { data: 'status' },
                    { data: null }
                ],
                columnDefs: [
                    {
                        render: data => `<img class="w-100" src="${base_url}/uploads/${data}">`,
                        targets: 0
                    },{
                        render: data => data==0?'<label class="label label-danger">habis</label>':'<label class="label label-success">ada</label>',
                        targets: 4
                    },
                    {
                        orderable: false,
                        searchable: false,
                        render: (data, type, row) => `
                            <button class="btn btn-success btn-sm edit"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm hapus"><i class="fa fa-trash"></i></button>
                        `,
                        targets: 5
                    }
                ],
                responsive: true
            })
            function reload() {
                table.ajax.reload()
            }
            $('form').on('submit', function(e) {
                e.preventDefault()
                let data = new FormData(this)
                let file = $(this).find('[type=file]').prop('files')[0]
                data.append('gambar', file)
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    dataType: 'json',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: (res) => {
                        reload()
                        if (res === 'tambah') {
                            $('#tambah').collapse('hide')
                            $('.info').html(`<div class="alert alert-primary alert-dismissible">
                                Sukses Menambahkan Data
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                            </div>`)
                        } else {
                            $('.info').html(`<div class="alert alert-primary alert-dismissible">
                                Sukses Mengedit Data
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                            </div>`)
                            $('.modal').modal('hide')
                        }
                    },
                    error: () => $(this).find('.info').html(`<div class="alert alert-danger">Format File Tidak Didukung</div>`)
                })
            })
            $('tbody').on('click', '.edit', function() {
                let data = table.row($(this).parents('tr')).data()
                $('.modal').find('form').attr('action', `${edit_url}/${data.id}`)
                $('.modal').find('[name=nama]').val(data.nama)
                $('.modal').find('[name=id_kategori]').append(`<option value="${data.id_kategori}">${data.kategori}</option>`)
                $('#status  option[value="'+ data.status + '"]').attr('selected','selected');
                $('.modal').find('[name=harga]').val(data.harga)
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
            $('[name=id_kategori]').select2({
                placeholder: 'Kategori',
                ajax: {
                    url: get_kategori_url,
                    type: 'get',
                    data: params => ({
                        kategori: params.term
                    }),
                    processResults: res => ({
                        results: res
                    }),
                    cache: true
                }
            })
            $('.modal').on('hidden.bs.modal', () => $('form')[1].reset())
            $('#tambah').on('hidden.bs.collapse', () => $('form')[0].reset())
            $('#tambah').on('show.bs.collapse', () => $('.batal').removeClass('d-none'))
            $('#tambah').on('hide.bs.collapse', () => $('.batal').addClass('d-none'))
        })
    </script>
</body>
 
</html>