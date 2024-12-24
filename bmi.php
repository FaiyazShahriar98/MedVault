<!DOCTYPE html>
<html lang="en">
<head>
    <title>BMI Calculator - MediVault</title>
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
    <?php include 'navbar.php'; ?>
    <?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['username'])) {
        header("Location: login.html");
        exit();
    }
    $username = $_SESSION['username'];
    ?>

    <div class="container mt-5">
        <h2 class="text-center">BMI Calculator</h2>
        <p class="text-center">Use this tool to calculate your Body Mass Index and save your results.</p>
        <form id="bmi-form" method="POST" action="php/save_bmi.php">
            <div class="form-group">
                <label for="weight">Weight (kg):</label>
                <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter your weight" required>
            </div>
            <div class="form-group">
                <label for="height">Height (cm):</label>
                <input type="number" class="form-control" id="height" name="height" placeholder="Enter your height" required>
            </div>
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <button type="button" class="btn btn-primary" onclick="calculateAndSubmitBMI()">Calculate & Save</button>
        </form>
        <h3 id="result" class="text-center mt-4"></h3>
    </div>

    <script>
        function calculateAndSubmitBMI() {
            const weight = parseFloat(document.getElementById('weight').value);
            const height = parseFloat(document.getElementById('height').value) / 100;

            if (weight > 0 && height > 0) {
                const bmi = (weight / (height * height)).toFixed(2);
                document.getElementById('result').innerText = `Your BMI is ${bmi}`;

                // Append BMI to the form and submit
                const form = document.getElementById('bmi-form');
                let bmiInput = document.querySelector('input[name="bmi"]');
                if (!bmiInput) {
                    bmiInput = document.createElement('input');
                    bmiInput.type = 'hidden';
                    bmiInput.name = 'bmi';
                    form.appendChild(bmiInput);
                }
                bmiInput.value = bmi;

                form.submit();
            } else {
                document.getElementById('result').innerText = 'Please enter valid weight and height values.';
            }
        }
    </script>

</body>
</html>
