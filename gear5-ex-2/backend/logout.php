<?php
    if (isset($_COOKIE['token'])) {
        unset($_COOKIE['token']); 
        setcookie('token', '', -1, '/'); 
    }
    header("Location: ../");
    die();
?>