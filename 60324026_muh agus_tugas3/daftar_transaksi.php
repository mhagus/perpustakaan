<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Transaksi Peminjaman</h1>

        <?php
        // Inisialisasi statistik
        $total_transaksi_tampil = 0;
        $total_dipinjam = 0;
        $total_dikembalikan = 0;

        // Loop pertama untuk hitung statistik (mengikuti batasan yang akan ditampilkan di tabel)
        for ($i = 1; $i <= 10; $i++) {
            // Skip genap & Break di 8 sesuai aturan tabel agar statistik sinkron
            if ($i % 2 == 0) continue;
            if ($i > 8) break;

            $total_transaksi_tampil++;
            
            // Logika status sesuai gambar: ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam"
            if ($i % 3 == 0) {
                $total_dikembalikan++;
            } else {
                $total_dipinjam++;
            }
        }
        ?>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Ditampilkan</h5>
                        <p class="card-text fs-3"><?php echo $total_transaksi_tampil; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Masih Dipinjam</h5>
                        <p class="card-text fs-3"><?php echo $total_dipinjam; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Sudah Dikembalikan</h5>
                        <p class="card-text fs-3"><?php echo $total_dikembalikan; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Hari</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no_urut = 1;
                for ($i = 1; $i <= 10; $i++) {
                    // 1. Skip transaksi genap dengan CONTINUE
                    if ($i % 2 == 0) continue;

                    // 2. Stop di transaksi ke-8 dengan BREAK
                    if ($i > 8) break;

                    // Generate Data sesuai instruksi gambar
                    $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                    $nama_peminjam = "Anggota " . $i;
                    $judul_buku = "Buku Teknologi Vol. " . $i;
                    $tanggal_pinjam = date('Y-m-d', strtotime("-$i days"));
                    $tanggal_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam)));
                    $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

                    // Hitung jumlah hari sejak pinjam (sampai hari ini)
                    $tgl_skrg = time();
                    $tgl_awal = strtotime($tanggal_pinjam);
                    $selisih_hari = round(($tgl_skrg - $tgl_awal) / (60 * 60 * 24));

                    // Tentukan warna badge status
                    $badge_color = ($status == "Dikembalikan") ? "bg-success" : "bg-warning text-dark";
                    ?>
                    <tr>
                        <td><?php echo $no_urut++; ?></td>
                        <td><?php echo $id_transaksi; ?></td>
                        <td><?php echo $nama_peminjam; ?></td>
                        <td><?php echo $judul_buku; ?></td>
                        <td><?php echo $tanggal_pinjam; ?></td>
                        <td><?php echo $tanggal_kembali; ?></td>
                        <td><?php echo $selisih_hari; ?> hari</td>
                        <td>
                            <span class="badge <?php echo $badge_color; ?>">
                                <?php echo $status; ?>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>