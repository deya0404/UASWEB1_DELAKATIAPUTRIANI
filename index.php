<?php
session_start();
include 'koneksi.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query  = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user   = mysqli_fetch_assoc($query);

    if ($user) {
        if ($password === $user['password']) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['name']  = $user['name'];
            $_SESSION['role']  = $user['role'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "❌ Password salah";
        }
    } else {
        $error = "❌ Email tidak ditemukan";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login | POLGAN MART</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    margin: 0;
    height: 100vh;
    background: linear-gradient(120deg, #1f1c2c, #928dab);
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box {
    width: 420px;
    padding: 35px;
    background: rgba(255,255,255,0.15);
    border-radius: 18px;
    backdrop-filter: blur(15px);
    box-shadow: 0 20px 45px rgba(0,0,0,0.4);
    color: #fff;
}

.avatar {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4);
    border-radius: 50%;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    margin-bottom: 15px;
}

.login-box h2 {
    text-align: center;
    margin-bottom: 25px;
    letter-spacing: 1px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    font-size: 14px;
    margin-bottom: 6px;
    display: block;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    outline: none;
}

.form-group input:focus {
    box-shadow: 0 0 8px rgba(255,255,255,0.7);
}

.btn-login {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #ff512f, #dd2476);
    color: white;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
}

.btn-login:hover {
    opacity: 0.9;
}

.error {
    background: rgba(255, 0, 0, 0.2);
    border-left: 4px solid #ff4d4d;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 14px;
}

.footer {
    text-align: center;
    margin-top: 20px;
    font-size: 13px;
    opacity: 0.8;
}
</style>
</head>

<body>

<div class="login-box">

    <div class="avatar">👤</div>
    <h2>POLGAN MART</h2>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="contoh@email.com" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-login">Masuk</button>
    </form>

    <div class="footer">
        © 2026 POLGAN MART • Sistem Penjualan
    </div>
</div>

</body>
</html>
