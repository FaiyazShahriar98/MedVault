<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blood Pressure & Sugar Tracker</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/animate.css">
    <link rel="stylesheet" href="./css/owl.carousel.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/tooplate-style.css">
    <style>
        /* Tracker-specific styles */
        .tracker-container {
            margin-top: 50px;
            max-width: 600px;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tracker-header {
            color: #333333;
            margin-bottom: 20px;
        }

        .tracker-form .form-control {
            border-radius: 5px;
        }

        .tracker-form .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .tracker-form .btn-primary:hover {
            background-color: #0056b3;
        }

        .tracker-history {
            margin-top: 40px;
        }

        .tracker-history table {
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }

        .tracker-table th, .tracker-table td {
            text-align: center;
        }

        /* Ensure compatibility with global styles */
        body {
            background-color: #f7f7f7;
        }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container tracker-container">
        <h2 class="text-center tracker-header">Daily Blood Pressure & Sugar Tracker</h2>
        <form action="php/save_tracker.php" method="post" class="tracker-form">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="blood_pressure">Blood Pressure (mmHg):</label>
                <input type="text" id="blood_pressure" name="blood_pressure" class="form-control" placeholder="e.g., 120/80" required>
            </div>
            <div class="form-group">
                <label for="sugar_level">Sugar Level (mg/dL):</label>
                <input type="text" id="sugar_level" name="sugar_level" class="form-control" placeholder="e.g., 90" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Save</button>
        </form>
    </div>

    <!-- Tracker History -->
    <div class="container tracker-history">
        <h3 class="text-center">Your Tracker History</h3>
        <table class="table table-bordered tracker-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Blood Pressure (mmHg)</th>
                    <th>Sugar Level (mg/dL)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to the database
                $conn = new mysqli('localhost', 'root', '', 'medivault');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch tracker data for the logged-in user
                $sql = "SELECT date, blood_pressure, sugar_level FROM blood_sugar_tracker ORDER BY date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['blood_pressure']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sugar_level']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No data found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
