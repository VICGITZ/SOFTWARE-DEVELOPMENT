<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate and sanitize the form data as needed

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $dbPassword = "";
    $dbname = "vick";

    // Create a new MySQLi instance
    $mysqli = new mysqli($servername, $username, $dbPassword, $dbname);

    // Check the connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO registration (Name, Email, Password) VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = $mysqli->prepare($sql);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    // Bind parameters
    $stmt->bind_param("sss", $name, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        // Data inserted successfully
        $response = "Data inserted successfully";
    } else {
        // Error in execution
        $response = "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $mysqli->close();

    // Output the response
    echo $response;
}
?>
