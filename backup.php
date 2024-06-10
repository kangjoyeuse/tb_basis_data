<?php
if (isset($_POST['backup'])) {
    $databaseHost = '127.0.0.1:3306';
    $databaseName = 'tb_basis_data';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $tables = array();
    $result = $mysqli->query("SHOW TABLES");
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }

    $sqlScript = "";
    foreach ($tables as $table) {
        $result = $mysqli->query("SHOW CREATE TABLE $table");
        $row = $result->fetch_row();
        $sqlScript .= "\n\n" . $row[1] . ";\n\n";

        $result = $mysqli->query("SELECT * FROM $table");
        $columnCount = $result->field_count;

        for ($i = 0; $i < $columnCount; $i++) {
            while ($row = $result->fetch_row()) {
                $sqlScript .= "INSERT INTO $table VALUES(";
                for ($j = 0; $j < $columnCount; $j++) {
                    $row[$j] = $row[$j];
                    if (isset($row[$j])) {
                        $sqlScript .= '"' . $row[$j] . '"';
                    } else {
                        $sqlScript .= '""';
                    }
                    if ($j < ($columnCount - 1)) {
                        $sqlScript .= ',';
                    }
                }
                $sqlScript .= ");\n";
            }
        }
        $sqlScript .= "\n";
    }

    if (!empty($sqlScript)) {
        $backup_file_name = 'tb_basis_data_backup_' . time() . '.sql';
        $fileHandler = fopen($backup_file_name, 'w+');
        fwrite($fileHandler, $sqlScript);
        fclose($fileHandler);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backup_file_name));
        ob_clean();
        flush();
        readfile($backup_file_name);
        unlink($backup_file_name);
        exit;
    }
}
?>