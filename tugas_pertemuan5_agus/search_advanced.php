<?php
session_start();

// 1. Data Buku (Minimal 10)
$buku_list = [
    ['kode' => 'B001', 'judul' => 'Pemrograman PHP Modern', 'kategori' => 'Teknologi', 'pengarang' => 'Budi Raharjo', 'penerbit' => 'Informatika', 'tahun' => 2022, 'harga' => 150000, 'stok' => 5],
    ['kode' => 'B002', 'judul' => 'Seni Berpikir Kritis', 'kategori' => 'Filsafat', 'pengarang' => 'Henry Manampiring', 'penerbit' => 'Kompas', 'tahun' => 2019, 'harga' => 85000, 'stok' => 12],
    ['kode' => 'B003', 'judul' => 'Algoritma dan Struktur Data', 'kategori' => 'Teknologi', 'pengarang' => 'Rinaldi Munir', 'penerbit' => 'ITB Press', 'tahun' => 2021, 'harga' => 125000, 'stok' => 0],
    ['kode' => 'B004', 'judul' => 'Laskar Pelangi', 'kategori' => 'Sastra', 'pengarang' => 'Andrea Hirata', 'penerbit' => 'Bentang', 'tahun' => 2005, 'harga' => 89000, 'stok' => 20],
    ['kode' => 'B005', 'judul' => 'Clean Code', 'kategori' => 'Teknologi', 'pengarang' => 'Robert C. Martin', 'penerbit' => 'Prentice Hall', 'tahun' => 2008, 'harga' => 450000, 'stok' => 3],
    ['kode' => 'B006', 'judul' => 'Filosofi Teras', 'kategori' => 'Filsafat', 'pengarang' => 'Henry Manampiring', 'penerbit' => 'Kompas', 'tahun' => 2018, 'harga' => 98000, 'stok' => 15],
    ['kode' => 'B007', 'judul' => 'Hujan', 'kategori' => 'Sastra', 'pengarang' => 'Tere Liye', 'penerbit' => 'Gramedia', 'tahun' => 2016, 'harga' => 95000, 'stok' => 8],
    ['kode' => 'B008', 'judul' => 'Bumi', 'kategori' => 'Sastra', 'pengarang' => 'Tere Liye', 'penerbit' => 'Gramedia', 'tahun' => 2014, 'harga' => 105000, 'stok' => 0],
    ['kode' => 'B009', 'judul' => 'Mastering Laravel', 'kategori' => 'Teknologi', 'pengarang' => 'Christopher John', 'penerbit' => 'Packt', 'tahun' => 2023, 'harga' => 320000, 'stok' => 4],
    ['kode' => 'B010', 'judul' => 'Sejarah Dunia yang Disembunyikan', 'kategori' => 'Sejarah', 'pengarang' => 'Jonathan Black', 'penerbit' => 'Alvabet', 'tahun' => 2015, 'harga' => 135000, 'stok' => 7],
];

// 2. Ambil Parameter GET
$keyword   = $_GET['keyword'] ?? '';
$kategori  = $_GET['kategori'] ?? '';
$min_harga = $_GET['min_harga'] ?? '';
$max_harga = $_GET['max_harga'] ?? '';
$tahun     = $_GET['tahun'] ?? '';
$status    = $_GET['status'] ?? 'semua';
$sort      = $_GET['sort'] ?? 'judul';

// 3. Validasi
$errors = [];
if (!empty($min_harga) && !empty($max_harga) && $min_harga > $max_harga) {
    $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum.";
}
if (!empty($tahun) && ($tahun < 1900 || $tahun > date("Y"))) {
    $errors[] = "Tahun harus valid (1900 - " . date("Y") . ").";
}

