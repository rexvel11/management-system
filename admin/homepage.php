<?php
session_start();

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
    <title>Admin Home Page</title>
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
                    <li><a href="/management-system/admin/homepage.php" class="menu-item active"><i class="icon"></i> Home</a></li>
                    <li><a href="/management-system/admin/student.php" class="menu-item"><i class="icon"></i> Students</a></li>
                    <li><a href="/management-system/admin/teacher.php" class="menu-item"><i class="icon"></i> Professors</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <section class="content-header">
                <h2>Hi, welcome to the admin page.</h2>

                
            </section>
        </main>
    </div>

</body>
</html>