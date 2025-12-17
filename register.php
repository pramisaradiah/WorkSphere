<?php
require "fungsi.php";

$error = "";

if (isset($_POST['signup'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === "" || $password === "") {
        $error = "Email dan password wajib diisi";
    } else {

        // CEK EMAIL SUDAH ADA ATAU BELUM
        $check = mysqli_prepare($conn, "SELECT id_user FROM users WHERE email = ?");
        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $error = "Email sudah terdaftar";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
            mysqli_stmt_execute($stmt);

            header("Location: role.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Create Account</h2>

<p>
    Already have an account?
    <a href="role.php">Sign In</a>
</p>

<form method="POST">
    <label>Email</label><br>
    <input type="email" name="email"
           value="<?= isset($email) ? htmlspecialchars($email) : '' ?>"
           required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="signup">Sign Up</button>
</form>

<!-- ERROR DI BAWAH FORM -->
<?php if ($error): ?>
    <p><?= $error ?></p>
<?php endif; ?>

</body>
</html>
