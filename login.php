<?php
session_start();

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $mysqli = new mysqli("localhost", "root", "", "proforma_db");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Get input values
    $id = $mysqli->real_escape_string($_POST['id']);
    $username = $mysqli->real_escape_string($_POST['username']);

    // Check if user exists in records table
    $sql = "SELECT * FROM records WHERE id='$id' AND username='$username'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // Save user info in session
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;

        // Redirect to the portal page
        header("Location: portal.php");
        exit;
    } else {
        $error = "Invalid ID or Username!";
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - CFESS DRDO Portal</title>
    <style>
        body { font-family: Arial; text-align: center; background: #e3f3f9; }
        .login-box {
            background: white; padding: 20px; border-radius: 8px;
            width: 300px; margin: 100px auto; box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        input { width: 90%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 20px; background: #0077aa; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="id" placeholder="Enter ID" required><br>
            <input type="text" name="username" placeholder="Enter Username" required><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
