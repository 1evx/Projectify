<?php
    session_start();
    session_destroy();
    unset($_SESSION["email"]);
    unset($_SESSION["password"]);
    unset($_SESSION["userid"]);
    unset($_SESSION["username"]);
    unset($_SESSION["usertype"]);
    unset($_SESSION["institutionname"]);
    $_SESSION = array();
    header('mainpage.html');
    exit;
 ?>