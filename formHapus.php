<?php

include "./config/app.php";

$id_laporan = (int)$_GET["id_laporan"];

if (delete_laporan($id_laporan) > 0) {
        echo "
            <script>
                alert('Data Berhasil Dihapus');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Dihapus');
                document.location.href = 'index.php';
            </script>
        ";
    }