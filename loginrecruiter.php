<?php
require "fungsi.php";

$error = ""; 
if (isset($_POST['signin'])) {
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
                        "UPDATE users SET role = 'recruiter' WHERE id_user = ?"
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
    <title>Sign In as Recruiter</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Sign in as Recruiter</h2>

<p>
    Don't have an account?
    <a href="register.php">Join here</a>
</p>

<form method="POST">
    <label>Email</label><br>
    <input type="email" name="email"
           value="<?= isset($email) ? htmlspecialchars($email) : '' ?>"
           required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="signin">Sign In</button>
</form>

<!-- ERROR MUNCUL DI BAWAH FORM -->
<?php if ($error): ?>
    <p><?= $error ?></p>
<?php endif; ?>

</body>
</html>
