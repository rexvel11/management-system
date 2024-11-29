<?php
session_start();

// Database connection
@include '../config.php';

// Fetch data for users with user_type 'student'
$query = "SELECT * FROM user_form WHERE user_type = 'student'";
$result = mysqli_query($conn, $query);

// Check if the query was successful and if there are results
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Redirect to login page if the user is not logged in or is not an admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: /management-system/base.php");
    exit;
}

// Implement session timeout (30 minutes)
$timeout_duration = 30 * 60; // 30 minutes in seconds
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();     // Unset session variables
    session_destroy();   // Destroy session
    header("Location: /management-system/base.php");
    exit;
}
$_SESSION['last_activity'] = time(); // Update last activity time
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Info</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>
    <!-- Top Bar -->
    <header class="top-bar">
        <div class="user-info">
            <img src="/management-system/img/sorsu-removebg-preview.png" alt="Admin Profile">
            <span>Admin</span>
            <a href="/management-system/logout.php" class="logout-icon">
                <i class="fa fa-sign-out-alt"></i> <!-- Logout Icon -->
            </a>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="/management-system/img/sorsu-removebg-preview.png" alt="Logo">
                <h2>Student Management System</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="/management-system/admin/homepage.php" class="menu-item"><i class="icon"></i> Home</a></li>
                    <li><a href="/management-system/admin/student.php" class="menu-item active"><i class="icon"></i> Students</a></li>
                    <li><a href="/management-system/admin/teacher.php" class="menu-item"><i class="icon"></i> Professors</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <section class="content-header">
                <h2>Students List</h2>
            </section>

            <section class="professor-data">
                <div class="gallery">
                    <?php
                    // Fetch and display each student record as a card
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='student-card'>";
                        echo "<h3>" . htmlspecialchars($row['fName']) . "</h3>";  // Display full name (fName)
                        // echo "<p><strong>Username:</strong> " . htmlspecialchars($row['uName']) . "</p>";  // Display username (uName)
                        // echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";  // Display email
                        // echo "<p><strong>Verified:</strong> " . ($row['verified'] ? 'Yes' : 'No') . "</p>";  // Display verified status
                        echo "<div class='card-buttons'>";  // Container for buttons
                        echo "<button class='view-btn'>View</button>";
                        echo "<button class='edit-btn'>Edit</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
