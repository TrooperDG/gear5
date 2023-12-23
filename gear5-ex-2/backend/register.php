<?php
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
        $fname = $_POST['pfname'];
        $lname = $_POST['plname'];
        $email = $_POST['pemail'];
        $pass = $_POST['ppass'];
        $token = bin2hex(random_bytes(20));
        $sql = "insert into users (fname, lname, email, password, token) VALUES ('".$fname."', '".$lname."', '".$email."', '".$pass."', '".$token."');";

        if ($conn->query($sql) === TRUE) {
            echo "<script>console.log('User added.');</script>";
        }
        else {
            echo "<script>console.log('Error: " . $sql . "<br>" . $conn->error."');</script>";
        }
        
        setcookie("token", $token, time() + (86400 * 30), "/");
    }
    header("Location: http://localhost/gear5/gear5-ex-2/");
    die();
?>