<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup and Restore Database</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Backup and Restore Database</h1>
        <form action="backup.php" method="post">
            <button type="submit" name="backup" class="btn btn-primary">Backup Now</button>
        </form>
        <hr>
        <form action="restore.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="restoreFile">Choose SQL file to restore:</label>
                <input type="file" name="restoreFile" id="restoreFile" class="form-control-file">
            </div>
            <button type="submit" name="restore" class="btn btn-secondary">Restore</button>
        </form>
    </div>
</body>
</html>