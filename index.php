<?php
    include 'layout/header.php';
    $data_laporan = select("SELECT * FROM laporan");
?>
        <main class="container mt-5">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Daftar Laporan</h1>
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formTambahModal">
                    Tambah
                </button>
            </div>

            <!-- Grafik -->
            <div class="row">
                <div class="col-md-6">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <table class="table table-striped table-bordered table-responsive text-center" id="table">
                <thead>
                    <th class="align-middle text-center">No</th>
                    <th class="align-middle text-center">Nama Program</th>
                    <th class="align-middle text-center">Anggaran</th>
                    <th class="align-middle text-center">Realisasi Anggaran</th>
                    <th class="align-middle text-center">Rasio Realisasi Anggaran</th>
                    <th class="align-middle text-center">Keterangan</th>
                    <th class="align-middle text-center">Tanggal</th>
                    <th class="align-middle text-center">Aksi</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_laporan as $laporan) :?>
                    <tr>
                            <td class="text-center align-middle"><?= $no++; ?></td>
                            <td class="text-center align-middle"><?= $laporan["nama_program"]?></td>
                            <td class="text-center align-middle"><?= 'Rp ' . number_format($laporan["anggaran"], 2, ',', '.') ?></td>
                            <td class="text-center align-middle"><?= 'Rp ' . number_format($laporan["realisasi_anggaran"], 2, ',', '.') ?></td>
                            <td class="text-center align-middle"><?= number_format(($laporan["realisasi_anggaran"] / $laporan["anggaran"]) * 100, 2, ',', '.') . '%' ?></td>
                            <td class="text-center align-middle"><?= $laporan["keterangan"]?></td>
                            <td class="text-center align-middle"><?= date("d/m/y", strtotime($laporan["tanggal"]))?></td>
                            <td class="text-center align-middle" width="20%">
                                <!-- <a href="./formUbah.php?id_laporan=<?= $laporan["id_laporan"]; ?>" class="btn btn-success btn-sm">Ubah</a> -->
                                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#formUbahModal<?= $laporan["id_laporan"]; ?>">Ubah</a>
                                <a href="./formHapus.php?id_laporan=<?= $laporan["id_laporan"]; ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </main>

<!-- Modal Tambah -->
<div class="modal fade" id="formTambahModal" tabindex="-1" role="dialog" aria-labelledby="formTambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="formTambahModalLabel">Tambah Laporan</h5>
            </div>
            <div class="modal-body">
                <form action="formTambah.php" method="post">
                    <div class="form-group mt-3">
                        <label for="nama_program">Nama Program</label>
                        <input type="text" class="form-control" id="nama_program" name="nama_program" placeholder="Nama Program..." required />
                    </div>
                    <div class="form-group mt-3">
                        <label for="anggaran">Anggaran</label>
                        <input type="number" class="form-control" id="anggaran" name="anggaran" placeholder="Anggaran..." required />
                    </div>
                    <div class="form-group mt-3">
                        <label for="realisasi_anggaran">Realisasi Anggaran</label>
                        <input type="number" class="form-control" id="realisasi_anggaran" name="realisasi_anggaran" placeholder="Realisasi Anggaran..." required />
                    </div>
                    <div class="form-group mt-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Tutup
                        </button>
                        <button
                            type="submit"
                            name="submit"
                            class="btn btn-primary"
                        >
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Ubah Modal -->
<?php foreach ($data_laporan as $laporan) : ?>
<div class="modal fade" id="formUbahModal<?= $laporan["id_laporan"]; ?>" tabindex="-1" role="dialog" aria-labelledby="formUbahModalLabel<?= $laporan["id_laporan"]; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="formUbahModalLabel<?= $laporan["id_laporan"]; ?>">Ubah Laporan</h5>
            </div>
            <div class="modal-body">
                <form action="formUbah.php" method="post">
                    <input type="hidden" name="id_laporan" value="<?= $laporan["id_laporan"]; ?>">
                    <div class="form-group mt-3">
                        <label for="nama_program">Nama Program</label>
                        <input type="text" class="form-control" id="nama_program" name="nama_program" placeholder="Nama Program..." value="<?= $laporan["nama_program"]?>" required />
                    </div>
                    <div class="form-group mt-3">
                        <label for="anggaran">Anggaran</label>
                        <input type="number" class="form-control" id="anggaran" name="anggaran" placeholder="Anggaran..." value="<?= $laporan["anggaran"]?>" required />
                    </div>
                    <div class="form-group mt-3">
                        <label for="realisasi_anggaran">Realisasi Anggaran</label>
                        <input type="number" class="form-control" id="realisasi_anggaran" name="realisasi_anggaran" placeholder="Realisasi Anggaran..." value="<?= $laporan["realisasi_anggaran"]?>" required />
                    </div>
                    <div class="form-group mt-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan..." required><?= $laporan["keterangan"]?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="submit" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Script untuk Chart.js -->
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Jenis grafik: bar, line, pie, dll.
        data: {
            labels: [<?php foreach ($data_laporan as $laporan) { echo '"' . $laporan["nama_program"] . '",'; } ?>],
            datasets: [{
                label: 'Anggaran',
                data: [<?php foreach ($data_laporan as $laporan) { echo $laporan["anggaran"] . ','; } ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Realisasi Anggaran',
                data: [<?php foreach ($data_laporan as $laporan) { echo $laporan["realisasi_anggaran"] . ','; } ?>],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include 'layout/footer.php';?>