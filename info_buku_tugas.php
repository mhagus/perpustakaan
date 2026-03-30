<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Buku Tugas - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Informasi Buku</h1>
        
        <?php
        // Buku 1
        $judul1 = "Laravel: From Beginner to Advanced";
        $pengarang1 = "Budi Raharjo";
        $penerbit1 = "Informatika";
        $tahun_terbit1 = 2023;
        $harga1 = 125000;
        $stok1 = 8;
        $isbn1 = "978-602-1234-56-7";
        $kategori1 = "Programming";
        $bahasa1 = "Indonesia";
        $halaman1 = 450;
        $berat1 = 500;

        // Buku 2
        $judul2 = "MySQL Database Administration";
        $pengarang2 = "Achmad Solichin";
        $penerbit2 = "Penerbit Kita";
        $tahun_terbit2 = 2022;
        $harga2 = 95000;
        $stok2 = 5;
        $isbn2 = "978-602-9876-54-3";
        $kategori2 = "Database";
        $bahasa2 = "Indonesia";
        $halaman2 = 320;
        $berat2 = 400;

        // Buku 3
        $judul3 = "UI/UX Design Essentials";
        $pengarang3 = "Jessica Adams";
        $penerbit3 = "Global Tech";
        $tahun_terbit3 = 2021;
        $harga3 = 210000;
        $stok3 = 3;
        $isbn3 = "978-123-4455-66-0";
        $kategori3 = "Web Design";
        $bahasa3 = "Inggris";
        $halaman3 = 280;
        $berat3 = 350;

        // Buku 4
        $judul4 = "Pemrograman PHP Modern";
        $pengarang4 = "Sandhika Galih";
        $penerbit4 = "EduMedia";
        $tahun_terbit4 = 2024;
        $harga4 = 155000;
        $stok4 = 12;
        $isbn4 = "978-602-5566-77-8";
        $kategori4 = "Programming";
        $bahasa4 = "Indonesia";
        $halaman4 = 510;
        $berat4 = 600;
        ?>

        <div class="row g-4 mb-5">
            <!-- Tampilan Buku 1 -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><?php echo $judul1; ?></h5>
                        <span class="badge bg-danger"><?php echo $kategori1; ?></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr><th width="180">Pengarang</th><td>: <?php echo $pengarang1; ?></td></tr>
                            <tr><th>Penerbit</th><td>: <?php echo $penerbit1; ?> (<?php echo $tahun_terbit1; ?>)</td></tr>
                            <tr><th>ISBN</th><td>: <?php echo $isbn1; ?></td></tr>
                            <tr><th>Bahasa</th><td>: <?php echo $bahasa1; ?></td></tr>
                            <tr><th>Jumlah Halaman</th><td>: <?php echo $halaman1; ?> hlm</td></tr>
                            <tr><th>Berat Buku</th><td>: <?php echo $berat1; ?> gram</td></tr>
                            <tr><th>Harga</th><td>: Rp <?php echo number_format($harga1, 0, ',', '.'); ?></td></tr>
                            <tr><th>Stok</th><td>: <?php echo $stok1; ?> buku</td></tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tampilan Buku 2 -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><?php echo $judul2; ?></h5>
                        <span class="badge bg-success"><?php echo $kategori2; ?></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr><th width="180">Pengarang</th><td>: <?php echo $pengarang2; ?></td></tr>
                            <tr><th>Penerbit</th><td>: <?php echo $penerbit2; ?> (<?php echo $tahun_terbit2; ?>)</td></tr>
                            <tr><th>ISBN</th><td>: <?php echo $isbn2; ?></td></tr>
                            <tr><th>Bahasa</th><td>: <?php echo $bahasa2; ?></td></tr>
                            <tr><th>Jumlah Halaman</th><td>: <?php echo $halaman2; ?> hlm</td></tr>
                            <tr><th>Berat Buku</th><td>: <?php echo $berat2; ?> gram</td></tr>
                            <tr><th>Harga</th><td>: Rp <?php echo number_format($harga2, 0, ',', '.'); ?></td></tr>
                            <tr><th>Stok</th><td>: <?php echo $stok2; ?> buku</td></tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tampilan Buku 3 -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><?php echo $judul3; ?></h5>
                        <span class="badge bg-warning text-dark"><?php echo $kategori3; ?></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr><th width="180">Pengarang</th><td>: <?php echo $pengarang3; ?></td></tr>
                            <tr><th>Penerbit</th><td>: <?php echo $penerbit3; ?> (<?php echo $tahun_terbit3; ?>)</td></tr>
                            <tr><th>ISBN</th><td>: <?php echo $isbn3; ?></td></tr>
                            <tr><th>Bahasa</th><td>: <?php echo $bahasa3; ?></td></tr>
                            <tr><th>Jumlah Halaman</th><td>: <?php echo $halaman3; ?> hlm</td></tr>
                            <tr><th>Berat Buku</th><td>: <?php echo $berat3; ?> gram</td></tr>
                            <tr><th>Harga</th><td>: Rp <?php echo number_format($harga3, 0, ',', '.'); ?></td></tr>
                            <tr><th>Stok</th><td>: <?php echo $stok3; ?> buku</td></tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tampilan Buku 4 -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><?php echo $judul4; ?></h5>
                        <span class="badge bg-danger"><?php echo $kategori4; ?></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr><th width="180">Pengarang</th><td>: <?php echo $pengarang4; ?></td></tr>
                            <tr><th>Penerbit</th><td>: <?php echo $penerbit4; ?> (<?php echo $tahun_terbit4; ?>)</td></tr>
                            <tr><th>ISBN</th><td>: <?php echo $isbn4; ?></td></tr>
                            <tr><th>Bahasa</th><td>: <?php echo $bahasa4; ?></td></tr>
                            <tr><th>Jumlah Halaman</th><td>: <?php echo $halaman4; ?> hlm</td></tr>
                            <tr><th>Berat Buku</th><td>: <?php echo $berat4; ?> gram</td></tr>
                            <tr><th>Harga</th><td>: Rp <?php echo number_format($harga4, 0, ',', '.'); ?></td></tr>
                            <tr><th>Stok</th><td>: <?php echo $stok4; ?> buku</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>