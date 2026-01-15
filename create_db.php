<?php
$conn = mysqli_connect('127.0.0.1', 'root', '');
if ($conn) {
    $sql = "CREATE DATABASE IF NOT EXISTS warung_cireng";
    if (mysqli_query($conn, $sql)) {
        echo "Database created successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    echo "Connection failed";
}
