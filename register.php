<?php
require "fungsi.php";

$error = "";

if (isset($_POST['signup'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === "" || $password === "") {
        $error = "Email dan password wajib diisi";
    } else {

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
    <link rel="stylesheet" href="register.css">
</head>
<body>

<div class="auth-container">

    <!-- LEFT SIDE -->
    <div class="auth-left">
        <h2>Join WorkSphere</h2>
        <p>Find your dream freelance & internship opportunities.</p>
        <!-- optional image -->
        <!-- <img src="img/register.png" alt="Register"> -->
    </div>

    <!-- RIGHT SIDE -->
    <div class="auth-right">
        <h2>Create Account</h2>
        <p>
            Already have an account?
            <a href="role.php">Sign In</a>
        </p>

        <form method="POST">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="<?= isset($email) ? htmlspecialchars($email) : '' ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <?php if ($error): ?>
                <p style="color:red; font-size:14px; margin-bottom:10px;">
                    <?= $error ?>
                </p>
            <?php endif; ?>

            <button type="submit" name="signup" class="btn-primary">
                Sign Up
            </button>
        </form>

        <div class="divider">
            <span>OR</span>
        </div>


        <div class="social-login">
            <button class="google-btn">
                Sign in with Google
            </button>

            <button class="facebook-btn">
                Continue with Facebook
            </button>
        </div>


        <p class="terms">
            By signing up, you agree to our Terms & Privacy Policy
        </p>
    </div>

</div>

</body>
</html>
