<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 🔹 Character encoding for proper text display -->
    <meta charset="UTF-8">

    <!-- 🔹 Page title shown in browser tab -->
    <title>IFound MDX - Campus Lost & Found</title>

    <!-- 🔹 Google Font (Poppins) for modern UI styling -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- 🔹 External CSS file (contains all styling for layout and design) -->
    <!-- IMPORTANT: Correct path ensures styling loads properly -->
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<!-- 🔹 NAVIGATION BAR (Top Menu) -->
<div class="navbar">

    <!-- 🔹 Logo / System Name -->
    <div class="logo">IFound <span>MDX</span></div>

    <!-- 🔹 Navigation Links (Public access - no login required) -->
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</div>

<!-- 🔹 HERO SECTION (Main introduction area) -->
<div class="hero">
    <div class="hero-card">

        <!-- 🔹 Main heading (system purpose) -->
        <h1>Find & Recover <br><span>With Ease</span></h1>

        <!-- 🔹 Short description of system -->
        <p>
            A simple and efficient campus lost & found system for Middlesex University.
            Please login or register to report or search items.
        </p>

        <!-- 🔹 Call-to-action buttons -->
        <div class="buttons">
            <a href="login.php" class="btn primary">Login</a>
            <a href="register.php" class="btn secondary">Register</a>
        </div>

    </div>
</div>

<!-- 🔹 INFORMATION SECTION (Explains system workflow) -->
<div class="info">

    <!-- 🔹 Section title -->
    <h2>How It Works</h2>

    <div class="info-cards">

        <!-- 🔹 Step 1 -->
        <div class="card">
            <h3>1. Login</h3>
            <p>Create an account or login to access the system.</p>
        </div>

        <!-- 🔹 Step 2 -->
        <div class="card">
            <h3>2. Report</h3>
            <p>Submit details of lost or found items.</p>
        </div>

        <!-- 🔹 Step 3 -->
        <div class="card">
            <h3>3. Match</h3>
            <p>The system helps match lost and found items efficiently.</p>
        </div>

    </div>
</div>

<!-- 🔹 FOOTER SECTION -->
<div class="footer">
    <div class="footer-content">

        <!-- 🔹 System branding -->
        <p><strong>IFound MDX</strong></p>

        <!-- 🔹 Description -->
        <p>Campus Lost & Found System</p>

        <!-- 🔹 Organization -->
        <p>Middlesex University London</p>

        <!-- 🔹 Copyright -->
        <p class="copyright">© 2026 All Rights Reserved</p>
    </div>
</div>

</body>
</html>