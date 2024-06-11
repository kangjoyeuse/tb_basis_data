<?php
    include 'layout/header.php';
    include "./config/auth.php";
    $data_laporan = select("SELECT * FROM laporan");
    $data_laporan_aggregate = select("SELECT COUNT(*) AS total_laporan, SUM(anggaran) AS total_anggaran FROM laporan");
    $data_laporan_view = select("SELECT * FROM laporan_view");

?>
        <main class="container mt-5">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Daftar Laporan</h1>
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formTambahModal">
                    <span class="fas fa-plus"></span> Tambah
                </button>                
            </div>
            <!-- Button to download CSV -->
            <button type="button" class="btn btn-secondary" onclick="downloadCSV()">
                <span class="fas fa-download"></span> Unduh CSV
            </button>
            <!-- Button to download Excel -->
            <button type="button" class="btn btn-secondary" onclick="downloadExcel()">
                <span class="fas fa-download"></span> Unduh Excel
            </button>
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
                                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#formUbahModal<?= $laporan["id_laporan"]; ?>"><span class="fas fa-pen"></span> Ubah</a>
                                <a href="./formHapus.php?id_laporan=<?= $laporan["id_laporan"]; ?>" class="btn btn-danger btn-sm"><span class="fas fa-delete-left"></span> Hapus</a>
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
                        <input type="number" class="form-control" id="anggaran" name="anggaran" placeholder="Anggaran..."  required/>
                    </div>
                    <div class="form-group mt-3">
                        <label for="realisasi_anggaran">Realisasi Anggaran</label>
                        <input type="number" class="form-control" id="realisasi_anggaran" name="realisasi_anggaran" placeholder="Realisasi Anggaran..."  required/>
                    </div>
                    <div class="form-group mt-3">
                        <label for="keterangan">Keterangan</label>
                        <select class="form-control" id="keterangan" name="keterangan" required>
                            <option value="" selected>Pilih Keterangan...</option>
                            <option value="" <?= $laporan["keterangan"] == "" ? "selected" : "" ?>>Tidak ada keterangan</option>
                            <option value="Penginputan Data" <?= $laporan["keterangan"] == "Penginputan Data" ? "selected" : "" ?>>Penginputan Data</option>
                        </select>
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
                        <select class="form-control" id="keterangan" name="keterangan" required>
                            <option value="">Pilih Keterangan...</option>
                            <option value="" <?= $laporan["keterangan"] == "" ? "selected" : "" ?>>Tidak ada keterangan</option>
                            <option value="Perubahan Anggaran" <?= $laporan["keterangan"] == "Perubahan Anggaran" ? "selected" : "" ?>>Perubahan Anggaran</option>
                            <option value="Perubahan Realisasi Anggaran" <?= $laporan["keterangan"] == "Perubahan Realisasi Anggaran" ? "selected" : "" ?>>Perubahan Realisasi Anggaran</option>
                            <option value="Kesalahan Penginputan Data" <?= $laporan["keterangan"] == "Kesalahan Penginputan Data" ? "selected" : "" ?>>Kesalahan Penginputan Data</option>
                        </select>
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

<script>
function downloadCSV() {
    // Data laporan dari PHP
    const dataLaporan = <?= json_encode($data_laporan) ?>;

    // Membuat header CSV
    const headers = ['No', 'Nama Program', 'Anggaran', 'Realisasi Anggaran', 'Rasio Realisasi Anggaran', 'Keterangan', 'Tanggal'];
    let csvContent = "data:text/csv;charset=utf-8," + headers.join(",") + "\n";

    // Menambahkan data laporan ke CSV
    dataLaporan.forEach((laporan, index) => {
        const row = [
            index + 1,
            laporan.nama_program,
            laporan.anggaran,
            laporan.realisasi_anggaran,
            ((laporan.realisasi_anggaran / laporan.anggaran) * 100).toFixed(2) + '%',
            laporan.keterangan,
            new Date(laporan.tanggal).toLocaleDateString('id-ID')
        ];
        csvContent += row.join(",") + "\n";
    });

    // Membuat link untuk mengunduh file CSV
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "data_laporan.csv");
    document.body.appendChild(link);

    // Klik link untuk mengunduh file
    link.click();
    document.body.removeChild(link);
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<script>
function downloadCSV() {
    // Data laporan dari PHP
    const dataLaporan = <?= json_encode($data_laporan) ?>;

    // Membuat header CSV
    const headers = ['No', 'Nama Program', 'Anggaran', 'Realisasi Anggaran', 'Rasio Realisasi Anggaran', 'Keterangan', 'Tanggal'];
    let csvContent = "data:text/csv;charset=utf-8," + headers.join(",") + "\n";

    // Menambahkan data laporan ke CSV
    dataLaporan.forEach((laporan, index) => {
        const row = [
            index + 1,
            laporan.nama_program,
            laporan.anggaran,
            laporan.realisasi_anggaran,
            ((laporan.realisasi_anggaran / laporan.anggaran) * 100).toFixed(2) + '%',
            laporan.keterangan,
            new Date(laporan.tanggal).toLocaleDateString('id-ID')
        ];
        csvContent += row.join(",") + "\n";
    });

    // Membuat link untuk mengunduh file CSV
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "data_laporan.csv");
    document.body.appendChild(link);

    // Klik link untuk mengunduh file
    link.click();
    document.body.removeChild(link);
}

function downloadExcel() {
    // Data laporan dari PHP
    const dataLaporan = <?= json_encode($data_laporan) ?>;

    // Membuat header Excel
    const headers = ['No', 'Nama Program', 'Anggaran', 'Realisasi Anggaran', 'Rasio Realisasi Anggaran', 'Keterangan', 'Tanggal'];
    const data = dataLaporan.map((laporan, index) => [
        index + 1,
        laporan.nama_program,
        laporan.anggaran,
        laporan.realisasi_anggaran,
        ((laporan.realisasi_anggaran / laporan.anggaran) * 100).toFixed(2) + '%',
        laporan.keterangan,
        new Date(laporan.tanggal).toLocaleDateString('id-ID')
    ]);

    // Gabungkan header dan data
    const worksheetData = [headers, ...data];

    // Buat worksheet dan workbook
    const worksheet = XLSX.utils.aoa_to_sheet(worksheetData);
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Laporan");

    // Unduh file Excel
    XLSX.writeFile(workbook, "data_laporan.xlsx");
}
</script>

<?php include 'layout/footer.php';?>