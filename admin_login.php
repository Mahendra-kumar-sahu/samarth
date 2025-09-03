<?php
session_start();

if (isset($_SESSION['admin_username'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$error = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $conn = new mysqli("localhost", "root", "", "school");
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin_username'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login | Smarth Public School</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(120deg, #4e54c8, #8f94fb);
        margin: 0;
        padding: 0;
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
    }
    .login-container {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        padding: 40px;
        border-radius: 20px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        text-align: center;
        color: white;
    }
    .login-container h2 {
        margin-bottom: 25px;
        font-size: 28px;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .input-group {
        margin-bottom: 20px;
        text-align: left;
    }
    .input-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 6px;
    }
    .input-group input {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        outline: none;
        background: rgba(255,255,255,0.2);
        color: white;
        font-size: 15px;
        transition: all 0.3s ease;
    }
    .input-group input:focus {
        background: rgba(255,255,255,0.3);
        box-shadow: 0 0 5px #fff;
    }
    button {
        background: linear-gradient(45deg, #ff9800, #ff5722);
        color: white;
        padding: 12px;
        border: none;
        border-radius: 10px;
        width: 100%;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        transition: transform 0.2s ease, background 0.3s ease;
    }
    button:hover {
        transform: translateY(-2px);
        background: linear-gradient(45deg, #e68900, #e64a19);
    }
    .error {
        background: rgba(255,0,0,0.2);
        padding: 8px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
    }
    @media (max-width: 500px) {
        .login-container {
            padding: 25px;
        }
        .login-container h2 {
            font-size: 22px;
        }
    }
</style>
</head>
<body>
<div class="login-container">
    <h2>Smarth Public School</h2>
    <p style="margin-bottom:20px;">Admin Login</p>
    <?php if ($error) { echo "<div class='error'>$error</div>"; } ?>
    <form method="POST">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter your username" required>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" name="login">Login</button>
    </form>
</div>
</body>
</html>
