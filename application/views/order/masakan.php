<!doctype html>
<html lang="en">
 
<head>
    <?php $this->load->view('_partials/head'); ?>
    <title>Order Masakan</title>
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
                            <h2 class="pageheader-title">Order Masakan</h2>
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
                    <div class="col-8">
                    <div class="row">
                        <?php if ($masakan === 'kosong'): ?>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="alert alert-info">Masakan Kosong</div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($masakan as $key => $value): ?>
                                <div class="col-4">
                                    <div class="card">
                                        <img class="card-img-top img-fluid p-2" src="<?php echo base_url('uploads/').$value->gambar ?>" alt="">
                                        <div class="card-body" id="<?php echo $value->id ?>">
                                            <h3 class="card-title mb-2"><?php echo $value->nama ?></h3>
                                            <span class="text-secondary"><?= "Rp " . number_format($value->harga,0,',','.');?></span>
                                            <?php if($value->status): ?>
                                            <button class="btn btn-primary tambah" data-id="<?php echo $value->id ?>" data-nama="<?php echo $value->nama ?>" data-harga="<?php echo $value->harga ?>" data-gambar="<?php echo base_url('uploads/').$value->gambar ?>">Tambah</button>
                                            <?php else: ?>
                                                <label class="btn btn-danger">HABIS</label>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <h5 class="card-header">Data Pesanan</h5>
                            <form id="form_pesanan" method="post" action="<?php echo site_url('transaksi/proses') ?>">
                                <div class="card-body" >
                                    
                                     <div class="form-group mt-3">
                                        <select name="ordermeja_id" class="form-control select2" required>
                                            <?php if ($meja == 'kosong'): ?>
                                                <option value="" class="d-none">Meja telah terisi semua</option>
                                            <?php else: ?>
                                                <option value="" class="d-none">Pilih No Meja</option>
                                                <?php foreach ($meja as $key => $value): ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->no_meja ?></option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                    <table style="width: 100%" id="data_pesanan">
                                        
                                    </table>
                                    <div class="form-group">
                                        <label>Total Harga Bayar</label>
                                        <input type="text"  id="total_harga_bayar" class="form-control" readonly value="0">
                                        <input type="hidden"  name="total_harga_bayar" value="0">
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block bayar" type="submit" disabled>Bayar</button>
                                </div>
                            </form>
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
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php $this->load->view('_partials/foot'); ?>
    <script>
        let transaksi_url = '<?php echo site_url('transaksi/proses') ?>'
        $(function(){
            let myorder = [];
            var total_harga_bayar = 0;
            $(".tambah").on("click",function(){
                let id = $(this).attr("data-id");
                let nama = $(this).attr("data-nama");
                let harga = $(this).attr("data-harga");
                let gambar = $(this).attr("data-gambar");

                if(myorder.length > 0){
                    if(myorder.indexOf(id) != -1){
                        alert("pesanan sudah dimasukan , silahkan menambahkan quantity di data pesanan");
                        return;
                    }   
                }
                myorder.push(id);
                let html ='<tr id="data_' + id + '">' +
                            '<td style="width: 50px">' + 
                                '<input type="hidden" name="masakan_id[]" value="' + id + '">' + 
                                '<input type="hidden" name="harga[]" value="' + harga + '">' +
                                '<button class="btn btn-danger delete_order" data-id="' + id + '" style="margin: 5px"><i class="fa fa-trash"></i></button>' +
                            '</td>' +
                            '<td> ' +
                                '<label>' + nama + '</label><br>' +
                                '<label>' + formatRupiah(harga,"Rp.") + '</label>' +
                            '</td>' +
                            '<td> ' +
                                '<input type="number" name="qty[]" data-id="' + id + '" data-harga="' + harga + '" value="1" style="width: 50px" class="form-control quantity" min="1" id="qty_' + id + '" >' +
                            '</td>' +
                            '<td> ' +
                                '<label style="text-align: right;width: 100%" id="total_' + id + '">' + formatRupiah(harga,"Rp.") + '</label>' +
                            '</td>' +
                        '</tr>';
                $("#data_pesanan").append(html);
                total_harga(myorder);
                $(".bayar").removeAttr('disabled');// Element(s) are now enabled.

            });
            $("#form_pesanan").on('keyup mouseup',".quantity", function () {
                let myqty = $(this).val();
                let id = $(this).attr("data-id");
                let harga = $(this).attr("data-harga");
                let total = parseInt(harga) * parseInt(myqty);
                total = total.toString();
                $("#form_pesanan #total_" + id).text(formatRupiah(total,"Rp."));
                total_harga(myorder);
            });
            $("#form_pesanan").on('click',".delete_order", function () {
               let id = $(this).attr("data-id");
                const index = myorder.indexOf(id);
                if (index > -1) {
                  myorder.splice(index, 1);
                }
               $("#form_pesanan #data_" + id).remove(); 
               total_harga(myorder);
            });
            function total_harga(data_id) {
                let total_harga_bayar = 0;
                console.log(data_id.length);
                for(let i=0;i < data_id.length;i++){
                    let id = data_id[i];
                    let qty_id = $("#form_pesanan #qty_" + id);
                    let harga = $(qty_id).attr("data-harga");
                    let qty = $(qty_id).val();
                    total_harga_bayar += parseInt(harga) * parseInt(qty);
                }
                $("#total_harga_bayar").val(formatRupiah(total_harga_bayar.toString(),"Rp."));
                $("input[name='total_harga_bayar']").val(total_harga_bayar);

            }
            function formatRupiah(angka, prefix){
                console.log(angka);
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split           = number_string.split(','),
                sisa            = split[0].length % 3,
                rupiah          = split[0].substr(0, sisa),
                ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
             
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
             
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
        })
    </script>
    <!-- <script src="<?php echo base_url() ?>assets/js/order/masakan.js"></script> -->
</body>
 
</html>