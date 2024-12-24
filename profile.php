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
    <?php if (isset($_GET['upload_success'])): ?>
    <div class="alert alert-success text-center">File uploaded successfully!</div>
<?php endif; ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: php/login.php");
    exit();
}

$username = $_SESSION['username'];
$conn = new mysqli('localhost', 'root', '', 'medivault');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();
$stmt->close();

// Fetch user medical records
$stmt = $conn->prepare("SELECT * FROM medical_records WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$records_result = $stmt->get_result();
$stmt->close();
?>


<div class="container">
    <h2 class="text-center">My Profile</h2>

    <!-- User Details Section -->
    <div class="panel panel-default">
        <div class="panel-heading">Profile Information</div>
        <div class="panel-body">
            <form id="profile-form" method="POST" action="php/update_profile.php">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>" readonly>
                </div>
                <button type="button" class="btn btn-primary" id="edit-profile">Edit Profile</button>
            </form>
        </div>
    </div>

    <!-- Medical Records Section -->
    <div class="panel panel-default">
        <div class="panel-heading">Medical Records</div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>File Name</th>
                        <th>Upload Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($record = $records_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $record['id']; ?></td>
                            <td><a href="uploads/<?php echo $record['file_name']; ?>" target="_blank"><?php echo $record['file_name']; ?></a></td>
                            <td><?php echo $record['upload_date']; ?></td>
                            <td><a href="php/delete_record.php?id=<?php echo $record['id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Upload Medical Record -->
            <form method="POST" action="php/upload_record.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="medical-record">Upload New Record:</label>
                    <input type="file" class="form-control" id="medical-record" name="medical-record" required>
                </div>
                <button type="submit" class="btn btn-success">Upload</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#edit-profile').click(function() {
            const isEditable = $('#phone').prop('readonly');

            if (isEditable) {
                // Enable the phone field for editing
                $('#phone').prop('readonly', false).focus();
                $(this).text('Save Changes');
            } else {
                // Submit the form directly without confirmation
                $('#profile-form').submit();
            }
        });
    });
</script>

<?php include 'php/footer.php'; ?>

</body>
</html>

<?php
$conn->close();
?>
