<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    // If not logged in, redirect to the user login page
    header("Location: /quickfix-php/pages/login/userloginPage.php");
    exit();
}

// If logged in, proceed to load the requested page or homepage
$page = isset($_GET['page']) ? $_GET['page'] : 'homepage'; // Default to 'homepage' if no page is specified

// Include the requested page, ensuring the correct path
$pagePath = 'pages/' . $page . '.php'; 

// Special handling for account page
if ($page === 'account') {
    $pagePath = '/quickfix-php/pages/account.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickFix</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/homepage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="functions.js" type="text/javascript"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">QuickFix</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="nav-link btn btn-link">About</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-link">Contacts</button>
                </li>
                <li class="nav-item">
                    <a href="?page=account" class="nav-link btn btn-link">Account</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

    
</body>
</html>