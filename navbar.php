<?php session_start(); ?>

<section class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand"><i class="fa fa-heartbeat"></i> MediVault</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="doctors.php">Doctors</a></li>
                <li><a href="news-detail.html">News</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tools <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="bmi.php">BMI Calculator</a></li>
                        <li><a href="tracker.php">Blood Pressure & Sugar Tracker</a></li>
                    </ul>
                </li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="profile.php" class="welcome-btn">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
                    <li><a href="php/logout.php" class="logout-btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="signup.html" class="register-btn">Register</a></li>
                    <li><a href="login.html" class="register-btn">Login</a></li>

                <?php endif; ?>
                <li class="appointment-btn"><a href="appointment.php" class="btn btn-primary">Make an Appointment</a></li>
                <li><a href="donation.html" class="btn btn-danger navbar-btn donate-btn">Donate</a></li>
            </ul>
        </div>
    </div>
</section>
