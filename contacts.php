<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../styles/contacts.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/homepage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">QuickFix</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/quickfix-php/pages/about.php" class="nav-link btn btn-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="/quickfix-php/pages/contacts.php" class="nav-link btn btn-link">Contacts</a>
                </li>
                <li class="nav-item">
                    <a href="/quickfix-php/pages/account.php" class="nav-link btn btn-link">Account</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<body>
    <div class="container">
        <h1>Contact Us</h1>
        <form action="#" method="post">
            <p>Name: </p>
            <input type="text" id="name" name="name" placeholder="Enter Name" required>

            <p>Email: </p>
            <input type="email" id="email" name="email" placeholder="Enter Email" required>

            <p>Message: </p>
            <textarea type="message" name="message" rows="4" placeholder="Enter your Message" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>
</body>
</html>