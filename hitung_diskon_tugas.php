<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon - Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Sistem Perhitungan Diskon Bertingkat</h1>
                
        <?php
        $nama_pembeli = "Muhammad Agus";
        $judul_buku = "Laravel Advanced";
        $harga_satuan = 150000;
        $jumlah_beli = 12;
        $is_member = true;

        $subtotal = $harga_satuan * $jumlah_beli;

        if ($jumlah_beli > 10) {
            $persentase_diskon = 20;
        } elseif ($jumlah_beli >= 6) {
            $persentase_diskon = 15;
        } elseif ($jumlah_beli >= 3) {
            $persentase_diskon = 10;
        } else {
            $persentase_diskon = 0;
        }

        $nilai_diskon_jumlah = ($persentase_diskon / 100) * $subtotal;

        $persentase_member = 0;
        $nilai_diskon_member = 0;
        if ($is_member) {
            $persentase_member = 5;
            $nilai_diskon_member = (5 / 100) * $subtotal;
        }

        $total_diskon_rp = $nilai_diskon_jumlah + $nilai_diskon_member;
        $total_setelah_diskon = $subtotal - $total_diskon_rp;

        $ppn = $total_setelah_diskon * 0.11;

        $total_akhir = $total_setelah_diskon + $ppn;

        $total_hemat = $total_diskon_rp;
        ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Nota Pembelian: <?php echo $nama_pembeli; ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <span>Status Pembeli:</span>
                            <span class="badge <?php echo $is_member ? 'bg-success' : 'bg-secondary'; ?>">
                                <?php echo $is_member ? 'Member (Bonus Diskon 5%)' : 'Non-Member'; ?>
                            </span>
                        </div>
                        
                        <table class="table table-striped">
                            <tr>
                                <th>Judul Buku</th>
                                <td class="text-end"><?php echo $judul_buku; ?></td>
                            </tr>
                            <tr>
                                <th>Harga Satuan x Jumlah</th>
                                <td class="text-end">Rp <?php echo number_format($harga_satuan, 0, ',', '.'); ?> x <?php echo $jumlah_beli; ?></td>
                            </tr>
                            <tr class="table-group-divider">
                                <th>Subtotal</th>
                                <td class="text-end">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Diskon Pembelian (<?php echo $persentase_diskon; ?>%)</th>
                                <td class="text-end text-danger">- Rp <?php echo number_format($nilai_diskon_jumlah, 0, ',', '.'); ?></td>
                            </tr>
                            <?php if ($is_member): ?>
                            <tr>
                                <th>Diskon Member (5%)</th>
                                <td class="text-end text-danger">- Rp <?php echo number_format($nilai_diskon_member, 0, ',', '.'); ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th>Total Setelah Diskon</th>
                                <td class="text-end fw-bold">Rp <?php echo number_format($total_setelah_diskon, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>PPN (11%)</th>
                                <td class="text-end">Rp <?php echo number_format($ppn, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-primary">
                                <th class="fs-5">Total Akhir</th>
                                <td class="text-end fs-5 fw-bold text-primary">Rp <?php echo number_format($total_akhir, 0, ',', '.'); ?></td>
                            </tr>
                        </table>

                        <div class="alert alert-info mt-3 py-2 text-center">
                            Anda berhasil hemat sebesar: <strong>Rp <?php echo number_format($total_hemat, 0, ',', '.'); ?></strong>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        Terima kasih telah berbelanja di Toko Buku kami!
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>