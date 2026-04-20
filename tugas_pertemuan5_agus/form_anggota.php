<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 1: Form Registrasi Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <?php
    // Inisialisasi variabel
    $errors = [];
    $success = false;
    $data = [];

    // Proses Form saat Submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telepon = trim($_POST['telepon'] ?? '');
        $alamat = trim($_POST['alamat'] ?? '');
        $jk = $_POST['jk'] ?? '';
        $tgl_lahir = $_POST['tgl_lahir'] ?? '';
        $pekerjaan = $_POST['pekerjaan'] ?? '';

        // 1. Validasi Nama (min 3 karakter)
        if (empty($nama) || strlen($nama) < 3) {
            $errors['nama'] = "Nama lengkap minimal 3 karakter.";
        }

        // 2. Validasi Email (format valid)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format email tidak valid.";
        }

        // 3. Validasi Telepon (08xxxxxxxxxx, 10-13 digit)
        if (!preg_match("/^08[0-9]{8,11}$/", $telepon)) {
            $errors['telepon'] = "Format telepon harus 08xxxxxxxxxx (10-13 digit).";
        }

        // 4. Validasi Alamat (min 10 karakter)
        if (empty($alamat) || strlen($alamat) < 10) {
            $errors['alamat'] = "Alamat minimal 10 karakter.";
        }

        // 5. Validasi Jenis Kelamin
        if (empty($jk)) {
            $errors['jk'] = "Pilih jenis kelamin.";
        }

        // 6. Validasi Tanggal Lahir (Min 10 Tahun)
        if (empty($tgl_lahir)) {
            $errors['tgl_lahir'] = "Tanggal lahir harus diisi.";
        } else {
            $lahir = new DateTime($tgl_lahir);
            $sekarang = new DateTime();
            $umur = $sekarang->diff($lahir)->y;
            if ($umur < 10) {
                $errors['tgl_lahir'] = "Umur minimal harus 10 tahun.";
            }
        }

        // 7. Validasi Pekerjaan
        if (empty($pekerjaan)) {
            $errors['pekerjaan'] = "Pilih pekerjaan.";
        }

        // Jika tidak ada error
        if (empty($errors)) {
            $success = true;
            $data = [
                'Nama' => $nama,
                'Email' => $email,
                'Telepon' => $telepon,
                'Alamat' => $alamat,
                'Jenis Kelamin' => $jk,
                'Tanggal Lahir' => $tgl_lahir,
                'Pekerjaan' => $pekerjaan
            ];
        }
    }

    // Fungsi Helper untuk Class Input
    function is_invalid($field, $errors) {
        return isset($errors[$field]) ? 'is-invalid' : '';
    }

    // Fungsi Helper untuk Keep Value
    function old($field) {
        return htmlspecialchars($_POST[$field] ?? '');
    }
    ?>

    <div class="row justify-content-center">
        <div class="col-md-7">
            <?php if ($success): ?>
                <div class="alert alert-success shadow">Registrasi Berhasil!</div>
                <div class="card mb-4 border-success shadow-sm">
                    <div class="card-header bg-success text-white">Data Anggota Baru</div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <?php foreach ($data as $key => $val): ?>
                                <tr><th width="150"><?= $key ?></th><td>: <?= $val ?></td></tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Registrasi Anggota</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST" novalidate>
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control <?= is_invalid('nama', $errors) ?>" value="<?= old('nama') ?>">
                            <div class="invalid-feedback"><?= $errors['nama'] ?? '' ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control <?= is_invalid('email', $errors) ?>" value="<?= old('email') ?>">
                            <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="telepon" class="form-control <?= is_invalid('telepon', $errors) ?>" value="<?= old('telepon') ?>" placeholder="08xxxxxxxxxx">
                            <div class="invalid-feedback"><?= $errors['telepon'] ?? '' ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control <?= is_invalid('alamat', $errors) ?>" rows="3"><?= old('alamat') ?></textarea>
                            <div class="invalid-feedback"><?= $errors['alamat'] ?? '' ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?= is_invalid('jk', $errors) ?>" type="radio" name="jk" id="laki" value="Laki-laki" <?= (isset($_POST['jk']) && $_POST['jk'] == 'Laki-laki') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?= is_invalid('jk', $errors) ?>" type="radio" name="jk" id="perempuan" value="Perempuan" <?= (isset($_POST['jk']) && $_POST['jk'] == 'Perempuan') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                            <?php if(isset($errors['jk'])): ?> <div class="text-danger small mt-1"><?= $errors['jk'] ?></div> <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control <?= is_invalid('tgl_lahir', $errors) ?>" value="<?= old('tgl_lahir') ?>">
                            <div class="invalid-feedback"><?= $errors['tgl_lahir'] ?? '' ?></div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Pekerjaan</label>
                            <select name="pekerjaan" class="form-select <?= is_invalid('pekerjaan', $errors) ?>">
                                <option value="">-- Pilih Pekerjaan --</option>
                                <?php
                                $opsi = ['Pelajar', 'Mahasiswa', 'Pegawai', 'Lainnya'];
                                foreach ($opsi as $o) {
                                    $selected = (isset($_POST['pekerjaan']) && $_POST['pekerjaan'] == $o) ? 'selected' : '';
                                    echo "<option value='$o' $selected>$o</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback"><?= $errors['pekerjaan'] ?? '' ?></div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>