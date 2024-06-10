<?php
include 'config/database.php';

if (isset($_GET['id_akun'])) {
    $id_akun = $_GET['id_akun'];

    // Query untuk menghapus akun berdasarkan id_akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        echo "
            <script>
                alert('Akun berhasil dihapus');
                document.location.href = 'crudModal.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Akun gagal dihapus');
                document.location.href = 'crudModal.php';
            </script>
        ";
    }
} else {
    echo "
        <script>
            alert('ID akun tidak ditemukan');
            document.location.href = 'crudModal.php';
        </script>
    ";
}
?>