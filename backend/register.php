<?php
    header("Location: http://127.0.0.1:5500/gear5-ex-2/register.html");
    die();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "shree";

        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "USE gear5";
        if ($conn->query($sql) === TRUE) {
            echo "<script>console.log('Database connected successfully');</script>";
        }
        else {
            echo "<script>console.log('Error: " . $sql . "<br>" . $conn->error."');</script>";
        }
    }
?>