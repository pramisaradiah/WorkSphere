<?php
require "fungsi.php";

// CEK LOGIN
if (!isset($_SESSION['id_user'])) {
    header("Location: role.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// AMBIL ROLE USER
$query = "SELECT role FROM users WHERE id_user = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$role = $user['role']; // jobseeker / company
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WorkSphere</title>
</head>
<body>

<!-- NAVBAR -->
<header>
    <h2>WorkSphere</h2>
    <nav>
        <a href="index.php">Home</a>
        <a href="vacancy.php">Vacancy</a>
        <a href="faq.php">FAQ</a>

        <?php if ($role === 'company'): ?>
            <a href="post_job.php">Post Job</a>
        <?php endif; ?>

        <a href="logout.php">Logout</a>
    </nav>
</header>

<hr>

<!-- HERO SECTION -->
<section>
    <h1>Turn Your Skills Into Unlimited Opportunities</h1>
    <p>Search, apply, and work on projects — all in one seamless platform.</p>

    <form method="GET" action="search.php">
        <input type="text" name="keyword" placeholder="Search here">
        <button type="submit">Search</button>
    </form>
</section>

<hr>

<!-- JOB LIST -->
<section>
    <h2>Explore Jobs</h2>

    <?php
    $jobs = mysqli_query($conn, "
        SELECT j.id_job, j.title, j.description
        FROM jobs j
        ORDER BY j.created_at DESC
        LIMIT 6
    ");

    while ($job = mysqli_fetch_assoc($jobs)):
    ?>
        <div>
            <h3><?= htmlspecialchars($job['title']) ?></h3>
            <p><?= htmlspecialchars(substr($job['description'], 0, 100)) ?>...</p>

            <?php if ($role === 'jobseeker'): ?>
                <a href="apply.php?id=<?= $job['id_job'] ?>">Apply</a>
            <?php else: ?>
                <small>Recruiter cannot apply</small>
            <?php endif; ?>
        </div>
        <hr>
    <?php endwhile; ?>
</section>

<!-- CTA -->
<section>
    <h2>Ready to Join?</h2>
    <p>Build your future with WorkSphere.</p>
</section>

</body>
</html>
