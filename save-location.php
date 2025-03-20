<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    // Example: Save to a database
    $conn = new mysqli("localhost", "root", "", "gps_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO locations (latitude, longitude) VALUES ('$latitude', '$longitude')";
    if ($conn->query($sql) === TRUE) {
        echo "Location saved!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
