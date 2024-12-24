<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Make an Appointment - MediVault</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/animate.css">
    <link rel="stylesheet" href="./css/owl.carousel.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/tooplate-style.css">
</head>
<body>

    <!-- Navbar -->
    <div id="navbar-placeholder"></div>
    <script>
        // Dynamically load the navigation bar
        fetch('navbar.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('navbar-placeholder').innerHTML = data;
            })
            .catch(error => console.error('Error loading navbar:', error));
    </script>

    <!-- MAKE AN APPOINTMENT -->
    <section id="appointment" data-stellar-background-ratio="3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <img src="images/appointment-image.jpg" class="img-responsive" alt="Appointment">
                </div>

                <div class="col-md-6 col-sm-6">
                    <!-- CONTACT FORM HERE -->
                    <form id="appointment-form" role="form">
                        <!-- SECTION TITLE -->
                        <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                            <h2>Make an Appointment</h2>
                        </div>

                        <div class="wow fadeInUp" data-wow-delay="0.8s">
                            <div class="col-md-12 col-sm-12">
                                <label for="select-category">Select Doctor Category</label>
                                <select class="form-control" id="select-category" name="category" required>
                                    <option value="">-- Select Category --</option>
                                    <?php
                                    // Connect to the database
                                    $conn = new mysqli('localhost', 'root', '', 'medivault');
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Fetch unique categories from the doctors table
                                    $result = $conn->query("SELECT DISTINCT category FROM doctors");
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['category'] . "'>" . ucfirst($row['category']) . "</option>";
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-12 col-sm-12" style="margin-top: 15px;">
                                <label for="select-doctor">Select Doctor</label>
                                <select class="form-control" id="select-doctor" name="doctor" required>
                                    <option value="">-- Select Doctor --</option>
                                </select>
                            </div>

                            <div class="col-md-12 col-sm-12" style="margin-top: 15px;">
                                <label for="date">Select Date</label>
                                <input type="date" name="date" value="" class="form-control" required>
                            </div>

                            <div class="col-md-12 col-sm-12" style="margin-top: 15px;">
                                <label for="phone">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                            </div>

                            <div class="col-md-12 col-sm-12" style="margin-top: 15px;">
                                <label for="message">Additional Message</label>
                                <textarea class="form-control" rows="5" id="message" name="message" placeholder="Message"></textarea>
                            </div>

                            <div class="col-md-12 col-sm-12" style="margin-top: 15px;">
                                <button type="button" class="form-control btn btn-primary" id="cf-submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div id="confirmation-message" class="alert alert-success" style="display:none; margin-top:15px;">
                        Appointment successfully submitted!
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        // Fetch doctors dynamically based on category
        $('#select-category').change(function () {
            const category = $(this).val();

            if (category) {
                $.ajax({
                    url: 'php/fetch_doctors.php',
                    method: 'POST',
                    data: { category },
                    success: function (data) {
                        $('#select-doctor').html('<option value="">-- Select Doctor --</option>');
                        $('#select-doctor').append(data);
                    }
                });
            } else {
                $('#select-doctor').html('<option value="">-- Select Doctor --</option>');
            }
        });

        // Submit the form using AJAX
        $('#cf-submit').click(function () {
            const formData = $('#appointment-form').serialize();

            $.ajax({
                url: 'php/save_appointment.php',
                method: 'POST',
                data: formData,
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        $('#confirmation-message').show();
                        // Optionally update appointment history dynamically
                    } else {
                        alert(data.message);
                    }
                },
                error: function () {
                    alert('An error occurred. Please try again.');
                }
            });
        });
    </script>
</body>
</html>
