<?php
session_start();
include 'config/database.php'; // Pastikan file ini menghubungkan ke database

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data pengguna
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah');</script>";
    }
}
?>

<?php include 'layout/header.php'; ?>

<main class="container mt-5">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
</main>

<?php include 'layout/footer.php'; ?>