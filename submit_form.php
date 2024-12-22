<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $message = $_POST["message"];

    // Store form data in MySQL database
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "msg";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into database
    $sql = "INSERT INTO message (name, message) VALUES ('$name', '$message')";
    if ($conn->query($sql) === TRUE) {
        // Construct the WhatsApp message
        $whatsappMessage = "Name: $name\nMessage: $message";

        // Redirect to WhatsApp with the message
        header("Location: https://api.whatsapp.com/send?text=" . urlencode($whatsappMessage));
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
