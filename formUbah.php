<?php

include 'layout/header.php';
include "./config/auth.php";

$id_laporan = (int)$_GET["id_laporan"];


$laporan = select("SELECT * FROM laporan WHERE id_laporan = $id_laporan")[0];

if (isset($_POST["submit"])) {
    if (ubah_laporan($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Diubah');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Diubah');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>
<main class="container mt-5">
    <h1>Ubah Laporan</h1>
    <form action="" method="post">
        <input type="hidden" name="id_laporan" value="<?= $laporan["id_laporan"]; ?>">
        <div class="form-group mt-3">
            <label for="nama_program">Nama Program</label>
            <input
                type="text"
                class="form-control"
                id="nama_program"
                name="nama_program"
                placeholder="Nama Program..."
                value="<?= $laporan["nama_program"]?>"
                required
            />
        </div>
        <div class="form-group mt-3">
            <label for="anggaran">Anggaran</label>
            <input
                type="number"
                class="form-control"
                id="anggaran"
                name="anggaran"
                placeholder="Anggaran..."
                value="<?= $laporan["anggaran"]?>"
                required
            />
        </div>
        <div class="form-group mt-3">
            <label for="realisasi_anggaran">Realisasi Anggaran</label>
            <input
                type="number"
                class="form-control"
                id="realisasi_anggaran"
                name="realisasi_anggaran"
                placeholder="Realisasi Anggaran..."
                value="<?= $laporan["realisasi_anggaran"]?>"
                required
            />
        </div>
        <div class="form-group mt-3">
            <label for="keterangan">Keterangan</label>
            <textarea
                class="form-control"
                id="keterangan"
                name="keterangan"
                placeholder="Keterangan..."
                required
            ><?= $laporan["keterangan"]?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mb-2  mt-3">Ubah</button>
    </form>
    <script>

    </script>
</main>
<?php include 'layout/footer.php';?>