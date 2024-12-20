<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .result {
            background-color: #f4f4f4;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .result h2 {
            color: #333;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="result">
        <h2>Registration Details</h2>

<?php
// Database connection details
$servername = "localhost"; // Default for WAMP
$username = "root";        // Default user in WAMP
$password = "";            // Default password is blank
$dbname = "registration_db"; // The database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<p class='error'>Connection failed: " . $conn->connect_error . "</p>");
}

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $full_name = $conn->real_escape_string(trim($_POST['full_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone_number = $conn->real_escape_string(trim($_POST['phone_number']));
    $password = $conn->real_escape_string(trim($_POST['password']));
    $gender = $conn->real_escape_string(trim($_POST['gender']));
    $address = $conn->real_escape_string(trim($_POST['address']));

    // Validate fields are not empty
    if (empty($full_name) || empty($email) || empty($phone_number) || empty($password) || empty($gender) || empty($address)) {
        echo "<p class='error'>All fields are required!</p>";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO users (full_name, email, phone_number, password, gender, address)
                VALUES ('$full_name', '$email', '$phone_number', '$password', '$gender', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Registration successful!</p>";
            echo "<p><strong>Full Name:</strong> $full_name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Phone Number:</strong> $phone_number</p>";
            echo "<p><strong>Gender:</strong> $gender</p>";
            echo "<p><strong>Address:</strong> $address</p>";
        } else {
            echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
} else {
    echo "<p class='error'>Invalid form submission.</p>";
}

$conn->close();
?>  

    </div>
</body>
</html>

