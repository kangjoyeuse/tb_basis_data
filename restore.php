<?php
if (isset($_POST['restore'])) {
    $databaseHost = '127.0.0.1:3306';
    $databaseName = 'tb_basis_data';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $file = $_FILES['restoreFile']['tmp_name'];

    if (file_exists($file)) {
        $sqlScript = file_get_contents($file);

        $queries = explode(';', $sqlScript);
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $mysqli->query($query);
            }
        }

        echo "<script>alert('Database restored successfully');</script>";
    } else {
        echo "<script>alert('Please upload a valid SQL file');</script>";
    }
}
?>