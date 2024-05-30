<!-- Login Session -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
    include 'layout/header.php';
    $data_laporan = select("SELECT * FROM laporan");
?>
        <main class="container mt-5">
            <h1>Daftar Laporan</h1>
            <a href="formTambah.php" class="btn btn-primary mt-3 mb-4">Tambah</a>
            <table class="table table-striped table-bordered text-center" id="table">
                <thead>
                    <th>No</th>
                    <th>Nama Program</th>
                    <th>Anggaran</th>
                    <th>Realisasi Anggaran</th>
                    <th>Rasio Realisasi Anggaran</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_laporan as $laporan) :?>
                    <tr>
                        <!-- <td><?= $laporan["id_laporan"]; ?></td> -->
                        <td><?= $no++; ?></td>
                        <td><?= $laporan["nama_program"]?></td>
                        <td><?= $laporan["anggaran"]?></td>
                        <td><?= $laporan["realisasi_anggaran"]?></td>
                        <td><?= $laporan["rasio_realisasi_anggaran"]?></td>
                        <td><?= $laporan["keterangan"]?></td>
                        <td><?= date("d/m/y", strtotime($laporan["tanggal"]))?></td>
                        <td>
                            <a href="./formUbah.php?id_laporan=<?= $laporan["id_laporan"]; ?>" class="btn btn-warning btn-sm">Ubah</a>
                            <a href="./formHapus.php?id_laporan=<?= $laporan["id_laporan"]; ?>" class="btn btn-danger  btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </main>
<?php include 'layout/footer.php';?>