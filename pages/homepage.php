<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/quickfix-php/config/db.php';

// Fetch a list of fixers to display on the homepage
$fixers = [];
$stmt = $conn->prepare("SELECT * FROM fixers LIMIT 5"); // Adjust the limit as needed
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $fixers[] = $row;
}

$stmt->close();

// Handle search query
$searchResults = [];
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $conn->prepare("SELECT * FROM fixers WHERE name LIKE ? OR expertise LIKE ?");
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickFix</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/homepage.css">
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
    
<main>
        <div class="search-bar-container">
            <div class="search-bar">
                <form method="GET" action="">
                    <input type="text" name="query" placeholder="Search for a fixer by name or skill..." required />
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        <div class="fixers-list">
            <h2>Available Fixers</h2>
            <ul>
                <?php if (empty($searchResults) && !isset($_GET['query'])): ?>
                    <?php if (empty($fixers)): ?>
                        <li>No fixers available at the moment.</li>
                    <?php else: ?>
                        <?php foreach ($fixers as $fixer): ?>
                            <li>
                                <div class="fixer-profile">
                                    <img src="<?php echo htmlspecialchars($fixer['profile_img']); ?>" alt="<?php echo htmlspecialchars($fixer['name']); ?>'s profile picture" class="profile-picture">
                                    <div class="fixer-info">
                                        <h3><?php echo htmlspecialchars($fixer['name']); ?></h3>
                                        <p><?php echo htmlspecialchars($fixer['about']); ?></p>
                                        <a href="#" class="view-profile" 
                                        data-id="<?php echo $fixer['id']; ?>" 
                                        data-name="<?php echo htmlspecialchars($fixer['name']); ?>" 
                                        data-skills="<?php echo htmlspecialchars($fixer['skills']); ?>" 
                                        data-about="<?php echo htmlspecialchars($fixer['about']); ?>" 
                                        data-profile-img="<?php echo htmlspecialchars($fixer['profile_img']); ?>">
                                        View Profile
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if (empty($searchResults)): ?>
                        <li>No results found for "<?php echo htmlspecialchars($query); ?>".</li>
                    <?php else: ?>
                        <?php foreach ($searchResults as $fixer): ?>
                            <li>
                                <div class="fixer-profile">
                                    <img src="<?php echo htmlspecialchars($fixer['profile_picture']); ?>" alt="<?php echo htmlspecialchars($fixer['name']); ?>'s profile picture" class="profile-picture">
                                    <div class="fixer-info">
                                        <h3><?php echo htmlspecialchars($fixer['name']); ?></h3>
                                        <p><?php echo htmlspecialchars($fixer['']); ?></p>
                                        <a href="#" class="view-profile" 
                                        data-id="<?php echo $fixer['id']; ?>" 
                                        data-name="<?php echo htmlspecialchars($fixer['name']); ?>" 
                                        data-skills="<?php echo htmlspecialchars($fixer['skills']); ?>" 
                                        data-about="<?php echo htmlspecialchars($fixer['about']); ?>" 
                                        data-profile-img="<?php echo htmlspecialchars($fixer['profile_jpg']); ?>">
                                        View Profile
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="fixerModal" tabindex="-1" aria-labelledby="fixerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fixerModalLabel">Fixer Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modalContent">
                            <!-- Fixer information will be dynamically inserted here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main>
    <div class="search-bar-container">
        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" name="query" placeholder="Search for a fixer by name or skill..." required />
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="fixers-list">
        <h2>Available Fixers</h2>
        <ul>
            <?php if (empty($searchResults) && !isset($_GET['query'])): ?>
                <?php if (empty($fixers)): ?>
                    <li>No fixers available at the moment.</li>
                <?php else: ?>
                    <?php foreach ($fixers as $fixer): ?>
                        <li>
                            <div class="fixer-profile">
                                <img src="<?php echo htmlspecialchars($fixer['profile_img']); ?>" alt="<?php echo htmlspecialchars($fixer['name']); ?>'s profile picture" class="profile-picture">
                                <div class="fixer-info">
                                    <h3><?php echo htmlspecialchars($fixer['name']); ?></h3>
                                    <p><?php echo htmlspecialchars($fixer['about']); ?></p>
                                    <a href="#" class="view-profile" 
                                       data-id="<?php echo $fixer['id']; ?>" 
                                       data-name="<?php echo htmlspecialchars($fixer['name']); ?>" 
                                       data-expertise="<?php echo htmlspecialchars($fixer['skills']); ?>" 
                                       data-about="<?php echo htmlspecialchars($fixer['about']); ?>" 
                                       data-profile-img="<?php echo htmlspecialchars($fixer['profile_img']); ?>">
                                       View Profile
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
 <?php endif; ?>
                <?php else: ?>
                    <?php if (empty($searchResults)): ?>
                        <li>No results found for "<?php echo htmlspecialchars($query); ?>".</li>
                    <?php else: ?>
                        <?php foreach ($searchResults as $fixer): ?>
                            <li>
                                <div class="fixer-profile">
                                    <img src="<?php echo htmlspecialchars($fixer['profile_img']); ?>" alt="<?php echo htmlspecialchars($fixer['name']); ?>'s profile picture" class="profile-picture">
                                    <div class="fixer-info">
                                        <h3><?php echo htmlspecialchars($fixer['name']); ?></h3>
                                        <p><?php echo htmlspecialchars($fixer['about']); ?></p>
                                        <a href="#" class="view-profile" 
                                           data-id="<?php echo $fixer['id']; ?>" 
                                           data-name="<?php echo htmlspecialchars($fixer['name']); ?>" 
                                           data-expertise="<?php echo htmlspecialchars($fixer['skills']); ?>" 
                                           data-about="<?php echo htmlspecialchars($fixer['about']); ?>" 
                                           data-profile-img="<?php echo htmlspecialchars($fixer['profile_img']); ?>">
                                           View Profile
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="fixerModal" tabindex="-1" aria-labelledby="fixerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fixerModalLabel">Fixer Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modalContent">
                            <!-- Fixer information will be dynamically inserted here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewProfileButtons = document.querySelectorAll('.view-profile');
        const modalContent = document.getElementById('modalContent');

        viewProfileButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default link behavior

                const fixerId = this.getAttribute('data-id');
                const fixerName = this.getAttribute('data-name');
                const fixerExpertise = this.getAttribute('data-expertise');
                const fixerAbout = this.getAttribute('data-about');
                const fixerProfileImg = this.getAttribute('data-profile-img');

                // Populate modal content
                modalContent.innerHTML = `
                    <div class="text-center">
                        <img src="${fixerProfileImg}" alt="${fixerName}'s profile picture" class="profile-picture" style="width: 150px; height: 150px; border-radius: 50%;">
                        <h3>${fixerName}</h3>
                        <p><strong>Skill:</strong> ${fixerExpertise}</p>
                        <p>${fixerAbout}</p>
                    </div>
                `;

                // Show the modal
                const fixerModal = new bootstrap.Modal(document.getElementById('fixerModal'));
                fixerModal.show();
            });
        });
    });
</script>
</html>