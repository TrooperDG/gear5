<?php
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
    if (isset($_COOKIE['token'])) {
        $token = urldecode($_COOKIE['token']);
        echo "<script>console.log('".$token."');</script>";
        $sql = "select fname, lname from users where token = '".$token."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<script>const fname = '".$row['fname']."';</script>";
                echo "<script>const lname = '".$row['lname']."';</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gear5</title>
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/products.css">
    <link rel="stylesheet" href="styles/sidebar.css">
    


    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>


    <div class="navbar">
        <div class="nav-left">
            <button  class="ham-button">
                <img src="page_images/hamberger-01.png" alt="">
            </button>
            
            <img class="logo-img" src="page_images/gear 5 last-01.png" alt="">
            
        </div>
        <div class="nav-middle">
            <input class="search-bar" type="text" placeholder="Search">

            <button class="search-button">
            <img  src="page_images/search.svg" alt="">
            </button>

        </div>
        <div class="nav-right">
            <div class="cart">
                    <a href="cart-checkout.html">
                        <img class="cart-img" src="page_images/cart last-01.png" alt="">
                        <div class="cart-value js-cart-value">0</div>
                    </a>
                
            </div> 
            <div class="profile">
                <div class="profile-greet"></div>
                <img src="profile img/fb4342e0ac4a24cf8c08d0031174e228.jpg" alt="">
                <div class="profile-pop profile-pop-js"><a href="backend/logout.php">Logout</a></div>
            </div>
        </div>
    </div>

    <div class="sidebar">
        <div class="sidebar-tools-container">
            
    
            <div class="sidebar-elements">
                <img src="page_images/home.png" alt="">
                <div class="sidebar-text">Home</div>
            </div>
            <div class="sidebar-elements">
                <img src="page_images/heart-2.png" alt="">
                <div class="sidebar-text">Wishlisht</div>
            </div>
            <div class="sidebar-elements">
                <img src="page_images/filter.png" alt="">
                <div class="sidebar-text">Filter</div>
            </div>
            <div class="sidebar-elements">
                <img src="page_images/order.png" alt="">
                <div class="sidebar-text">Order Details</div>
            </div>
            

        </div>
    
        <div class="just for space ">
            <!-- because i dont know how to sole it right now  -->
        </div>
    
        <div class="sidebar-help-container">
            <div class="sidebar-elements">
                <img src="page_images/support.png" alt="">
                <div class="sidebar-text">Customar Care</div>
            </div>
    
        </div>

        
    </div>

    <div class="product-container js-product-container">      
    </div>


    <!-- <script src="data/cart.js"></script> -->
    <!-- <script src="data/product_data.js"></script> -->
    <script type="module" src="scripts/gear5.js"></script>

    <footer>
        <div>Sell Your Kidneys Before Adding Anything Into Cart.</div>
    </footer>
    <script>
        let account_name = "Hello,<br>";
        try {
            account_name = account_name.concat(fname, " ", lname);
        }
        catch (e) {
            account_name = account_name.concat("", "sign in");
        }
        console.log(account_name);
        document.querySelector('.profile-greet').innerHTML = account_name;
    </script>
</body>
</html>