<?php
    if (isset($_COOKIE['token'])) {
        header("Location: /gear5/gear5-ex-2");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grea5 log in</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/loginpage.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-logo">
            <img src="page_images/gear 5 white bg.png" alt="">
        </div>
        <div class="login-container">
            <h1>Login</h1>
            <!-- <div class="login-input"> -->
                <form action="#" method="POST" enctype="application/x-www-form-urlencoded">
                    <div class="input-details emailX">
                        <input name="pemail" type="email" placeholder="Email">
                        <i class='bx bxs-envelope'></i>
                    </div>
                    <div class="input-details passX">
                        <input name="ppass" type="password" placeholder="Password">
                        <i class='bx bxs-lock' ></i>
                    </div>
                    <div class="remember-forgot-password">
                        <label><input class="remember-box" type="checkbox"> Remember me</label>
                        <a href="XXXX">Forgot password?</a>
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
        $email = $_POST['pemail'];
        $pass = $_POST['ppass'];

        $sql = "select email, password from users where email = '".$email."';";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            if ($row['password'] == $pass) {
                $token = bin2hex(random_bytes(20));
                echo "<script>alert('Token: ".$token."');</script>";
                $sql = "update users set token = '".$token."' where email = '".$email."' and password = '".$pass."';";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>console.log('Token replaced.');</script>";
                }
                else {
                    echo "<script>console.log('Error: " . $sql . "<br>" . $conn->error."');</script>";
                }
                setcookie("token", $token, time() + (86400 * 30), "/");
                header("Location: /gear5/gear5-ex-2/");
                die();
            }
        }
        echo "<script>document.querySelector(\".error-box\").innerHTML = `<span class=\"error-message\" style=\"padding: 10px;margin-top: 20px;display: flex;justify-content: center;font-size: 17px;margin-left: 5px;margin-right: 5px;background-color: #fcc;border: #f66 2px solid;vertical-align: middle;border-radius: 5px;\">Incorrect email or password!</span>`</script>";
    }
?>

                    <div class="login-submit">
                        <button type="submit">Login</button>
                    </div>
                </form>
            <!-- </div> -->
            <div class="register">
                Don't have an account?
                <a href="register.php">Register now</a>
            </div>
        </div>
    </div>
</body>
</html>