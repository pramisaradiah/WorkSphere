<?php
require "fungsi.php";

$error = ""; 
if (isset($_POST['signup'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === "" || $password === "") {
        $error = "Email dan password wajib diisi";
    } else {
        $query = "SELECT id_user, password, role FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {

            if (password_verify($password, $user['password'])) {

                // set session
                $_SESSION['id_user'] = $user['id_user'];

                // set role recruiter jika belum ada
                if ($user['role'] === NULL) {
                    $update = mysqli_prepare(
                        $conn,
                        "UPDATE users SET role = 'jobseeker' WHERE id_user = ?"
                    );
                    mysqli_stmt_bind_param($update, "i", $user['id_user']);
                    mysqli_stmt_execute($update);
                }

                // redirect ke index
                header("Location: index.php");
                exit;

            } else {
                $error = "Password salah";
            }

        } else {
            $error = "Email tidak terdaftar";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <link rel="stylesheet" href="login.css">
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
        <h2>Sign in as Jobseeker</h2>
        <p>
            Don't have an account?
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