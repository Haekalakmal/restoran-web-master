<!doctype html>
<html lang="en">
 
<head>
    <?php $this->load->view('_partials/head'); ?>
    <title>Data Transaksi</title>
    <style type="text/css">
        .notif_detail{
            background-color: white;
            padding: 5px;
            color:#5969ff;
            margin-right: 5px;
            border-radius: 99px;
        }
    </style>
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
                            <h2 class="pageheader-title">Data <?= $title ?></h2>
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
                            <div class="card-header" >
                                <h5 style="float: left;">
                                    Data <?= $title ?>
                                </h5>
                                <!-- <?php if(!$history): ?>
                                    <a href="<?php echo site_url('transaksi/history') ?>" class="btn btn-primary" style="float: right;width: 200px">History Transaksi</a>
                                <?php endif ?> -->
                                <div style="clear: both;"/>
                            </div>
                            
                            <div class="card-body">
                                <div class="info">
                                    <?php if ($this->session->flashdata('hapus')): ?>
                                        <div class="alert alert-danger">Sukses Menghapus Data</div>
                                    <?php endif ?>
                                    <?php if ($this->session->flashdata('push_notifikasi')): ?>
                                        <div class="alert alert-success">Berhasil mengirim notifikasi ke customer</div>
                                    <?php endif ?>
                                    <?php if ($this->session->flashdata('order_masakan')): ?>
                                        <div class="alert alert-success">Order masakan berhasil dibuat</div>
                                    <?php endif ?>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>No Meja</th>
                                                <th>Total Harga Bayar</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($transaksi === 'kosong'): ?>
                                                <tr>
                                                    <td colspan="5" align="center">Kosong</td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($transaksi as $key => $value): ?>
                                                    <tr>
                                                        <td><?php echo $key+1 ?></td>
                                                        <td><?php echo $value->nama ?></td>
                                                        <td><?php echo $value->no_meja ?></td>
                                                        <td><?php echo "Rp " . number_format($value->total_harga_bayar,0,',','.'); ?></td>
                                                        <td><?php echo $value->tanggal_waktu ?></td>
                                                        <td width="30%">
                                                            <a href="#" class="btn btn-primary btn-sm detail" data-id="<?= $value->ordermeja_id ?>">
                                                                <i class="fa fa-eye"></i>
                                                                <?php if($value->pesanan_baru): ?>
                                                                <span class="notif_detail" id="notif_<?= $value->ordermeja_id ?>"><i class="fa fa-bell"></i></span> 
                                                                <?php endif ?>
                                                            </a>
                                                            <?php 
                                                                if($history){ $url_print = site_url('transaksi/print_pdf_history/').$value->ordermeja_id; }
                                                                else{ $url_print = site_url('transaksi/print_pdf/').$value->ordermeja_id; }
                                                            ?>
                                                            <?php if($history): ?>
                                                            <a data-href="<?= $url_print ?>" class="btn btn-success btn-sm print_click"  style="color:white">
                                                                <span></span><i class="fa fa-print"></i>
                                                            </a>
                                                            <?php endif ?>

                                                            <?php if($this->session->userdata('role') == "Admin"){ ?>
                                                                <a href="<?php echo site_url('transaksi/hapus_data/').$value->id ?>" class="btn btn-danger btn-sm" style="color:white;">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            <?php } ?>


                                                            <?php if($this->session->userdata('role') != "Admin"){ ?>
                                                            
                                                                <?php if($value->status == 1): ?>
                                                                <a href="<?= site_url('transaksi/setProsesMasakan/'.$value->ordermeja_id) ?>" class="btn btn-warning btn-sm "  style="color:white">
                                                                    <span></span>Proses
                                                                </a>
                                                                <?php elseif ($value->status == 2): ?>
                                                                <a data-href="<?= site_url('transaksi/setKonfirmasiMasakan/'.$value->ordermeja_id) ?>" class="btn btn-success btn-sm link-ask" data-title="info" data-message="apakah anda yakin ingin konfirmasi pesanan ini?"  style="color:white">
                                                                    <span></span>Konfirmasi
                                                                </a>
                                                                <?php endif ?>
                                                                
                                                                <a data-href="<?php echo site_url('transaksi/hapus/').$value->id."/".$value->ordermeja_id ?>" class="btn btn-danger btn-sm link-ask-reason"  data-title="info hapus" data-message="Masukan alasan" style="color:white;">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                    
                                                            <?php } ?>                                                                
                                                        </td>
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
    </form>
    </div>
    </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="modal_detail" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Transaksi</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <table style="width: 100%" id="data_pesanan_baru">
            </table>
            <table style="width: 100%" id="data_pesanan">
                
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php $this->load->view('_partials/foot'); ?>
    <script type="text/javascript">
        $(function(){
            
            $(".print_click").on("click",function(){
                 window.open($(this).attr("data-href"), '_blank').focus();
                <?php if(!$history): ?>
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                <?php endif ?>
            });
            
            $(".detail").on("click",function(){
                let id = $(this).attr("data-id");
                $("#notif_" + id).remove();
                $.ajax({
                    url: "<?= site_url('transaksi/getDetailTransaksi/') ?>" + id,
                    type: "GET",
                    dataType: 'json',
                    success: (res) => {
                        console.log(res);
                        let html_pesanan_baru = "";
                        let html = "";
                        for(let i=0;i<res.length;i++){
                            let data = res[i];
                            let nama = data.nama_masakan;
                            let harga = data.harga;
                            let gambar = "<?php echo base_url('uploads/') ?>" + data.gambar;
                            let qty = data.qty;
                            let total = parseInt(qty) * parseInt(harga);
                            let pesanan_baru_detail = data.pesanan_baru_detail;
                            total = total.toString();
                            if(pesanan_baru_detail > 0){
                                if(i == 0){
                                    html_pesanan_baru += "<tr><td colspan='4' style='background-color:#e0e4ef;'><h4>Pesanan Baru</h4></td></tr>";
                                }
                                html_pesanan_baru +='<tr style="background-color:#e0e4ef;">' +
                                            '<td style="width: 50px">' + 
                                                '<img src="' + gambar + '" style="width:100px;margin:10px">' +
                                            '</td>' +
                                            '<td> ' +
                                                '<label>' + nama + '</label><br>' +
                                                '<label>' + formatRupiah(harga,"Rp.") + '</label>' +
                                            '</td>' +
                                            '<td> ' +
                                                '<label>' + qty + '</label>' +
                                            '</td>' +   
                                            '<td> ' +
                                                '<label style="text-align: right;width: 100%" id="total_' + id + '">' + formatRupiah(total,"Rp.") + '</label>' +
                                            '</td>' +
                                        '</tr>'; 
                            }else{
                                html +='<tr >' +
                                            '<td style="width: 50px">' + 
                                                '<img src="' + gambar + '" style="width:100px;margin:10px">' +
                                            '</td>' +
                                            '<td> ' +
                                                '<label>' + nama + '</label><br>' +
                                                '<label>' + formatRupiah(harga,"Rp.") + '</label>' +
                                            '</td>' +
                                            '<td> ' +
                                                '<label>' + qty + '</label>' +
                                            '</td>' +   
                                            '<td> ' +
                                                '<label style="text-align: right;width: 100%" id="total_' + id + '">' + formatRupiah(total,"Rp.") + '</label>' +
                                            '</td>' +
                                        '</tr>';    
                            }
                            
                        }                   

                        $("#data_pesanan_baru").html(html_pesanan_baru);
                        $("#data_pesanan").html(html);
                        $("#modal_detail").modal('show');             
                    },
                    error: () => alert("error")
                })
            })

            function formatRupiah(angka, prefix){
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
</body>
 
</html>