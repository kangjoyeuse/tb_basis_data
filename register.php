<?php
include 'config/database.php'; // Pastikan file ini menghubungkan ke database

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Query untuk menyimpan data pengguna
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Pendaftaran berhasil');</script>";
    } else {
        echo "<script>alert('Pendaftaran gagal');</script>";
    }
}
?>

<?php include 'layout/header.php'; ?>

<main class="container mt-5">
    <h1>Register</h1>
    <form action="register.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="register" class="btn btn-primary">Register</button>
    </form>
</main>

<?php include 'layout/footer.php'; ?>