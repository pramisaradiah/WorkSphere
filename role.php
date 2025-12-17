<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="role.css">
</head>
<body>

<div class="auth-container">

    <!-- LEFT -->
    <div class="auth-left">
        <h2>Join us Now!</h2>
        <!-- <img src="img/woman.png" alt="Join"> -->
    </div>

    <!-- RIGHT -->
    <div class="auth-right">
        <h2>Sign in to your account</h2>
        <p>
            Don't have an account?
            <a href="register.php">Join here</a>
        </p>

        <div class="role-group">
            <a href="loginjobseeker.php" class="role-btn outline">
                Sign in as Job Seeker
            </a>

            <a href="loginrecruiter.php" class="role-btn primary">
                Sign in as Recruiter
            </a>
        </div>

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
            By joining, you agree to the WorkSphere
            <a href="#">Terms of Service</a> and
            <a href="#">Privacy Policy</a>.
        </p>
    </div>

</div>

</body>
</html>