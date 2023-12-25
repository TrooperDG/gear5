<?php
    $servername = "localhost";
    $username = "root";
    $password = "shree";
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    
    $sql = "USE gear5";
    if ($conn->query($sql) === TRUE) {
        $a = "";
    }

    $main = array();
    $sql = "select * from products";
    $product_sql = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($product_sql)) {
        array_push($main, $row);
    }
    echo json_encode($main);
?>