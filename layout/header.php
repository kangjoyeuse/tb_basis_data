<?php
include './config/app.php';
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
                            <a href="crudModal.php" class="nav-link active"
                                >Akun</a
                            >
                            <a href="./logout.php" class="nav-link active"
                                >Log Out</a
                            >
                            <!-- <a class="nav-link" href="#">Mahasiswa</a>
                            <a class="nav-link" href="#">Modal</a> -->
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </body>
</html>
