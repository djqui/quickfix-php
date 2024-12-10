<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/quickfix-php/config/db.php';

// Initialize an empty array for results
$results = [];

// Check if the search query is set
if (isset($_GET['query'])) {
    $query = htmlspecialchars(trim($_GET['query']));

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM fixers WHERE name LIKE ? OR expertise LIKE ?");
    $searchTerm = "%" . $query . "%"; // Use wildcards for partial matches
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    
    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all matching fixers
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }

    $stmt->close();
}

// Fetch all fixers to display below the search results
$allFixers = [];
$stmt = $conn->prepare("SELECT * FROM fixers LIMIT 5"); // Adjust the limit as needed
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $allFixers[] = $row;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <header>
        <h1>Search Results</h1>
    </header>

    <div class="search-bar">
        <form method="GET" action="search.php">
            <input type="text" name="query" placeholder="Search for a fixer by name or expertise..." required />
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="results-container">
        <h2>Search Results</h2>
        <?php if (empty($results)): ?>
            <p>No fixers found matching your search.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($results as $fixer): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($fixer['name']); ?></h3>
                        <p>Expertise: <?php echo htmlspecialchars($fixer['expertise']); ?></p>
                        <p>Rating: <?php echo htmlspecialchars($fixer['rating']); ?>/5</p>
                        <a href="fixerProfile.php?id=<?php echo $fixer['id']; ?>">View Profile</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="fixers-list">
        <h2>Available Fixers</h2>
        <ul>
            <?php if (empty($allFixers)): ?>
                <li>No fixers available at the moment.</li>
            <?php else: ?>
                <?php foreach ($allFixers as $fixer): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($fixer['name']); ?></h3>
                        <p>Expertise: <?php echo htmlspecialchars($fixer['expertise']); ?></p>
                        <p>Rating: <?php echo htmlspecialchars($fixer['rating']); ?>/5</p>
                        <a href="fixerProfile.php?id=<?php echo $fixer['id']; ?>">View Profile</a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>