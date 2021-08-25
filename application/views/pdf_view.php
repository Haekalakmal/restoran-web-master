<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Sariidaman  - STRUK PEMBAYARAN</title>
</head>
<body>
<h1 class="text-center bg-info">STRUK PEMBAYARAN</h1>

<h3>SARI IDAMAN</h3>
<table >
    <tr>
        <td colspan="3">------------------------------------------------------</td>

        <tr>
            <td>Nama</td>
            <td>: <?= $data[0]->nama; ?></td>
        </tr>

         <tr>
            <td>No meja</td>
            <td>: <?= $data[0]->no_meja; ?></td>
        </tr>

         <tr>
            <td>Tanggal dan waktu</td>
            
            <td>: <?= $data[0]->tanggal_waktu; ?></td>
        </tr>
    </tr>
</table>
<table style="width: 100%">

        <tr>
            <td colspan="4">--------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
    <?php foreach($data as $row => $value): ?>
        <tr>
            <td><?= $value->nama_masakan ?></td>
            <td><?= "Rp " . number_format($value->harga,0,',','.'); ?></td>
            <td>X <?= $value->qty ?></td>
            <?php $total = $value->qty * $value->harga; ?>
            <td style="text-align: right;"><?= "Rp " . number_format($total,0,',','.'); ?></td>
        </tr>
    <?php endforeach ?>

        <tr>
            <td colspan="4">--------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: left;">Total</td>
            <td colspan="3" style="text-align: right;"><?= "Rp " . number_format($data[0]->total_harga_bayar,0,',','.'); ?></td>
        </tr>

        <tr>
            <td colspan="4">--------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
</table>
</body>
</html>