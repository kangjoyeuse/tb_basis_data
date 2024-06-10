<?php
    $title = "Daftar Akun";

    include 'layout/header.php';

    $data_akun = select("SELECT * FROM akun");

    if (isset($_POST["tambah"])) {
        if(create_akun($_POST) > 0) {
            echo "
                <script>
                    alert('Data AkunBerhasil Ditambahkan');
                    document.location.href = 'crudModal.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Akun Gagal Ditambahkan');
                    document.location.href = 'crudModal.php';
                </script>
            ";
        }
    }

    if (isset($_POST["ubah"])) {
        if(ubah_akun($_POST) > 0) {
            echo "
                <script>
                    alert('Data Akun Berhasil Diubah');
                    document.location.href = 'crudModal.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Akun Gagal Diubah');
                    document.location.href = 'crudModal.php';
                </script>
            ";
        }
    }

?>
<main class="container mt-5">
    <h1>Daftar Akun</h1>
    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambah"
    >
        Tambah
    </button>
    <table
        class="table table-striped table-bordered mt-4 text-center"
        id="table"
    >
        <thead>
            <th class="align-middle text-center">No</th>
            <th class="align-middle text-center">Nama</th>
            <th class="align-middle text-center">Username</th>
            <th class="align-middle text-center">Email</th>
            <th class="align-middle text-center">Password</th>
            <th class="align-middle text-center">Aksi</th>
        </thead>
        <tbody>
            <?php foreach ($data_akun as $akun) :?>
            <tr>
                <td class="text-center align-middle"><?= $akun["id_akun"];?></td>
                <td class="text-center align-middle"><?= $akun["nama_akun"];?></td>
                <td class="text-center align-middle"><?= $akun["username"];?></td>
                <td class="text-center align-middle"><?= $akun["email"];?></td>
                <td class="text-center align-middle"><?= $akun["password"];?></td>
                <td class="text-center align-middle">
                    <button
                        type="button"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#modalUbah<?= $akun["id_akun"]; ?>"
                    >
                        Ubah
                    </button>
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#modalHapus<?= $akun["id_akun"]; ?>"
                    >
                        Hapus
                    </button>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</main>

<!-- Modal Tambah -->
<div
    class="modal fade"
    id="modalTambah"
    tabindex="-1"
    aria-labelledby="modalTambahLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="modalTambahLabel">
                    Tambah Akun
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select
                            name="level"
                            id="level"
                            class="form-control"
                            required
                        >
                            <option value="">-- Pilih --</option>
                            <option value="1">Admin</option>
                            <option value="2">Operator</option>
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
                            name="tambah"
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


<!-- Modal Ubah -->
 <div
    class="modal fade"
    id="modalUbah<?= $akun["id_akun"]; ?>"
    tabindex="-1"
    aria-labelledby="modalUbahLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="modalUbahLabel">
                    Ubah Akun
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id_akun" value="<?= $akun["id_akun"]; ?>">
                    <div class="mb-3">
                        <label for="nama">Nama</label>  
                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            class="form-control"
                            value="<?= $akun["nama_akun"];?>"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            class="form-control"
                            value="<?=$akun["username"];?>"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            value="<?= $akun["email"];?>"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Masukan password baru/lama"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select
                            name="level"
                            id="level"
                            class="form-control"
                            required
                        >
                            <?php $level = $akun["level"];?>
                            <option value="1" <?= $level == "1" ? "selected" : null?>>Admin</option>
                            <option value="2" <?= $level == "2" ? "selected" : null?>>Operator</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Kembali
                        </button>
                        <button
                            type="submit"
                            name="ubah"
                            class="btn btn-success"
                        >
                            Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<?php foreach ($data_akun as $akun) :?>
<div
    class="modal fade"
    id="modalHapus<?= $akun["id_akun"]; ?>"
    tabindex="-1"
    aria-labelledby="modalHapusLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title fs-5" id="modalHapusLabel">
                    Hapus Akun
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"  
                ></button>
            </div>
            <div class="modal-body">
                <p>Yakin Ingin Menghapus Akun: <?= $akun["nama_akun"]; ?> ?</p>
            </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Kembali
                        </button>
                        <a href="./hapusAkun.php?id_akun=<?= $akun["id_akun"]; ?>" class="btn btn-danger">Hapus</a>
                    </div>

        </div>
    </div>
</div>
<?php endforeach;?>

<?php include 'layout/footer.php';?>
