<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/quickfix-php/config/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Fix Handyman Profile</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/profile.css">
</head>
<body>
    <header>
        <span>QuickFix</span> 
        <button onclick="logOut()">Log Out</button>
    </header>

    <div class="user-profile-container">
    <div class="user-profile-left">
        <div class="user-profile-panel">
            <img src="/assets/profile.jpg" alt="Handyman Profile Image">
            <h1><?php echo htmlspecialchars($profile['name']); ?></h1>
            <p>Rating: <?php echo htmlspecialchars($profile['rating']); ?>/5</p>
            <p>Location: <?php echo htmlspecialchars($profile['location']); ?></p>
            <button onclick="openModal()">Book Now</button>
        </div>
    </div>

    <div class="user-profile-right">
        <div class="user-details">
            <h2 class="titles">Professional Details</h2>
            <div>
                <span>Name</span>
                <input type="text" value="<?php echo htmlspecialchars($profile['name']); ?>" readonly>
            </div>
            <div>
                <span>Email</span>
                <input type="email" value="<?php echo htmlspecialchars($profile['email']); ?>" readonly>
            </div>
            <div>
                <span>Phone</span>
                <input type="tel" value="<?php echo htmlspecialchars($profile['phone']); ?>" readonly>
            </div>
            <div>
                <span>Mobile</span>
                <input type="tel" value="<?php echo htmlspecialchars($profile['mobile']); ?>" readonly>
            </div>
            <div>
                <span>Address</span>
                <input type="text" value="<?php echo htmlspecialchars($profile['address']); ?>" readonly>
            </div>
            <button onclick="toggleEdit()">Edit</button>
        </div>

        <div class="skills-section">
            <h2 class="titles">About Me</h2>
            <textarea class="aboutMe" readonly><?php echo htmlspecialchars($profile['about']); ?></textarea>
        </div>
    </div>
</div>

    <!-- Modal for Booking Form -->
    <div class="modal" id="bookingModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form class="booking-form" id="bookingForm" onsubmit="handleBooking(event)">
                <h2>Book Appointment</h2>
                <label for="date">Date:</label>
                <input type="date" id="date" required min="<?php echo date('Y-m-d'); ?>">
                
                <label for="time">Time:</label>
                <input type="time" id="time" required>

                <label for="details">Job Details:</label>
                <textarea id="details" rows="4" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // Modal functionality
        function openModal() {
            document.getElementById('bookingModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('bookingModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('bookingModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        function handleBooking(event) {
            event.preventDefault();
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;
            const details = document.getElementById('details').value;
            
            console.log('Booking details:', { date, time, details });
            alert('Booking submitted successfully!');
            closeModal();
            event.target.reset();
        }

        function toggleEdit() {
            const inputs = document.querySelectorAll('.user-details input');
            const button = document.querySelector('.user-details button');
            
            if (inputs[0].readOnly) {
                inputs.forEach(input => input.readOnly = false);
                button.textContent = 'Save';
            } else {
                inputs.forEach(input => input.readOnly = true);
                button.textContent = 'Edit';
                alert('Profile updated successfully!');
            }
        }

        function logOut() {
            alert('Logging out...');
            // Add your logout logic here
        }
    </script>
</body>
</html>

<?php 
$stmt->close();
$conn->close(); 
?>