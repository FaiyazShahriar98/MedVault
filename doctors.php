<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/animate.css">
    <link rel="stylesheet" href="./css/owl.carousel.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/tooplate-style.css">
</head>
 
    <title>Doctors - MediVault</title>

    <style>
        .doctor-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 15px;
        }
        .doctor-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 10px auto;
            display: block;
        }
        .doctor-card h5 {
            margin: 10px 0;
            font-size: 18px;
        }
        .doctor-card p {
            margin: 5px 0;
            color: #666;
        }
        .doctor-card .btn-appointment {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            padding: 10px 15px;
            display: block;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .doctor-card .btn-appointment:hover {
            background-color: #0056b3;
        }
        .row {
            margin-left: 0;
            margin-right: 0;
        }
        .col-md-4 {
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2 class="text-center">Find a Doctor</h2>

        <!-- Search Box -->
        <form method="GET" class="form-inline text-center" style="margin-bottom: 20px;">
            <input type="text" name="search" class="form-control" placeholder="Search by name, category, or hospital" style="width: 70%;" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') : ''; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Doctors Grid -->
        <div class="row">
            <?php
            // Connect to the database
            $conn = new mysqli('localhost', 'root', '', 'medivault');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch doctors based on search query
            $searchQuery = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
            $sql = "SELECT name, category, details, hospital_name 
                    FROM doctors";

            if ($searchQuery) {
                $sql .= " WHERE name LIKE '%$searchQuery%' 
                          OR category LIKE '%$searchQuery%' 
                          OR hospital_name LIKE '%$searchQuery%'";
            }

            $sql .= " LIMIT 12"; // Limit results for performance
            $result = $conn->query($sql);

            if ($result->num_rows > 0):
                while ($doctor = $result->fetch_assoc()):
            ?>
                <div class="col-md-4">
                    <div class="doctor-card">
                        <img src="images/temp-doctor.jpg" alt="Doctor Image">
                        <div class="card-body">
                            <h5><?php echo htmlspecialchars($doctor['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                            <p><strong>Specialty:</strong> <?php echo htmlspecialchars($doctor['category'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><strong>Hospital:</strong> <?php echo htmlspecialchars($doctor['hospital_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><?php echo htmlspecialchars($doctor['details'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <a href="appointment.php?doctor=<?php echo urlencode($doctor['name']); ?>" class="btn-appointment">Make an Appointment</a>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
            else:
            ?>
                <p class="text-center">No doctors found. Please try a different search term.</p>
            <?php
            endif;
            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
