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
        $email = $_POST['pemail'];
        $pass = $_POST['ppass'];

        $sql = "select password from users where email = '".$email."';";
        $result = $conn->query($sql);
        if ($result) {
            while($row = $result->fetch_assoc()) {
                if ($row['password'] == $pass) {
                    $token = bin2hex(random_bytes(20));
                    $sql = "update users set token = '".$token."' where email = '".$email."' and password = '".$pass."';";
                    if ($conn->query($sql) === TRUE) {
                        echo "<script>console.log('Token replaced.');</script>";
                    }
                    else {
                        echo "<script>console.log('Error: " . $sql . "<br>" . $conn->error."');</script>";
                    }
                    setcookie("token", $token, time() + (86400 * 30), "/");
                    header("Location: http://localhost/gear5/gear5-ex-2/");
                    die();
                }
                else {
                    echo "<script>alert('Incorrect password!');</script>";
                }
            }
        }
        else {
            echo "<script>alert('Email not found!');</script>";
        }
    }
?>