<?php   
include './config/app.php';

// Menonaktifkan laporan kesalahan untuk pesan tertentu
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id']; // Asumsi user_id disimpan di session saat login
$query = "SELECT nama_akun, level FROM akun WHERE id_akun = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Bootstrap demo</title>

        <!-- Bootstrap CSS -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        />

        <!-- DataTables CSS -->
        <link
            rel="stylesheet"
            type="text/css"
            href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css"
        />

        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav
                class="navbar navbar-expand-lg bg-body-tertiary"
                data-bs-theme="dark"
            >
                <div class="container">
                    <a class="navbar-brand" href="../tb-basis-data/index.php"
                        >CRUD PHP</a
                    >
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup"
                        aria-controls="navbarNavAltMarkup"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div
                        class="collapse navbar-collapse"
                        id="navbarNavAltMarkup"
                    >
                        <div class="navbar-nav">
                            <a
                                class="nav-link active"
                                   aria-current="page"
                                href="./index.php"
                                >Laporan</a
                            >
                            <?php if ($user && $user['level'] == 1): ?>
                            <a href="crudModal.php" class="nav-link active">Akun</a>
                            <?php endif; ?>
                            <a href="./logout.php" class="nav-link active"
                                >Log Out</a
                            >
                            <!-- <a class="nav-link" href="#">Mahasiswa</a>
                            <a class="nav-link" href="#">Modal</a> -->
                        </div>
                        <div class="navbar-text ms-auto">
                            <?php if ($user): ?>
                                <span class="me-3">Hello, <?= $user['nama_akun']; ?>!</span>
                                <span class="badge bg-<?= $user['level'] == 1 ? 'primary' : 'secondary'; ?>">
                                    <?= $user['level'] == 1 ? 'Admin' : 'Operator'; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </body>
</html>
