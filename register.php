<?php
require "fungsi.php";


if (isset($_POST['signup'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === "" || $password === "") {
        $error = "Email dan password wajib diisi";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: role.php");
            exit;
        } else {
            $error = "Email sudah terdaftar";
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

<?php if ($error): ?>
    <p><?= $error ?></p>
<?php endif; ?>

<form method="POST">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="signup">Sign Up</button>
</form>

</body>
</html>
