<?php

// 1. Data Anggota
$nama_anggota = "Budi Santoso";
$total_pinjaman = 2; // Jumlah buku yang sedang dipinjam
$buku_terlambat = 1; // Jumlah buku yang telat dikembalikan
$hari_keterlambatan = 5; // Hari

// --- LOGIKA PROGRAM ---

// Menghitung denda
$biaya_per_hari = 1000;
$total_denda = $buku_terlambat * $hari_keterlambatan * $biaya_per_hari;

// Maksimal denda adalah Rp 50.000
if ($total_denda > 50000) {
    $total_denda = 50000;
}

// Menentukan status peminjaman (IF-ELSEIF-ELSE)
$bisa_pinjam = false;
$pesan_status = "";

if ($buku_terlambat > 0) {
    $bisa_pinjam = false;
    $pesan_status = "Tidak bisa pinjam lagi karena ada buku yang terlambat.";
} elseif ($total_pinjaman >= 3) {
    $bisa_pinjam = false;
    $pesan_status = "Tidak bisa pinjam lagi karena kuota maksimal (3 buku) sudah terpenuhi.";
} else {
    $bisa_pinjam = true;
    $pesan_status = "Anggota diperbolehkan meminjam buku.";
}

// Menentukan Level Member (SWITCH)
// Karena SWITCH biasanya untuk nilai statis, kita gunakan switch(true) untuk mengecek range
switch (true) {
    case ($total_pinjaman >= 0 && $total_pinjaman <= 5):
        $level_member = "Bronze";
        break;
    case ($total_pinjaman >= 6 && $total_pinjaman <= 15):
        $level_member = "Silver";
        break;
    case ($total_pinjaman > 15):
        $level_member = "Gold";
        break;
    default:
        $level_member = "Tidak Diketahui";
}

// --- OUTPUT ---

echo "<h2>Informasi Anggota</h2>";
echo "Nama Anggota: $nama_anggota <br>";
echo "Level Member: <b>$level_member</b> <br>";
echo "Total Buku yang Dipinjam: $total_pinjaman <br>";

echo "<h2>Status Peminjaman Saat Ini</h2>";
echo "Status: " . ($bisa_pinjam ? "<span style='color:green'>Aktif</span>" : "<span style='color:red'>Ditangguhkan</span>") . "<br>";
echo "Keterangan: $pesan_status <br>";

if ($buku_terlambat > 0) {
    echo "<h3>Peringatan Keterlambatan</h3>";
    echo "Jumlah Buku Terlambat: $buku_terlambat <br>";
    echo "Total Hari Keterlambatan: $hari_keterlambatan hari <br>";
    echo "Total Denda: <b>Rp " . number_format($total_denda, 0, ',', '.') . "</b> <br>";
}

?>