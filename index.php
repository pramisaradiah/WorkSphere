<?php
require "fungsi.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WorkSphere</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

<header>
    <h2>WorkSphere</h2>
    <nav>
        <a href="index.php">Home</a>
        <a href="vacancy.php">Vacancy</a>
        <a href="faq.php">FAQ</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<hr>

<section>
    <h1>Turn Your Skills Into Unlimited Opportunities</h1>
    <p>Search, apply, and work on projects — all in one seamless platform.</p>

    <form method="GET" action="search.php">
        <input type="text" name="keyword" placeholder="Search here">
        <button type="submit">Search</button>
    </form>
</section>

<hr>

<section>
    <h2>Ready to Join?</h2>
    <p>Build your future with WorkSphere.</p>
</section>

</body>
</html>
