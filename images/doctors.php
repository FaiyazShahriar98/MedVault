<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors - MediVault</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/tooplate-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Doctors Section -->
    <div class="container">
        <h2 class="text-center">Find a Doctor</h2>

        <!-- Category Selection -->
        <div class="form-group">
            <label for="category">Select Doctor Category:</label>
            <select class="form-control" id="category">
                <option value="">-- Select a Category --</option>
                <?php
                // Connect to the database
                $conn = new mysqli('localhost', 'root', '', 'medivault');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch unique categories
                $result = $conn->query("SELECT DISTINCT category FROM doctors");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['category'] . "'>" . ucfirst($row['category']) . "</option>";
                }
                $conn->close();
                ?>
            </select>
        </div>

        <!-- Hospital Selection -->
        <div class="form-group" id="hospital-selection" style="display: none;">
            <label for="hospital">Select Hospital:</label>
            <select class="form-control" id="hospital">
                <option value="">-- Select a Hospital --</option>
            </select>
        </div>

        <!-- Doctor Selection -->
        <div class="form-group" id="doctor-selection" style="display: none;">
            <label for="doctor">Select Doctor:</label>
            <select class="form-control" id="doctor">
                <option value="">-- Select a Doctor --</option>
            </select>
        </div>

        <!-- Doctor Information -->
        <div id="doctor-info" style="display: none; margin-top: 20px;">
            <h3 id="doctor-name"></h3>
            <p id="doctor-details"></p>
            <button id="make-appointment" class="btn btn-primary">Make an Appointment</button>
        </div>
    </div>

    <script>
        // Fetch hospitals based on category
        $('#category').change(function () {
            const category = $(this).val();

            if (category) {
                $.ajax({
                    url: 'php/fetch_hospitals.php',
                    method: 'POST',
                    data: { category },
                    success: function (data) {
                        $('#hospital').html('<option value="">-- Select a Hospital --</option>');
                        $('#hospital').append(data);
                        $('#hospital-selection').show();
                        $('#doctor-selection').hide();
                        $('#doctor-info').hide();
                    }
                });
            } else {
                $('#hospital-selection').hide();
                $('#doctor-selection').hide();
                $('#doctor-info').hide();
            }
        });

        // Fetch doctors based on hospital
        $('#hospital').change(function () {
            const hospital = $(this).val();
            const category = $('#category').val();

            if (hospital && category) {
                $.ajax({
                    url: 'php/fetch_doctors.php',
                    method: 'POST',
                    data: { category, hospital },
                    success: function (data) {
                        $('#doctor').html('<option value="">-- Select a Doctor --</option>');
                        $('#doctor').append(data);
                        $('#doctor-selection').show();
                        $('#doctor-info').hide();
                    }
                });
            } else {
                $('#doctor-selection').hide();
                $('#doctor-info').hide();
            }
        });

        // Display doctor information
        $('#doctor').change(function () {
            const selectedDoctor = $(this).val();

            if (selectedDoctor) {
                $.ajax({
                    url: 'php/fetch_doctor_info.php',
                    method: 'POST',
                    data: { doctor: selectedDoctor },
                    success: function (data) {
                        const doctorInfo = JSON.parse(data);
                        $('#doctor-name').text(doctorInfo.name);
                        $('#doctor-details').text(doctorInfo.details);
                        $('#doctor-info').show();
                    }
                });
            } else {
                $('#doctor-info').hide();
            }
        });

        // Redirect to appointment page
        $('#make-appointment').click(function () {
            const doctorName = $('#doctor').val();
            window.location.href = `appointment.php?doctor=${doctorName}`;
        });
    </script>
</body>
</html>
