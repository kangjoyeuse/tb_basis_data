

<?php include 'layout/header.php';

if (isset($_POST["submit"])) {
    if (create_laporan($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>
<main class="container mt-5">
    <h1>Tambah Laporan</h1>
    <form action="" method="post">
        <div class="form-group mt-3">
            <label for="nama_program">Nama Program</label>
            <input
                type="text"
                class="form-control"
                id="nama_program"
                name="nama_program"
                placeholder="Nama Program..."
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
                required
            />
        </div>
        <div class="form-group mt-3">
            <label for="rasio_realisasi_anggaran">Rasio Realisasi Anggaran</label>
            <input
                type="number"
                step="0.01"
                class="form-control"
                id="rasio_realisasi_anggaran"
                name="rasio_realisasi_anggaran"
                placeholder="Rasio Realisasi Anggaran..."
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
            ></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mb-2  mt-3">Tambah</button>
    </form>
</main>
<?php include 'layout/footer.php';?>