<?php
    if (isset($_COOKIE['token'])) {
        header("Location: http://localhost/gear5/gear5-ex-2/");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styles/register.css">

</head>
<body>
    <div class="login-wrapper">
        <div class="login-logo">
            <img src="page_images/gear 5 white bg.png" alt="">
        </div>
        <div class="login-container">
            <h1>Register</h1>
            <!-- <div class="login-input"> -->
                <form action="#" method="POST" enctype="application/x-www-form-urlencoded">
                    <div class="namex input-details">
                        <input class="name fname" type="text" placeholder="First name" name="pfname">
                        <input class="name lname" type="text" placeholder="Last name" name="plname">
                        <i class='bx bxs-user'></i>
                    </div>

                    <div class="input-details emailX">
                        <input type="email" placeholder="Email" name="pemail">
                        <i class='bx bxs-envelope'></i>
                    </div>
                    <div class="input-details passX">
                        <input type="password" placeholder="Password" name="ppass">
                        <i class='bx bxs-lock' ></i>
                    </div>

                    <div class="error-box">
                    </div>
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
        try {
            $sql = "insert into users (fname, lname, email, password, token) VALUES ('".$fname."', '".$lname."', '".$email."', '".$pass."', '".$token."');";

            if ($conn->query($sql) === TRUE) {
                echo "<script>console.log('User added.');</script>";
            }
            else {
                echo "<script>console.log('Error: " . $sql . "<br>" . $conn->error."');</script>";
            }
            
            setcookie("token", $token, time() + (86400 * 30), "/");
            header("Location: http://localhost/gear5/gear5-ex-2/");
            die();
        }
        catch (Exception $e) {
            echo "<script>document.querySelector(\".error-box\").innerHTML = `<span class=\"error-message\" style=\"padding: 10px;margin-top: 20px;display: flex;justify-content: center;font-size: 17px;margin-left: 5px;margin-right: 5px;background-color: #fcc;border: #f66 2px solid;vertical-align: middle;border-radius: 5px;\">User already exists! Please login.</span>`</script>";
        }
    }
?>
                    
                    <div class="login-submit">
                        <button type="submit">Register</button>
                    </div>
                </form>
            <!-- </div> -->
            <div class="login">
                Already have an account?
                <a href="login.html">Login</a>
            </div>
        </div>
    </div>
        
    
</body>
</html>