// 4. Filtering & Search Logic
$hasil = [];
if (empty($errors)) {
    foreach ($buku_list as $buku) {
        // Cek Keyword (Judul/Pengarang)
        $matchKeyword = empty($keyword) || 
                        stripos($buku['judul'], $keyword) !== false || 
                        stripos($buku['pengarang'], $keyword) !== false;
        
        // Cek Kategori
        $matchKategori = empty($kategori) || $buku['kategori'] == $kategori;
        
        // Cek Harga
        $matchHarga = (empty($min_harga) || $buku['harga'] >= $min_harga) && 
                      (empty($max_harga) || $buku['harga'] <= $max_harga);
        
        // Cek Tahun
        $matchTahun = empty($tahun) || $buku['tahun'] == $tahun;
        
        // Cek Status
        $matchStatus = ($status == 'semua') || 
                       ($status == 'tersedia' && $buku['stok'] > 0) || 
                       ($status == 'habis' && $buku['stok'] == 0);

        if ($matchKeyword && $matchKategori && $matchHarga && $matchTahun && $matchStatus) {
            $hasil[] = $buku;
        }
    }
}

// 5. Sorting
usort($hasil, function($a, $b) use ($sort) {
    return $a[$sort] <=> $b[$sort];
});

// Bonus: Export CSV Logic
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="hasil_pencarian.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Kode', 'Judul', 'Kategori', 'Pengarang', 'Penerbit', 'Tahun', 'Harga', 'Stok']);
    foreach ($hasil as $row) fputcsv($output, $row);
    fclose($output);
    exit;
}

// Helper: Highlight Keyword
function highlight($text, $search) {
    if (empty($search)) return $text;
    return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<span class="bg-warning">$1</span>', $text);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pencarian Lanjut Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Sistem Pencarian Buku Lanjut</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Keyword (Judul/Pengarang)</label>
                        <input type="text" name="keyword" class="form-control" value="<?= htmlspecialchars($keyword) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            <option value="Teknologi" <?= $kategori == 'Teknologi' ? 'selected' : '' ?>>Teknologi</option>
                            <option value="Filsafat" <?= $kategori == 'Filsafat' ? 'selected' : '' ?>>Filsafat</option>
                            <option value="Sastra" <?= $kategori == 'Sastra' ? 'selected' : '' ?>>Sastra</option>
                            <option value="Sejarah" <?= $kategori == 'Sejarah' ? 'selected' : '' ?>>Sejarah</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" value="<?= htmlspecialchars($tahun) ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Urutkan Berdasarkan</label>
                        <select name="sort" class="form-select">
                            <option value="judul" <?= $sort == 'judul' ? 'selected' : '' ?>>Judul</option>
                            <option value="harga" <?= $sort == 'harga' ? 'selected' : '' ?>>Harga</option>
                            <option value="tahun" <?= $sort == 'tahun' ? 'selected' : '' ?>>Tahun</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Harga Min</label>
                        <input type="number" name="min_harga" class="form-control" value="<?= htmlspecialchars($min_harga) ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Harga Max</label>
                        <input type="number" name="max_harga" class="form-control" value="<?= htmlspecialchars($max_harga) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label d-block">Status Ketersediaan</label>
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="radio" name="status" value="semua" <?= $status == 'semua' ? 'checked' : '' ?>> Semua
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="tersedia" <?= $status == 'tersedia' ? 'checked' : '' ?>> Tersedia
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="habis" <?= $status == 'habis' ? 'checked' : '' ?>> Habis
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Cari Buku</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $e) echo "<li>$e</li>"; ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Hasil Ditemukan: <?= count($hasil) ?> buku</h5>
        <?php if(count($hasil) > 0): ?>
            <a href="?<?= $_SERVER['QUERY_STRING'] ?>&export=csv" class="btn btn-success btn-sm">Download CSV</a>
        <?php endif; ?>
    </div>

    <table class="table table-bordered table-striped bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Pengarang</th>
                <th>Tahun</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($hasil) > 0): ?>
                <?php foreach ($hasil as $row): ?>
                    <tr>
                        <td><?= $row['kode'] ?></td>
                        <td><?= highlight($row['judul'], $keyword) ?></td>
                        <td><?= $row['kategori'] ?></td>
                        <td><?= highlight($row['pengarang'], $keyword) ?></td>
                        <td><?= $row['tahun'] ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td>
                            <span class="badge <?= $row['stok'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                <?= $row['stok'] > 0 ? 'Tersedia (' . $row['stok'] . ')' : 'Habis' ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">Tidak ada data yang cocok.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>