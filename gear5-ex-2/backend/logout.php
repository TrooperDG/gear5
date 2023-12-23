<?php
    if (isset($_COOKIE['token'])) {
        unset($_COOKIE['token']); 
        setcookie('token', '', -1, '/'); 
    }
    header("Location: http://localhost/gear5/gear5-ex-2/");
    die();
?>